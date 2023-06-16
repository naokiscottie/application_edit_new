<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>


    <form class="form-signin" method="POST" action="{{ route('process') }}">
    @csrf
        <h1 class="h3 mb-3 font-weight-normal">新規ユーザー登録</h1>
        @if(session('err_msg'))

        <p class="text-danger">{{ session('err_msg') }}</p>

        @endif

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

        <label for="inputName" class="sr-only">name</label>
        <input type="name" id="inputName" name="name" class="form-control" placeholder="--Name--" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登録</button>

        <!--
        バリデーションによるエラーを一つずつ表示する場合
        @if ($errors->has('name'))
            <div class="alert alert-danger">
                    {{ $errors->first('name') }}
            </div>
        @endif
        -->
        <br><p></p>
        <a class="btn btn-info" href="{{ route('login.show') }}" role="button">戻る</a>

    </form>





    <footer class="footer bg-dark  fixed-bottom">
        @include('footer')
    </footer>
</body>
</html>
