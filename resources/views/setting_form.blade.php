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
        .container1{
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            gap: 30px;
            align-items: center;
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

        <h1>各案件　設備情報設定</h1>
        <form action="{{ route('setting_register') }}" method="post">
        @csrf
            {{-- バリデーションのエラーメッセージの受け取り --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- 案件名 --}}
            <div class="mb-3">

                <label for="field_id_content" class="form-label">案件名</label>
                <select style="width:300px;" class="form-select" aria-label="Default select example" name="field_id" id="field_id_content">
                    <option value="" selected>案件名を選択して下さい。</option>
                    @foreach ($field_informations as $member)

                        <option value="{{ $member->id }}">{{ $member->field_name }}</option>

                    @endforeach
                </select>

            </div>

            {{-- 年次点検有無 --}}
            <div class="mb-3">

                <div class="container1">
                    <label for="year_checking_id" class="form-label">年次点検</label>
                    <select style="width:150px;" name="year_checking" class="form-select" id="year_checking_id">
                        <option value="" selected>有無を選択</option>
                        <option value="1">有</option>
                        <option value="0">無</option>

                    </select>
                </div>

            </div>

            {{-- パネル外観点検有無 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="panel_checking_id" class="form-label">パネル外観点検</label>
                    <select style="width:150px;" name="panel_checking" class="form-select" id="panel_checking_id">
                        <option value="" selected>有無を選択</option>
                        <option value="1">有</option>
                        <option value="0">無</option>
                    </select>

                </div>

            </div>

            {{-- パネル測定試験有無 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="panel_measurement_id" class="form-label">パネル測定試験</label>
                    <select style="width:150px;" name="panel_measurement" class="form-select" id="panel_measurement_id">
                        <option value="" selected>有無を選択</option>
                        <option value="1">有</option>
                        <option value="0">無</option>
                    </select>

                </div>

            </div>

            {{-- 月次点検周期 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="month_period_id" class="form-label">月次点検周期</label>
                    <select style="width:150px;" name="month_period" class="form-select" id="month_period_id">

                        <option value="" selected>点検頻度を選択</option>
                        <option value="1">1ヶ月</option>
                        <option value="2">2ヶ月</option>
                        <option value="3">3ヶ月</option>

                    </select>

                </div>

            {{-- 現在の年度 --}}
            </div>
            @php
                $year = date('Y');
            @endphp


            <div class="mb-3">

                <div class="container1">

                    <label for="year_id" class="form-label">年度</label>
                    <input style="width:100px;" type="number" value="{{ $year }}" name="year" class="form-control" id="year_id" placeholder="">

                </div>

            </div>

            {{-- 点検の開始月 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="month_id" class="form-label">点検の開始月</label>
                    <input style="width:100px;" type="number" name="start_month" class="form-control" id="month_id" placeholder="">

                </div>

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

                @php
                    $word=['0'=>'無','1'=>'有']
                @endphp

                <table style="table-layout: fixed;" class="table table-striped">
                    <tr>
                        <th width="50">No.</th>
                        <th width="300">設備名</th>
                        <th width="100">年次点検</th>
                        <th width="100">パネル外観点検</th>
                        <th width="100">パネル測定試験</th>
                        <th width="100">月次点検周期</th>
                        <th width="80">年度</th>
                        <th width="80">開始月</th>
                        <th width="100"></th>
                        <th width="100"></th>
                    </tr>
                    @foreach($tests as $member)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $member->field_name }}</td>
                        <td>{{ $word[$member->year_checking] }}</td>
                        <td>{{ $word[$member->panel_checking] }}</td>
                        <td>{{ $word[$member->panel_measurement] }}</td>
                        <td>{{ $member->month_period }}</td>
                        <td>{{ $member->year }}</td>
                        <td>{{ $member->start_month }}</td>

                        <form method="POST" action="{{ route('setting_delete', $member->id) }}" onSubmit="return checkDelete()">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                        </form>

                        <td><button type="button" class="btn btn-primary" onclick="location.href='/setting_update_view/{{ $member->id }}'">編集</button></td>
                    </tr>

                    @endforeach
                </table>
            </div>



        </div>
    </div>






</body>

</html>
