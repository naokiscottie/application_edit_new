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
        <h1>イベントリスト</h1>
        <form action="{{ route('event_register2') }}" method="post">
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


            <input type="hidden" name="id" value="{{ $event_list->id }}">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">イベント名</label>
                <input style="width:250px;" type="text" name="event_name" class="form-control" id="exampleFormControlInput1" placeholder="" value={{ $event_list->event_name }}>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">説明</label>
                <input style="width:500px;" type="text" name="event_explanation" class="form-control" id="exampleFormControlInput1" placeholder="" value={{ $event_list->event_explanation }}>
            </div>


            <button type="submit" class="btn btn-primary mb-3">登録</button>

        </form>

        <a class="btn btn-info" href="{{ route('event_setting') }}" role="button">戻る</a>

    </div>

</body>

</html>
