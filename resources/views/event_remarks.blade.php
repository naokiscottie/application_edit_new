<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>event_detail</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {padding: 40px;}
    h3 {
        border-bottom: solid 3px #cce4ff;
        position: relative;
      }

    h3:after {
        position: absolute;
        content: " ";
        display: block;
        border-bottom: solid 3px #5472cd;
        bottom: -3px;
        width: 20%;
    }

    .sub_title {
        width:100px;
        padding: 0.2em;/*文字周りの余白*/
        color: #494949;/*文字色*/
        background:lightcyan;/*背景色*/
        border-left: solid 5px #58deff;/*左線（実線 太さ 色）*/
    }
    </style>
</head>

<body>

    <div class="container">
        <h3>{{ $events->first()->event_name }}</h3>
        <p class="sub_title">　詳 細 </p>
        <p>{{ $events->first()->remarks }}</p>

        <button type="button" class="btn btn-primary" onclick="location.href='/facility_list/{{ $events->first()->field_id }}'">戻る</button>
    </div>

</body>

</html>
