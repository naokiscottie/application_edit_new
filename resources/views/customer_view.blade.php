<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>顧客情報</title>
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

        <h1>各設備一覧</h1>

        <div class="row">

            <div class="col-md-10 col-md-offset-2">

                <table class="table table-striped">
                    <tr>
                        <th>No.</th>
                        <th>設備名</th>
                        <th>会社名</th>
                        <th>点検実施状況</th>
                        <th>設備記録</th>
                    </tr>
                    @foreach($lists as $list)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $list->field_name }}</td>
                        <td>{{ $list->company_name }}</td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/customer_field_list/{{ $list->id }}'">点検実施状況</button></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/customer_facility_list/{{ $list->id }}'">設備記録</button></td>
                    </tr>

                    @endforeach
                </table>
            </div>

        </div>

        <button type="button" class="btn btn-primary" onclick="location.href='/admin/logout'">ログアウト</button>


    </div>





</body>

</html>
