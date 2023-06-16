<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document_Request2;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Document_list;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{

    public function document_register_form (){
        $document_lists = Document_list::all();
        return view ('document_register',['document_lists' => $document_lists]);
    }

    public function document_register_set (DocumentRequest $request){
        $inputs = $request -> all();

        $a = $inputs['document_name'];
        $b = $inputs['remarks'];


        DB::beginTransaction();

        try{
            Document_list::create([
                'document_name' => $a,
                'remarks' => $b,
            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        Session::flash('err_msg', 'イベントを登録しました。');

        return redirect(route('document_register'));
    }

    public function document_edit($id){
        $document_list = Document_list::find($id);
        return view('document_register_edit',['document_list' => $document_list]);
    }

    public function document_delete($id)
    {
        if(empty($id)){
            Session::flash('err_msg2','データがありません。');
            return redirect(route('event_setting'));
        }

        try{

            //この項目を使用した書類リストが存在しているかどうかを判定して、存在している場合は削除させない。
            $document_existance_check = Document::where('document_id',$id)->get()->first();
            if($document_existance_check != null){
                Session::flash('err_msg2','この書類の項目を使用した書類リストが存在します。削除出来ません。');
                return redirect(route('document_register'));
            }


            //User::where('id', $id)->delete();
            Document_list::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg2','データを削除しました。');
        return redirect(route('document_register'));


    }

    public function document_register2(Document_Request2 $request)
    {

        $inputs = $request -> all();
        $a = $inputs['document_name'];
        $b = $inputs['remarks'];
        $c = $inputs['id'];
        //設定テーブル変更部分の書き換え
        DB::beginTransaction();
        try{
            $setting_update = Document_list::find($c);
            $setting_update->fill([
                'document_name' => $a,
                'remarks' => $b,
            ]);
            $setting_update->save();
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }

        Session::flash('err_msg2','設定を更新しました。');
        return redirect(route('document_register'));

    }

    public function document_detail($id){
        $document_list = Document_list::find($id);
        return view('document_detail',['document_list' => $document_list]);
    }


}
