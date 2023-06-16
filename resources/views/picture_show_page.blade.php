<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ホーム画面</title>

    <style>


        body {
            margin: 0;
            padding: 0px;
        }


        .box {
            display:flex;
            flex-direction: row;
            align-items: center;
            justify-content:space-evenly;
            flex-basis: 30%;

            margin: 30px 10px 0px 10px;

        }


        .text {
            text-align: left;
            align-items: left;
        }


        h6 {
            position: relative;
            padding: 0.25em 0;
        }
        h6::after{
            content: "";
            display: block;
            height: 4px;
            background: -webkit-linear-gradient(to right, rgb(90, 230, 125), transparent);
            background: linear-gradient(to right, rgb(90, 230, 221), transparent);
        }


        .pict {
            width: 50%;
            margin-right: 3%;
        }


        .pict img {
            width: 100%;
            height:auto;
        }

    </style>


</head>

<body>

<div class="container">
    @if(session('err_msg2'))

    <p class="text-danger">{{ session('err_msg2') }}</p>

    @endif


    @if($pictures -> first())
    @foreach ($pictures as $picture)
        <div class="box">

            <div class="pict"><img src="/storage/test/{{ $picture -> file_name }}" alt=""></div>
            <div class="text">
                <h6>撮影日：{{ $picture -> picture_date }}</h6>
                <p>アップロード日時：</p>
                <p>{{ $picture -> created_at }}</p>
                <p>{{ $picture -> remarks }}</p>
                <button type="button" class="btn btn-primary" onclick="location.href='/picture_list/delete/{{ $picture->id }}/{{ $picture -> field_id }}'">写真の削除</button>
            </div>
        </div>
    @endforeach
    @else
    <p>現在アップロードされている写真はありません。</p>
    @endif




    <br>
    <p></p>

    <a class="btn btn-info" href="{{ route('picture_list') }}" role="button">戻る</a>

</div>


</body>

</html>
