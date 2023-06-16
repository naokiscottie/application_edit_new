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
        <h1>{{ $name }}　点検実施状況</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-2">

                @if(session('err_msg'))

                <p class="text-danger">{{ session('err_msg') }}</p>

                @endif
                @php
                $word=['0'=>'未実施','1'=>'実施済み']
                @endphp

                @if($month_checkings->first()!=null)

                    <h6>月次点検</h6>
                    <table class="table table-striped">
                        <tr>

                            <th>回数</th>
                            <th>実施期間</th>
                            <th>実施状況</th>
                            <th>チェック</th>
                            <th></th>

                        </tr>
                        @php
                            $i = $start_month
                        @endphp
                        @foreach($month_checkings as $field_information)
                        <tr>


                            <td>{{ $field_information->times }}回目</td>


                            <td>


                                @for ($val = 0; $val < $month_period; $val++)

                                    @if($i + $val <= 12)
                                    {{ $i + $val }}月
                                    @else
                                    {{ $i + $val - 12 }}月
                                    @endif

                                    @if($val != $month_period -1)
                                    ,
                                    @endif
                                @endfor



                            </td>




                            <td>{{ $word[$field_information->status] }}</td>

                            <form method="POST" action="{{ route('record_update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="user_id_1[{{ $field_information->id }}]" value="0">
                                @if($field_information->status == 1)
                                <td><input type="checkbox" checked="checked" name="user_id_1[{{ $field_information->id }}]" value="1"></td>
                                @else
                                <td><input type="checkbox" name="user_id_1[{{ $field_information->id }}]" value="1"></td>
                                @endif
                                <td><button class="btn btn-primary" type="submit">更新</button></td>
                            </form>
                        </tr>
                        @php
                            $i = $i + $month_period;
                        @endphp
                        @endforeach

                    </table>

                @endif

                @if($year_checkings->first()!=null)
                    <h6>年次点検</h6>
                    <table class="table table-striped">
                        <tr>
                            <th>回数</th>
                            <th>実施状況</th>
                            <th>チェック</th>
                            <th></th>

                        </tr>
                        @foreach($year_checkings as $field_information)

                        <tr>

                            <td>年毎</td>
                            <td>{{ $word[$field_information->status] }}</td>
                            <form method="POST" action="{{ route('record_update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="user_id_2[{{ $field_information->id }}]" value="0">
                                @if($field_information->status == 1)
                                <td><input type="checkbox" checked="checked" name="user_id_2[{{ $field_information->id }}]" value="1"></td>
                                @else
                                <td><input type="checkbox" name="user_id_2[{{ $field_information->id }}]" value="1"></td>
                                @endif
                                <td><button class="btn btn-primary" type="submit">更新</button></td>
                            </form>

                        </tr>
                        @endforeach

                    </table>
                @endif

                @if($panel_checkings->first()!=null)
                    <h6>パネル外観点検</h6>
                    <table class="table table-striped">
                        <tr>

                            <th>回数</th>
                            <th>実施期間</th>
                            <th>実施状況</th>
                            <th>実施期間</th>
                            <th>チェック</th>
                            <th></th>

                        </tr>
                        @php
                            $i = $start_month;
                            $counter = 0;
                        @endphp
                        @foreach($panel_checkings as $field_information)
                        <tr>


                            <td>{{ $field_information->times }}回目</td>

                            @if($counter == 0)
                                <td>{{ $i }}月〜
                                @if($i + 5 <= 12)
                                    {{ $i + 5 }}月
                                @else
                                    {{ $i + 5 - 12 }}月
                                @endif
                                </td>

                                @php
                                    $counter = $counter + 1;
                                @endphp
                            @else
                                <td>
                                    @if($i + 6 <= 12)
                                    {{ $i + 6 }}月〜
                                    @else
                                    {{ $i + 6 - 12 }}月〜
                                    @endif

                                    {{ $i + 11 - 12 }}月
                                </td>
                            @endif

                            <td>{{ $word[$field_information->status] }}</td>
                            <form method="POST" action="{{ route('record_update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="user_id_3[{{ $field_information->id }}]" value="0">
                                @if($field_information->status == 1)
                                <td><input type="checkbox" checked="checked" name="user_id_3[{{ $field_information->id }}]" value="1"></td>
                                @else
                                <td><input type="checkbox" name="user_id_3[{{ $field_information->id }}]" value="1"></td>
                                @endif
                                <td><button class="btn btn-primary" type="submit">更新</button></td>
                            </form>

                        </tr>
                        @endforeach

                    </table>

            @endif

            @if($panel_measurements->first()!=null)
                <h6>パネル精密点検</h6>
                    <table class="table table-striped">
                        <tr>
                            <th>回数</th>
                            <th>実施状況</th>
                            <th>チェック</th>
                            <th></th>

                        </tr>
                        @foreach($panel_measurements as $field_information)

                        <tr>

                            <td>年毎</td>
                            <td>{{ $word[$field_information->status] }}</td>
                            <form method="POST" action="{{ route('record_update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="user_id_4[{{ $field_information->id }}]" value="0">
                                @if($field_information->status == 1)
                                <td><input type="checkbox" checked="checked" name="user_id_4[{{ $field_information->id }}]" value="1"></td>
                                @else
                                <td><input type="checkbox" name="user_id_4[{{ $field_information->id }}]" value="1"></td>
                                @endif
                                <td><button class="btn btn-primary" type="submit">更新</button></td>
                            </form>


                        </tr>
                        @endforeach

                    </table>
                @endif

                <a class="btn btn-info" href="{{ route('field_list') }}" role="button">戻る</a>

            </div>
        </div>
    </div>

</body>

</html>
