<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>顧客登録画面</title>
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


<div class="container">
    <div class="mt-5">


        <form class="form-signin" method="POST" action="{{ route('admin_register') }}">
        @csrf
            <h1 class="h3 mb-3 font-weight-normal">閲覧用顧客情報の登録</h1>

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

            <label for="inputName" class="sr-only">name</label>
            <input type="name" id="inputName" name="name" class="form-control" placeholder="--Name--" required autofocus>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            <div class="mb-3">
                <select style="width:400px;" class="form-select" aria-label="Default select example" name="customer_id" id="exampleFormControlInput1">
                    <option value="" selected>会社名を選択して下さい。</option>
                    @foreach ($companys as $member)

                        <option value="{{ $member->id }}">{{ $member->company_name }}</option>

                    @endforeach
                </select>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">登録</button>

            <br><p></p>
            <a class="btn btn-info" href="{{ route('customer_member') }}" role="button">戻る</a>

        </form>


    </div>

</div>


</body>
</html>
