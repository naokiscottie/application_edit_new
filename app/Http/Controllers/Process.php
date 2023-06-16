<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Field;
use App\Models\Setting;

use App\Models\Inspection_month_checking;
use App\Models\Inspection_panel_checking;
use App\Models\Inspection_panel_measurement;
use App\Models\Inspection_year_checking;

use App\Http\Requests\User_request;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\FieldRequest;
use App\Http\Requests\SettingRequest;
use App\Models\AdminUsers;
use App\Models\Document;
use App\Models\Event;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Process extends Controller
{
    public function new_user(){
        return view('new_user2');
    }

    //ユーザー新規登録
    public function User_process(User_request $request)
    {

        //DB::beginTransactionを入れることによってDB処理、今回の場合は登録がcommitを行わないと完結しない状態となる。
        DB::beginTransaction();
        //tryの中で何かのエラーが起きた場合、catchの{}に移動する。
        try{
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),

            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        Session::flash('err_msg', 'ユーザーを登録しました。');

        return redirect(route('new'));

    }
    public function User_member()
    {
        $members = User::all();
        return view('member',['members' => $members]);

    }

    public function User_delete($id)
    {

        if(empty($id)){
            Session::flash('err_msg','データがありません。');
            return redirect(route('member'));
        }

        try{
            //User::where('id', $id)->delete();
            User::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg','データを削除しました。');
        return redirect(route('member'));


    }

    public function Company_form_view(){

        $company_member = Company::all();

        return view('company_form',['company_member' => $company_member]);
    }


    public function Company_form_process(CompanyRequest $request)
    {
        $inputs = $request -> all();

        $a = $inputs['customer_name'];
        $b = $inputs['customer_email'];
        $c = $inputs['customer_telephone'];
        $d = $inputs['customer_address'];

        DB::beginTransaction();

        try{
            Company::create([
                'company_name' => $a,
                'company_email' => $b,
                'company_number' => $c,
                'company_address' => $d,
            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        Session::flash('err_msg', '会社を登録しました。');

        return redirect(route('company_form'));
    }


    public function Company_delete($id)
    {

        if(empty($id)){
            Session::flash('err_msg2','データがありません。');
            return redirect(route('company_form'));
        }

        try{

            //ここからR50615追記,会社を削除する前に各案件を削除するように変更
            $company_field_record_first = Field::where('customer_id',$id)->get()->first();
            if($company_field_record_first != null){
                Session::flash('err_msg2','会社名で登録されている案件名が存在します。関連する各案件を削除して下さい。');
                return redirect(route('company_form'));
            }



            // //ここから，登録していた会社に関わる全てのテーブルの行削除。設備，設備記録，投稿写真
            // //その会社が所有していた設備のidを$delete_field_idに格納
            // $delete_field_id = array();

            // $delete_field_record = Field::where('customer_id',$id)->get();
            // foreach($delete_field_record as $record){
            //     array_push($delete_field_id,$record->id);
            // }


            // foreach($delete_field_id as $delete_id){
            //     $pictures = Picture::where('field_id',$delete_id)->get();
            //     foreach($pictures as $picture){
            //         $del_path = storage_path().'/app/public/test/'.$picture -> file_name;
            //         \File::delete($del_path);
            //     }
            //     $pictures = Picture::where('field_id',$delete_id)->delete();

            //     Field::where('id',$delete_id)->delete();
            //     Setting::where('field_id',$delete_id)->delete();
            //     Inspection_month_checking::where('field_id',$delete_id)->delete();
            //     Inspection_panel_checking::where('field_id',$delete_id)->delete();
            //     Inspection_panel_measurement::where('field_id',$delete_id)->delete();
            //     Inspection_year_checking::where('field_id',$delete_id)->delete();
            //     Event::where('field_id',$delete_id)->delete();

            // }


            Company::destroy($id);
            AdminUsers::where('customer_id',$id)->delete();




            //ここまで



        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg2','データを削除しました。');
        return redirect(route('company_form'));


    }

    public function Field_information(){

        $field_informations = Field::all();
        $company_member = Company::all();

        $tests = \DB::table('companys')->join('fields','fields.customer_id','=','companys.id')->get();

        return view('field_information',['field_informations' => $field_informations],['company_member' => $company_member])->with('tests',$tests);
    }

    public function Field_information_process(FieldRequest $request)
    {
        $inputs = $request -> all();

        $a = $inputs['field_name'];
        $b = $inputs['field_address'];
        $c = $inputs['power'];
        $d = $inputs['solar_power'];
        $e = $inputs['contract_date'];
        $f = $inputs['contract_money'];
        $g = $inputs['customer_id'];

        DB::beginTransaction();

        try{
            Field::create([
                'field_name' => $a,
                'field_address' => $b,
                'power' => $c,
                'solar_power' => $d,
                'contract_date' => $e,
                'contract_money' => $f,
                'customer_id' => $g,
            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        //0419変更
        \Session::flash('err_msg', '設備を登録しました。');

        return redirect(route('field_information'));
    }


    public function Field_delete($id)
    {

        if(empty($id)){
            Session::flash('err_msg2','データがありません。');
            return redirect(route('field_information'));
        }

        try{
            //User::where('id', $id)->delete();
            Field::destroy($id);

            //設備に関わるテーブルの行の削除
            //写真の削除
            $pictures = Picture::where('field_id',$id)->get();
            foreach($pictures as $picture){
                $del_path = storage_path().'/app/public/test/'.$picture -> file_name;
                \File::delete($del_path);
            }
            Picture::where('field_id',$id)->delete();

            //書類の削除
            $documents = Document::where('field_id',$id)->get();
            foreach($documents as $document){
                $del_path = storage_path().'/app/public/test_2/'.$document -> file_name;
                \File::delete($del_path);
            }
            Document::where('field_id',$id)->delete();

            //その他関連テーブルの削除
            Setting::where('field_id',$id)->delete();

            Inspection_month_checking::where('field_id',$id)->delete();

            Inspection_panel_checking::where('field_id',$id)->delete();

            Inspection_panel_measurement::where('field_id',$id)->delete();

            Inspection_year_checking::where('field_id',$id)->delete();

            Event::where('field_id',$id)->delete();

        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg2','データを削除しました。');
        return redirect(route('field_information'));


    }

    public function Setting_form_view(){
        $field_informations = Field::all();
        $tests = DB::table('fields')->join('settings','settings.field_id','=','fields.id')->get();


        return view('setting_form',['field_informations' => $field_informations])->with('tests',$tests);
    }

    //設定の登録
    public function Setting_register(SettingRequest $request){

        $inputs = $request -> all();
        $a = $inputs['field_id'];
        $b = $inputs['year_checking'];
        $c = $inputs['panel_checking'];
        $d = $inputs['panel_measurement'];
        $e = $inputs['month_period'];
        $f = $inputs['year'];
        $g = $inputs['start_month'];
        //settingsテーブルに受け取ったfield_idが既に登録されていないかどうか確かめる。
        $already_check = \DB::table('settings')->where('field_id',$a)->first();
        //$already_checkの中にデータがあれば，既に登録されていることになるので、受け取ったデータがnullかどうか確かめる。nullでないとしたら、リダイレクトする。
        if($already_check!=null){
            Session::flash('err_msg','既に登録されています。');
            return redirect(route('setting_show'));
        }
        //settingsテーブルに各設定を登録する。
        DB::beginTransaction();
        try{
            Setting::create([
                'field_id' => $a,
                'year_checking' => $b,
                'panel_checking' => $c,
                'panel_measurement' => $d,
                'month_period' => $e,
                'year' => $f,
                'start_month' => $g,
            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }

        //設定に対応したテーブルレコードの作成

        //年次点検year_checkingが1(有)の時、ispection_year_checkingにレコードを作成
        if($b==1){
            create_year_checking($a);
        }

        //inspection_panel_checkingテーブルの作成
        if($c==1){
            create_panel_checking($a);
        }

        //inspection_panel_measurementテーブルの作成
        if($d==1){
            create_panel_measurement($a);
        }

        //inspection_month_checkingテーブルの作成
        $inspection_time = 12 / $e;
        create_month_checking($a,$inspection_time);

        Session::flash('err_msg', '設定を登録しました。');
        return redirect(route('setting_show'));

    }

    //設定の削除
    public function Setting_delete($id)
    {

        if(empty($id)){
            Session::flash('err_msg2','データがありません。');
            return redirect(route('setting_show'));
        }
        $setting_record = DB::table('settings')->where('id',$id)->first();

        //設定の削除時、作成した各点検テーブルを削除する。

        $records_1 = Inspection_month_checking::where('field_id',$setting_record->field_id)->get();
        if($records_1){
            foreach($records_1 as $record){
                $record->delete();
            }
        }

        $records_2 = Inspection_panel_checking::where('field_id',$setting_record->field_id)->get();
        if($records_2){
            foreach($records_2 as $record){
                $record->delete();
            }
        }

        $records_3 = Inspection_panel_measurement::where('field_id',$setting_record->field_id)->get();
        if($records_3){
            foreach($records_3 as $record){
                $record->delete();
            }
        }

        $records_4 = Inspection_year_checking::where('field_id',$setting_record->field_id)->get();
        if($records_4){
            foreach($records_4 as $record){
                $record->delete();
            }
        }

        try{
        //Setting::where('id', $id)->delete();
            Setting::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg2','データを削除しました。');
        return redirect(route('setting_show'));

    }

    public function Setting_update_view($id){
        $setting_data = DB::table('settings')->where('id',$id)->get()->first();
        $field_informations = Field::all();
        return view('setting_form_update',['field_informations' => $field_informations],['setting_data' => $setting_data])->with('id',$id);

    }

    public function Setting_update_register(Request $request){

        $inputs = $request -> all();

        $setting_table_id = $inputs['setting_id'];
        $a = $inputs['field_id'];
        $b = $inputs['year_checking'];
        $c = $inputs['panel_checking'];
        $d = $inputs['panel_measurement'];
        $e = $inputs['month_period'];
        $f = $inputs['year'];
        $g = $inputs['start_month'];

        $target = DB::table('settings')->where('id',$setting_table_id)->first();
        $check_year = $target->year;

        //年度が過去の場合，再入力を促す。
        if($check_year > $f){
            Session::flash('err_msg','年度が過去となっています。再入力してい下さい。');
            return redirect()->action([Process::class, 'Setting_update_view'], ['id' => $setting_table_id]);
        }



        if($target->year_checking!=$b or $target->panel_checking!=$c or $target->panel_measurement!=$d or $target->month_period!=$e or $target->year!=$f or $target->start_month!=$g){

            //各設定の変更
            $change_field = $target->field_id;
            //年度が変わる時，点検テーブルの変更を行う。
            if($check_year < $f){


                //各点検テーブルのstatusを0（未実施）に変更する。

                $records_1 = Inspection_month_checking::where('field_id',$change_field)->get();
                if($records_1){
                    foreach($records_1 as $record){
                        Inspection_month_checking::where('id','=',$record->id)->update(['status' => '0']);
                    }
                }

                $records_2 = Inspection_panel_checking::where('field_id',$change_field)->get();
                if($records_2){
                    foreach($records_2 as $record){
                        Inspection_panel_checking::where('id','=',$record->id)->update(['status' => '0']);
                    }
                }

                $records_3 = Inspection_panel_measurement::where('field_id',$change_field)->get();
                if($records_3){
                    foreach($records_3 as $record){
                        Inspection_panel_measurement::where('id','=',$record->id)->update(['status' => '0']);
                    }
                }

                $records_4 = Inspection_year_checking::where('field_id',$change_field)->get();
                if($records_4){
                    foreach($records_4 as $record){
                        Inspection_year_checking::where('id','=',$record->id)->update(['status' => '0']);
                    }
                }


            }

            if($target->year_checking!=$b){
                if($b==0){
                    $records_1 = Inspection_year_checking::where('field_id',$change_field)->get();
                    if($records_1){
                        foreach($records_1 as $record){
                            $record->delete();
                        }
                    }
                }else{
                    create_year_checking($a);
                }

            }
            if($target->panel_checking!=$c){
                if($c==0){
                    $records_2 = Inspection_panel_checking::where('field_id',$change_field)->get();
                    if($records_2){
                        foreach($records_2 as $record){
                            $record->delete();
                        }
                    }
                }else{
                    create_panel_checking($a);
                }
            }
            if($target->panel_measurement!=$d){
                if($d==0){

                    $records_3 = Inspection_panel_measurement::where('field_id',$change_field)->get();
                    if($records_3){
                        foreach($records_3 as $record){
                            $record->delete();
                        }
                    }

                }else{
                    create_panel_measurement($a);
                }
            }
            if($target->month_period!=$e){

                $records_4 = Inspection_month_checking::where('field_id',$change_field)->get();
                if($records_4){
                    foreach($records_4 as $record){
                        $record->delete();
                    }
                }

                //inspection_month_checkingテーブルの作成
                $inspection_time = 12 / $e;
                create_month_checking($a,$inspection_time);

            }



            //設定テーブル変更部分の書き換え
            DB::beginTransaction();
            try{
                $setting_update = Setting::find($setting_table_id);
                $setting_update->fill([
                    'field_id' => $a,
                    'year_checking' => $b,
                    'panel_checking' => $c,
                    'panel_measurement' => $d,
                    'month_period' => $e,
                    'year' => $f,
                    'start_month' => $g,
                ]);
                $setting_update->save();
                DB::commit();
            }catch(\Throwable $e){
                DB::rollback();
                abort(500);
            }

            Session::flash('err_msg','設定を更新しました。');
            return redirect(route('setting_show'));

        }

        Session::flash('err_msg','設定に変更はありませんでした。');
        return redirect(route('setting_show'));

    }

    public function Field_list(){

        $lists = DB::table('companys')->join('fields','fields.customer_id','=','companys.id')->get();
        return view('field_list')->with('lists',$lists);

    }

    public function Field_list_edit($id){


        $field = Field::find($id);
        $name = $field->field_name;

        $settings = Setting::where('field_id',$id)->get();

        //未設定の場合のエラー処理
        if($settings->first() == null){
            Session::flash('err_msg','設定がされていません。');
            return redirect(route('field_list'));
        }

        $start_month = $settings->first()->start_month;
        $month_period = $settings->first()->month_period;

        $year_checkings = Inspection_year_checking::where('field_id',$id)->get();
        $panel_checkings = Inspection_panel_checking::where('field_id',$id)->get();

        $panel_measurements = Inspection_panel_measurement::where('field_id',$id)->get();
        $month_checkings = Inspection_month_checking::where('field_id',$id)->get();



        return view('display_inspection',['month_checkings' => $month_checkings],['year_checkings' => $year_checkings])->with([
            "name" => $name,
            "id" => $id,
            "panel_checkings" => $panel_checkings,
            "panel_measurements" => $panel_measurements,
            'start_month' => $start_month,
            'month_period' => $month_period,
        ]);

    }

    public function Record_update(Request $request){
        $inputs = $request->all();
        $a=array_key_exists('user_id_1',$inputs);
        $b=array_key_exists('user_id_2',$inputs);
        $c=array_key_exists('user_id_3',$inputs);
        $d=array_key_exists('user_id_4',$inputs);
        $id = $inputs['id'];

        if($a==true){
            $check_value=$inputs['user_id_1'];
            foreach($check_value as $key => $value){
                $first_key = $key;
                $first_value =$value;
            }
            Inspection_month_checking::where('id','=',$first_key)->update(['status' => $first_value]);
            Session::flash('err_msg','データを更新しました。');
            return redirect()->action([Process::class, 'Field_list_edit'], ['id' => $id]);

        }
        if($b==true){
            $check_value=$inputs['user_id_2'];
            foreach($check_value as $key => $value){
                $first_key = $key;
                $first_value =$value;
            }
            Inspection_year_checking::where('id','=',$first_key)->update(['status' => $first_value]);
            Session::flash('err_msg','データを更新しました。');
            return redirect()->action([Process::class, 'Field_list_edit'], ['id' => $id]);

        }
        if($c==true){
            $check_value=$inputs['user_id_3'];
            foreach($check_value as $key => $value){
                $first_key = $key;
                $first_value =$value;
            }
            Inspection_panel_checking::where('id','=',$first_key)->update(['status' => $first_value]);
            Session::flash('err_msg','データを更新しました。');
            return redirect()->action([Process::class, 'Field_list_edit'], ['id' => $id]);


        }
        if($d==true){
            $check_value=$inputs['user_id_4'];
            foreach($check_value as $key => $value){
                $first_key = $key;
                $first_value =$value;
            }
            Inspection_panel_measurement::where('id','=',$first_key)->update(['status' => $first_value]);
            Session::flash('err_msg','データを更新しました。');
            return redirect()->action([Process::class, 'Field_list_edit'], ['id' => $id]);


        }
    }

    public function Customer_member()
    {
        //R50616会社名が表示されるように変更する。
        $members = DB::table('admin_users')
        ->select('admin_users.id as id','admin_users.name','admin_users.email','companys.company_name')
        ->join('companys','admin_users.customer_id','=','companys.id')->get();

        //dd($members);


        // $members = AdminUsers::all();
        // dd($members);
        return view('customer_member',['members' => $members]);

    }

    public function Customer_delete($id)
    {

        if(empty($id)){
            Session::flash('err_msg','データがありません。');
            return redirect(route('customer_member'));
        }

        try{
            //User::where('id', $id)->delete();
            AdminUsers::destroy($id);
        }catch(\Throwable $e){
            abort(500);
        }

        Session::flash('err_msg','データを削除しました。');
        return redirect(route('customer_member'));


    }






}


function create_year_checking($value){
    Inspection_year_checking::create([
        'field_id' => $value,
        'status' => 0,
    ]);
}

function create_panel_checking($value){

    for($i=0; $i<2; $i++){
        Inspection_panel_checking::create([
            'field_id' => $value,
            'times' => $i+1,
            'status' => 0,
        ]);
    }

}

function create_panel_measurement($value){

    Inspection_panel_measurement::create([
        'field_id' => $value,
        'status' => 0,
    ]);

}

function create_month_checking($value1,$value2){
    for($i=0; $i<$value2; $i++){
        Inspection_month_checking::create([
            'field_id' => $value1,
            'times' => $i+1,
            'status' => 0,
        ]);
    }

}


