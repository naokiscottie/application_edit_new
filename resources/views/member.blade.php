<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録者一覧</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container">
        <p></p>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <h2>登録者一覧</h2>
                @if(session('err_msg'))

                <p class="text-danger">{{ session('err_msg') }}</p>

                @endif
                <table class="table table-striped">
                    <tr>
                        <th>No.</th>
                        <th>name</th>
                        <th>email</th>
                        <th>登録日</th>
                        <th></th>
                    </tr>
                    @foreach($members as $member)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->created_at }}</td>
                        <form method="POST" action="{{ route('user_delete', $member->id) }}" onSubmit="return checkDelete()">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                        </form>
                    </tr>
                    @endforeach
                </table>
            </div>



        </div>

        <a class="btn btn-info" href="{{ route('login.show') }}" role="button">戻る</a>
    </div>
    <script>
      function checkDelete(){
      if(window.confirm('削除してよろしいですか？')){
          return true;
      } else {
          return false;
      }
      }
    </script>






</body>
</html>
