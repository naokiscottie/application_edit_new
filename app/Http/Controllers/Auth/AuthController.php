<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function showLogin(){
        $name = 1914;
        return view('login.login_form',['name' => $name]);
    }

    public function login(LoginFormRequest $request){
      $credentials = $request->only('email', 'password');

      $user = $this->user->getUserByEmail($credentials['email']);
      //取得したフォームのメールアドレスのデータがあるのか。
        if(!is_null($user)){
            //その行のlocked_flgを確認する。1(ロックされている状態)であれば、フォームに戻る。
            if($this->user->isAccountLocked($user)){
                return back()->withErrors([
                    'login_error' => 'アカウントがロックされています。',
            ]);
            }

            //アカウント認証を行い、アカウント認証が問題なければホームに移る。そして、その前にerror_countがあればリセットする。
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                //成功したらエラーアカウントを0にする。
                $this->user->resetErrorCount($user);
                $test_1 = 100;
                return redirect('home')->with('login_success','ログイン成功しました！');
            }

            //ログイン処理に失敗した時，エラーアカウントを1増やす
            $user->error_count = $this->user->addErrorCount($user->error_count);

            //エラーアカウントが6以上の時，アカウントをロックする。その後、フォーム画面に戻る。
            if($this->user->lockAccount($user)){
                return back()->withErrors([
                        'login_error' => 'アカウントがロックされました。',
                ]);
            }
            $user->save();

        }
      return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
      ]);



    }

    /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with
        ('logout','ログアウトました。');
    }





}
