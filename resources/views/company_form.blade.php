<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ホーム画面</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {padding: 10px;}
        h1 {
            position: relative;
            padding: .75em 1em .75em 1.5em;
            border: 1px solid #ccc;
        }
        h1::after {
            position: absolute;
            top: .5em;
            left: .5em;
            content: '';
            width: 6px;
            height: -webkit-calc(100% - 1em);
            height: calc(100% - 1em);
            background-color: #3498db;
            border-radius: 4px;
        }
    </style>


</head>

<body>
    <div class="container">

        @if (session('err_msg'))
        <div class="alert alert-danger">
            {{ session('err_msg') }}
        </div>
        @endif
        <h1>お客様情報</h1>
        <form action="{{ route('company_form_process') }}" method="post">
        @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">会社名</label>
                <input style="width:250px;" type="text" name="customer_name" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                <input style="width:330px;" type="email" name="customer_email" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">電話番号</label>
                <input style="width:250px;" type="tel" name="customer_telephone" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">ご住所</label>
                <input style="width:500px;" type="text" name="customer_address" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>


            <button type="submit" class="btn btn-primary mb-3">登録</button>

        </form>

        <a class="btn btn-info" href="{{ route('setting_home') }}" role="button">戻る</a>

        <br>
        <p></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <h2>お客様情報一覧</h2>
                @if(session('err_msg2'))

                <p class="text-danger">{{ session('err_msg2') }}</p>

                @endif
                <table style="table-layout: fixed;" class="table table-striped">
                    <tr>
                        <th width="50">No.</th>
                        <th width="200">name</th>
                        <th width="280">email</th>
                        <th width="150">電話番号</th>
                        <th width="200">住所</th>
                        <th width="200">登録日</th>
                        <th width="100"></th>
                    </tr>


                    @foreach($company_member as $member)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $member->company_name }}</td>
                        <td>{{ $member->company_email }}</td>
                        <td>{{ $member->company_number }}</td>
                        <td>{{ $member->company_address }}</td>
                        <td>{{ $member->created_at }}</td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/company_form/delete/{{ $member->id }}'">削除</button></td>

                    </tr>

                    @endforeach

                </table>
            </div>



        </div>
    </div>








</body>

</html>
