<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>admin_login_test</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
  <style>
    body{
        background-color:azure;
    }
   </style>


</head>
<body>


    <form class="form-signin" action="{{ route('admin_sign_in') }}" method="post">
    @csrf

    <h1 class="h3 mb-3 font-weight-normal">顧客情報：ログイン</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">E-mail</label>
        <input name="email" type="email" class="form-control" placeholder="Email">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">password</label>
        <input name="password" type="password" class="form-control" placeholder="Password">
        </div>

        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
        </div>

        <p></p>
        <a class="btn btn-info" href="{{ route('top_page') }}" role="button">戻る</a>

    </form>

</body>
</html>
