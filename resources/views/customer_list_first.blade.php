<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

                @php
                $word=['0'=>'未実施','1'=>'実施済み']
                @endphp
                @if($month_checkings->first()!=null)

                    <h6>月次点検</h6>
                    <table class="table table-striped">
                        <tr>

                            <th>回数</th>
                            <th>実施状況</th>


                        </tr>
                        @foreach($month_checkings as $field_information)
                        <tr>


                            <td>{{ $field_information->times }}回目</td>
                            <td>{{ $word[$field_information->status] }}</td>


                        </tr>
                        @endforeach

                    </table>

                @endif

                @if($year_checkings->first()!=null)
                    <h6>年次点検</h6>
                    <table class="table table-striped">
                        <tr>
                            <th>回数</th>
                            <th>実施状況</th>


                        </tr>
                        @foreach($year_checkings as $field_information)

                        <tr>

                            <td>年毎</td>
                            <td>{{ $word[$field_information->status] }}</td>


                        </tr>
                        @endforeach

                    </table>
                @endif

                @if($panel_checkings->first()!=null)

                    <h6>パネル外観点検</h6>
                    <table class="table table-striped">
                        <tr>

                            <th>回数</th>
                            <th>実施状況</th>

                        </tr>
                        @foreach($panel_checkings as $field_information)
                        <tr>


                            <td>{{ $field_information->times }}回目</td>
                            <td>{{ $word[$field_information->status] }}</td>


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


                        </tr>
                        @foreach($panel_measurements as $field_information)

                        <tr>

                            <td>年毎</td>
                            <td>{{ $word[$field_information->status] }}</td>



                        </tr>
                        @endforeach

                    </table>
                @endif

                <a class="btn btn-info" href="{{ route('admin') }}" role="button">戻る</a>

            </div>
        </div>
    </div>

</body>

</html>
