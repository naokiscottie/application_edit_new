<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event_Request;
use App\Http\Requests\Event_Request2;
use App\Http\Requests\Facility_Request;
use App\Models\Event;
use App\Models\Event_list;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function Event_setting(){

        $event_lists = Event_list::all();

        return view('event_form',['event_lists' => $event_lists]);

    }

    public function Event_register(Event_Request $request)
    {

        $inputs = $request -> all();
        $a = $inputs['event_name'];
        $b = $inputs['event_explanation'];

        DB::beginTransaction();

        try{
            Event_list::create([
                'event_name' => $a,
                'event_explanation' => $b,
            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        Session::flash('err_msg', 'イベントを登録しました。');

        return redirect(route('event_setting'));
    }

    public function Event_delete($id)
    {
        if(empty($id)){
            Session::flash('err_msg2','データがありません。');
            return redirect(route('event_setting'));
        }

        try{

            //この項目を使用した書類リストが存在しているかどうかを判定して、存在している場合は削除させない。
            $event_existance_check = Event::where('event_id',$id)->get()->first();
            if($event_existance_check != null){
                Session::flash('err_msg2','このイベントの項目を使用した設備記録リストが存在します。削除出来ません。');
                return redirect(route('event_setting'));

            }

            //User::where('id', $id)->delete();
            Event_list::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg2','データを削除しました。');
        return redirect(route('event_setting'));


    }

    public function Event_edit($id){
        $event_list = Event_list::find($id);
        return view('event_form_edit',['event_list' => $event_list]);
    }

    public function Event_register2(Event_Request2 $request)
    {

        $inputs = $request -> all();
        $a = $inputs['event_name'];
        $b = $inputs['event_explanation'];
        $c = $inputs['id'];
        //設定テーブル変更部分の書き換え
        DB::beginTransaction();
        try{
            $setting_update = Event_list::find($c);
            $setting_update->fill([
                'event_name' => $a,
                'event_explanation' => $b,
            ]);
            $setting_update->save();
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }

        Session::flash('err_msg2','設定を更新しました。');
        return redirect(route('event_setting'));

    }

    public function Event_detail($id){
        $event_list = Event_list::find($id);
        return view('event_detail',['event_list' => $event_list]);
    }

    public function Facility_information(){

        $event_lists = Event_list::all();
        $field_lists = Field::all();

        return view('facility_information',[
            'event_lists' => $event_lists,
            'field_lists' => $field_lists,
        ]);
    }

    public function Facility_register(Facility_Request $request){
        $inputs = $request -> all();
        $a = $inputs['field_id'];
        $b = $inputs['date'];
        $c = $inputs['event_id'];
        $d = $inputs['remarks'];

        DB::beginTransaction();

        try{
            Event::create([
                'field_id' => $a,
                'event_date' => $b,
                'event_id' => $c,
                'remarks' => $d,
            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        Session::flash('err_msg', 'イベントを登録しました。');

        return redirect(route('facility_information'));

    }

    public function Facility_list($id){

        $test = DB::table('event_lists')->join('events','event_lists.id','=','events.event_id')->join('fields','events.field_id','=','fields.id')->where('field_id',$id)->get();
        $event_lists = DB::table('event_lists')->join('events','event_lists.id','=','events.event_id')->where('field_id',$id)->get();
        //0419追加
        $event_lists = $event_lists->reverse();

        return view('event_list',['event_lists' => $event_lists]);

    }
    public function Facility_list_delete($id,$id2){

        if(empty($id)){
            Session::flash('err_msg','データがありません。');
            return redirect()->action([EventController::class, 'Facility_list'], ['id' => $id2]);
        }

        try{
            //User::where('id', $id)->delete();
            Event::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg','データを削除しました。');

        return redirect()->action([EventController::class, 'Facility_list'], ['id' => $id2]);

    }

    public function Event_list_explanation($id){
        $events = DB::table('event_lists')->join('events','events.event_id','=','event_lists.id')->where('events.id',$id)->get();
        return view('event_remarks',['events' => $events]);
    }





}
