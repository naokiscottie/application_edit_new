<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>setting</title>
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
        <form action="/newimgsend" method="post" enctype="multipart/form-data">
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

            <h1>画像をアップロード</h1>

            <div class="mb-3">
                <label class="form-label">撮影日</label>
                <input style="width:150px;" type="date" name="take_time" class="form-control">
            </div>


            <div class="mb-3">
                <label class="form-label">案件名</label>
                <select style="width:250px;" class="form-select" aria-label="Default select example" name="field_id" id="exampleFormControlInput1">
                    <option value="" selected>案件名を選択して下さい。</option>
                    @foreach ($company_member as $member)

                        <option value="{{ $member->id }}">{{ $member->field_name }}</option>

                    @endforeach
                </select>

            </div>

            <div class="mb-3">
                <label class="form-label">写真の選択</label>
                <input style="width:300px;" type="file" name="post_img[]" class="form-control" multiple>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">写真の説明</label>
                <textarea name="remarks" class="form-control" id="exampleFormControlInput1" rows="4" cols="40"></textarea><br>
            </div>

            <button type="submit" class="btn btn-primary mb-3">登録</button>

            <br><p></p>
            <a href="{{ route('home') }}" class="btn btn-info">戻る</a>

        </form>

    </div>

</body>
</html>
