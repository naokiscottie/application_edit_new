<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>事業場情報</title>
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

        <h1>事業場情報入力</h1>

        <form action="{{ route('facility_register') }}" method="post">
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
                <label for="exampleFormControlInput1" class="form-label">設備名</label>
                <select style="width:250px;" class="form-select" aria-label="Default select example" name="field_id" id="exampleFormControlInput1">
                    <option value="" selected>設備名を選択して下さい。</option>
                    @foreach ($field_lists as $member)

                        <option value="{{ $member->id }}">{{ $member->field_name }}</option>

                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">日付</label>
                <input style="width:120px;" type="date" name="date" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">イベント名</label>
                <select style="width:250px;" class="form-select" aria-label="Default select example" name="event_id" id="exampleFormControlInput1">
                    <option value="" selected>イベントを選択して下さい。</option>
                    @foreach ($event_lists as $member)

                        <option value="{{ $member->id }}">{{ $member->event_name }}</option>

                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">状況</label>
                <textarea name="remarks" class="form-control" id="exampleFormControlInput1" rows="4" cols="40"></textarea><br>
            </div>




            <button type="submit" class="btn btn-primary mb-3">登録</button>

        </form>

        <a class="btn btn-info" href="{{ route('home') }}" role="button">戻る</a>







    </div>



</body>

</html>




