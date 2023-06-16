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
        .title1{
            padding: 0.5em;/*文字周りの余白*/
            color: #010101;/*文字色*/
            background: #eaf3ff;/*背景色*/
            border-bottom: solid 3px #516ab6;/*下線*/
            width: 200px
        }
    </style>


</head>

<body>
    <div class="container">
        {{-- リダイレクトメッセージ --}}
        @if (session('err_msg'))
            <div class="alert alert-danger">
                {{ session('err_msg') }}
            </div>
        @endif

        <h1>各案件　設備情報設定変更</h1>
        <form action="{{ route('setting_update_register') }}" method="post">
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
                <input name="setting_id" type="hidden" value="{{ $id }}">
                <input id="field_id_hidden" name="field_id" type="hidden" value="{{ $setting_data->field_id }}">
                <label for="field_id_content" class="form-label">案件名</label>

                    @foreach ($field_informations as $member)

                        @if($member->id == $setting_data->field_id )
                            <p class="title1" id="field_id_content">{{ $member->field_name }}</p>
                        @endif

                    @endforeach

            </div>

            {{-- 年次点検有無 --}}
            <div class="mb-3">

                <div class="container1">
                    <label for="year_checking_id" class="form-label">年次点検</label>
                    <select style="width:150px;" name="year_checking" class="form-select" id="year_checking_id">

                        @if($setting_data->year_checking==1)
                            <option value="1" selected>有</option>
                            <option value="0">無</option>
                        @else
                            <option value="1">有</option>
                            <option value="0" selected>無</option>
                        @endif

                    </select>
                </div>

            </div>

            {{-- パネル外観点検有無 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="panel_checking_id" class="form-label">パネル外観点検</label>
                    <select style="width:150px;" name="panel_checking" class="form-select" id="panel_checking_id">

                        @if($setting_data->panel_checking==1)
                            <option value="1" selected>有</option>
                            <option value="0">無</option>
                        @else
                            <option value="1">有</option>
                            <option value="0" selected>無</option>
                        @endif

                    </select>

                </div>

            </div>

            {{-- パネル測定試験有無 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="panel_measurement_id" class="form-label">パネル測定試験</label>
                    <select style="width:150px;" name="panel_measurement" class="form-select" id="panel_measurement_id">

                        @if($setting_data->panel_measurement==1)
                            <option value="1" selected>有</option>
                            <option value="0">無</option>
                        @else
                            <option value="1">有</option>
                            <option value="0" selected>無</option>
                        @endif

                    </select>

                </div>

            </div>

            {{-- 月次点検周期 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="month_period_id" class="form-label">月次点検周期</label>

                    {{ Form::select(
                        'month_period',
                        [1=>'1ヶ月',2=>'2ヶ月', 3=>'3ヶ月'],
                        $setting_data->month_period,
                        ['class'=>'form-select', 'style'=>'width:150px','id'=>'month_period_id']
                    ) }}

                </div>

            </div>

            {{-- 現在の年度 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="year_id" class="form-label">年度</label>
                    <input style="width:100px;" type="number" value="{{ $setting_data->year }}" name="year" class="form-control" id="year_id" placeholder="">

                </div>

            </div>


            {{-- 開始月 --}}
            <div class="mb-3">

                <div class="container1">

                    <label for="month_id" class="form-label">年度</label>
                    <input style="width:100px;" type="number" value="{{ $setting_data->start_month }}" name="start_month" class="form-control" id="month_id" placeholder="">

                </div>

            </div>



            <button type="submit" class="btn btn-primary mb-3">更新</button>

        </form>

        <a class="btn btn-info" href="#" onclick="window.history.back(); return false" role="button">戻る</a>


    </div>


</body>

</html>
