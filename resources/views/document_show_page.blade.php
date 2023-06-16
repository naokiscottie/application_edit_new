<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ホーム画面</title>

    <style>
          /* クリックで表示させるテキストを隠す */
          .hidden {
            display: none;
          }
          body {padding: 10px;}
          h1 {
              position: relative;
              padding: .75em 1em .75em 1.5em;
              border: 1px solid #ccc;
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

    <h1>書類一覧</h1>

    @if(session('err_msg2'))

    <p class="text-danger">{{ session('err_msg2') }}</p>

    @endif

    <div class="row">

        <div class="col-md-10 col-md-offset-2">


            <table class="table table-striped">
                    <tr>
                        <th>No.</th>
                        <th>書類名</th>
                        <th>書類の種類</th>
                        <th>書類の表示</th>
                        <th>削除</th>
                        <th>備考</th>
                    </tr>
                    @php
                        $count = 0;
                    @endphp

                    @foreach ($documents as $document)

                    @php
                        $count = $count + 1;
                    @endphp

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->document_name }}</td>
                        <td>{{ $document->document_category }}</td>
                        <td><a href="/storage/test_2/{{ $document -> file_name }}" target="_blank">クリック</a></td>
                        <td><a type="button" class="btn btn-primary" onclick="location.href='/document_list/delete/{{ $document->id }}/{{ $document -> field_id }}'">削除</a></td>
                        <td><a id="btn2-{{ $count }}" class="btn btn-outline-primary">表示</a><span id="btn2-text-{{ $count }}" class="hidden">：{{ $document->document_remarks }}</span></td>
                    </tr>

                    @endforeach



            </table>

        </div>

    </div>









    <br>
    <p></p>

    <a class="btn btn-info" href="{{ route('document_list') }}" role="button">戻る</a>

</div>


<script type="text/javascript">

let number=@json($count);
for(i=1;i<=number;i++){

    const btn2 = document.getElementById('btn2-'+i);
    const btn2Text = document.getElementById('btn2-text-'+i);

    btn2.addEventListener('click', () => {
    // ボタンクリックでhiddenクラスを付け外しする
    btn2Text.classList.toggle('hidden');
    if(btn2.innerText == '非表示'){
        btn2.innerText = '表示';
    }else{
        btn2.innerText = '非表示';
    }
    });

}

</script>




</body>


</html>
