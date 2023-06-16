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
        <h1>イベントの登録</h1>
        <form action="{{ route('event_register') }}" method="post">
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
                <label for="exampleFormControlInput1" class="form-label">イベント名</label>
                <input style="width:250px;" type="text" name="event_name" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">説明</label>
                <textarea name="event_explanation" class="form-control" id="exampleFormControlInput1" rows="4" cols="40"></textarea><br>
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
                <h2>イベントリスト</h2>
                @if(session('err_msg2'))

                <p class="text-danger">{{ session('err_msg2') }}</p>

                @endif
                <table class="table table-striped">
                    <tr>
                        <th>No.</th>
                        <th>event_name</th>
                        <th>詳細</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($event_lists as $member)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $member->event_name }}</td>
                        <td><a href="/event_list/detail/{{ $member->id }}">→</a></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/event_list/edit/{{ $member->id }}'">編集</button></td>
                        <form method="POST" action="{{ route('event_delete', $member->id) }}" onSubmit="return checkDelete()">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                        </form>
                    </tr>

                    @endforeach
                </table>
            </div>



        </div>




    </div>

</body>

</html>
