<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Process;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Document_uploadController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', function(){
        return view('top_page');
    })->name('top_page');
    //ログインホーム
    Route::get('/login_show', [AuthController::class,'showLogin'])->name('login.show');
    //ログイン処理
    Route::post('/login', [AuthController::class,'login'])->name('login');
    //新規ユーザー登録画面表示
    Route::get('/user', [Process::class,'new_user'])->name('new');
    //ユーザー登録処理
    Route::post('/user_process', [Process::class,'User_process'])->name('process');
    //登録者一覧
    Route::get('/user_member', [Process::class,'User_member'])->name('member');

    Route::post('/delete/{id}', [Process::class, 'User_delete'])->name('user_delete');

});

Route::middleware(['auth'])->group(function () {
    //ホーム画面
    Route::get('/home', function(){
        return view('home');
    })->name('home');

    Route::get('/setting_home', function(){
        return view('setting_home');
    })->name('setting_home');

    //ログアウト
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');

    // 画像投稿ページを表示
    Route::get('/create3', [UploadController::class,'postimg']);
    // 画像投稿をコントローラーに送信
    Route::post('/newimgsend', [UploadController::class,'saveimg']);

    Route::get('/company_form', [Process::class,'Company_form_view'])->name('company_form');

    Route::post('/company_form_process', [Process::class, 'Company_form_process'])->name('company_form_process');

    Route::get('/company_form/delete/{id}', [Process::class, 'Company_delete'])->name('company_delete');

    Route::get('/field_information', [Process::class,'Field_information'])->name('field_information');

    Route::post('/field_information_process', [Process::class, 'Field_information_process'])->name('field_information_process');

    Route::post('/field_delete/{id}', [Process::class, 'Field_delete'])->name('field_delete');

    Route::get('/admin_register_show', [AdminLoginController::class,'admin_registar_show'])->name('admin_register_show');

    Route::post('/admin_register', [AdminLoginController::class,'admin_registar'])->name('admin_register');

    Route::get('/setting', [Process::class,'Setting_form_view'])->name('setting_show');

    Route::post('/setting_register', [Process::class,'Setting_register'])->name('setting_register');

    Route::post('/setting_delete/{id}', [Process::class, 'Setting_delete'])->name('setting_delete');

    Route::get('/setting_update_view/{id}', [Process::class, 'Setting_update_view'])->name('setting_update_view');

    Route::post('/setting_update_register', [Process::class,'Setting_update_register'])->name('setting_update_register');

    Route::get('/field_list', [Process::class, 'Field_list'])->name('field_list');

    Route::get('/field_list/edit/{id}', [Process::class, 'Field_list_edit'])->name('field_edit');

    Route::post('/record_update', [Process::class,'Record_update'])->name('record_update');
    //customer
    Route::get('/customer_member', [Process::class,'Customer_member'])->name('customer_member');
    Route::post('/custome_delete/{id}', [Process::class, 'Customer_delete'])->name('customer_delete');

    Route::get('/picture_list', [UploadController::class, 'Picture_list'])->name('picture_list');
    Route::get('/picture_list/show/{id}', [UploadController::class, 'Picture_list_show'])->name('picture_list_show');
    Route::get('/picture_list/delete/{id}/{id2}', [UploadController::class, 'Picture_delete'])->name('picture_delete');

    Route::get('/event_setting', [EventController::class, 'Event_setting'])->name('event_setting');
    Route::post('/event_register', [EventController::class, 'Event_register'])->name('event_register');
    Route::post('/event_delete/{id}', [EventController::class, 'Event_delete'])->name('event_delete');
    Route::get('/event_list/edit/{id}', [EventController::class, 'Event_edit'])->name('event_edit');
    Route::post('/event_register2', [EventController::class, 'Event_register2'])->name('event_register2');
    Route::get('/event_list/detail/{id}', [EventController::class, 'Event_detail'])->name('event_detail');

    Route::get('/facility_information', [EventController::class, 'Facility_information'])->name('facility_information');
    Route::post('/facility_register', [EventController::class, 'Facility_register'])->name('facility_register');

    Route::get('/facility_list/{id}', [EventController::class, 'Facility_list'])->name('facility_list');
    Route::get('/facility_list/delete/{id}/{id2}', [EventController::class, 'Facility_list_delete'])->name('facility_list_delete');
    Route::get('/event_list/explanation/{id}', [EventController::class, 'Event_list_explanation'])->name('event_list_explanation');


    //pdfのドキュメントのアップロード
    Route::get('/document_upload', [Document_uploadController::class, 'document_upload_form'])->name('document_upload');
    Route::post('/newpdfsend', [Document_uploadController::class,'save_pdf']);
    Route::get('/document_list', [Document_uploadController::class, 'Document_list'])->name('document_list');
    Route::get('/document_list/show/{id}', [Document_uploadController::class, 'Document_list_show'])->name('document_list_show');
    Route::get('/document_list/delete/{id}/{id2}', [Document_uploadController::class, 'Document_delete'])->name('document_delete');









    //書類の種類の登録
    Route::get('/document_register', [DocumentController::class, 'document_register_form'])->name('document_register');
    Route::post('/document_register', [DocumentController::class, 'document_register_set'])->name('document_register_set');
    Route::get('/document_register/edit/{id}', [DocumentController::class, 'document_edit'])->name('document_edit');
    Route::post('/document_register2', [DocumentController::class, 'document_register2'])->name('document_register2');

    Route::post('/document_delete/{id}', [DocumentController::class, 'document_delete'])->name('document_delete');
    Route::get('/document_list/detail/{id}', [DocumentController::class, 'document_detail'])->name('document_detail');

});

Route::middleware(['admin'])->group(function () {

    Route::get('/admin', [AdminController::class,'index'])->name('admin');

    Route::get('/customer_field_list/{id}', [AdminController::class, 'Customer_list1'])->name('customer_list1');

    Route::get('/customer_facility_list/{id}', [AdminController::class, 'Customer_facility_list'])->name('customer_facility_list');

    Route::get('/customer_event_list/explanation/{id}', [AdminController::class, 'Customer_event_list_explanation'])->name('Customer_event_list_explanation');

    Route::get('/admin/logout', function () {
        Session::forget('email');
        Session::flush();

        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    });

});

//情報閲覧　顧客用ページトップ
Route::get('/admin/login', [AdminLoginController::class,'index'])->name('admin_login');
Route::post('/admin/login', [AdminLoginController::class,'signInAdmin'])->name('admin_sign_in');
Route::post('/customer_page1', [AdminController::class,'Customer_page1'])->name('customer_page1');
