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
        .hidden {
            display: none;
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

        <form action="{{ route('field_information_process') }}" method="post">
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
                <input style="width:250px;" type="text" name="field_name" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">住所</label>
                <input style="width:280px;" type="text" name="field_address" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">発電所出力[kW]</label>
                <input style="width:200px;" type="text" name="power" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">太陽光パネル容量[kW]</label>
                <input style="width:200px;" type="text" name="solar_power" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">契約日</label>
                <input style="width:200px;" type="date" name="contract_date" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">契約金額(千円)</label>
                <input style="width:200px;" type="text" name="contract_money" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <select style="width:300px;" class="form-select" aria-label="Default select example" name="customer_id" id="exampleFormControlInput1">
                    <option value="" selected>会社名を選択して下さい。</option>
                    @foreach ($company_member as $member)

                        <option value="{{ $member->id }}">{{ $member->company_name }}</option>

                    @endforeach
                </select>
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
                <h2>設備情報一覧</h2>
                @if(session('err_msg2'))

                <p class="text-danger">{{ session('err_msg2') }}</p>

                @endif
                <table style="table-layout: fixed;" class="table table-striped">
                    <tr>
                        <th width="50">No.</th>
                        <th width="150">設備名</th>
                        <th width="150">会社名</th>
                        <th width="200">住所</th>
                        <th width="100">発電出力[kW]</th>
                        <th width="100">太陽光パネル容量[kW]</th>
                        <th width="150">契約日</th>
                        <th width="100">契約金額[千円]</th>
                        <th width="100"></th>
                    </tr>

                    @php
                        $count = 0;
                    @endphp

                    @foreach($tests as $field_information)
                        @php
                            $count = $count + 1;
                        @endphp
                    <tr>

                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $field_information->field_name }}</td>
                        <td>{{ $field_information->company_name}}</td>
                        <td>{{ $field_information->field_address }}</td>
                        <td>{{ $field_information->power }}</td>
                        <td>{{ $field_information->solar_power }}</td>
                        <td>{{ $field_information->contract_date }}</td>
                        <td><a id="display_btn-{{ $count }}" class="btn btn-outline-primary">表示</a><span id="btn-text-{{ $count }}" class="hidden">:{{ $field_information->contract_money }}</span></td>
                        <form method="POST" action="{{ route('field_delete', $field_information->id) }}" onSubmit="return checkDelete()">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                        </form>

                    </tr>
                    @endforeach

                </table>

            </div>



        </div>

    </div>


    <script type="text/javascript">

    let number=@json($count);

    for(i=1;i<=number;i++){

    const btn = document.getElementById('display_btn-'+i);
    const btnText = document.getElementById('btn-text-'+i);

    btn.addEventListener('click', () => {

        if(btnText.classList.contains('hidden') == false){
            btnText.classList.toggle('hidden');
            btn.innerText = '表示';
            return;
        }

        password = prompt("パスワードを入力して下さい。");
        if(password == '1914'){
            btnText.classList.toggle('hidden');
            btn.innerText = '非表示';
        }else{
            alert("パスワードが違います。")
        }
    });

    }



    </script>





</body>

</html>




