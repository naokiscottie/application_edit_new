<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">

        {{ $result }}
        <br><p></p>
        <a class="btn btn-info" href="{{ route('test2') }}" role="button">次へ</a>
        <br><p></p>
        <a class="btn btn-info" href="{{ route('login.show') }}" role="button">戻る</a>
        <br><p></p>

    </div>


</body>

</html>
