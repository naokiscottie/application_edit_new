<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Http\Requests\CreateAdminUserLoginRequest;
use App\Http\Requests\Customer_Request;
use App\Models\AdminUsers;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin_login_form');
    }

    public function signInAdmin(Customer_Request $request){
        if(Auth::guard('admin')->attempt(['email'=>$request['email'],'password'=>$request['password']])){
            $test = $request['email'];
            Session::regenerate();
            Session::put('email', $test);
            return redirect()->route('admin');
        }

        return redirect()->route('admin_login')->with('error','ID,PASSWORDが間違っています');

    }


    //adminユーザー新規登録
    public function admin_registar_show(){
        $companys = Company::all();
        return view('new_customer',['companys' => $companys]);
    }

    //adminユーザー新規登録
    public function admin_registar(CreateAdminUserLoginRequest $request)
    {

        //DB::beginTransactionを入れることによってDB処理、今回の場合は登録がcommitを行わないと完結しない状態となる。
        DB::beginTransaction();
        //tryの中で何かのエラーが起きた場合、catchの{}に移動する。
        try{
            AdminUsers::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'customer_id' =>$request['customer_id'],

            ]);
            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            abort(500);
        }
        Session::flash('err_msg', 'ユーザーを登録しました。');

        return redirect(route('admin_register_show'));

    }
}
