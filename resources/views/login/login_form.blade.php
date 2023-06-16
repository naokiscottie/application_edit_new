<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログインフォーム</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <style>
        body{
            background-color:azure;
        }
    </style>
</head>
<body>
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">login_form</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-alert type="danger" :session="session('login_error')"/>
        <!--
            以下の文をコンポーネントを使用
            @if (session('login_error'))
            <div class="alert alert-danger">
                {{ session('login_error') }}
            </div>
            @endif
        -->
        <x-alert type="danger" :session="session('logout')"/>


        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">login</button>
        <br>
        <p></p>
        <a class="btn btn-info" role="button" onclick="page_password()"> 新規ユーザー登録</a>
        <a class="btn btn-info" href="{{ route('member') }}" role="button">登録者一覧</a>
        <p></p>
        <a class="btn btn-info" href="{{ route('top_page') }}" role="button">戻る</a>
    </form>

    <script>
        const name = @json($name);
        let counter = 0;
        function page_password(){
            if(counter < 3){
                myPassWord=prompt("パスワードを入力してください");
                if ( myPassWord == name ){
                    location.href="{{ route('new') }}";
                }else{
                    counter = counter + 1;
                    console.count('password_count');
                    alert( "パスワードが違っています。" );
                }
            }else{
                alert("Error : 3回パスワードを間違えました。")
            }


        }

    </script>


</body>
</html>
