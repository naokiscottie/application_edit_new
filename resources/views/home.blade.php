<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ホーム画面</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .A{
            display:flex;
            padding: 0px 5px;
            border: 0px solid;
            border-color: orange;
            border-radius: 20px;
        }
        .B{
            width: 50%;
            text-align: center;
        }
        .C{
            width: 50%;
            text-align: center;
        }
        .D{
            padding: 20px;
        }
        ul {
            list-style: none;
        }



    </style>
</head>
<body>

    <div class="container">

        <div class="d-grid gap-2">

            <div class="mt-1">
                <x-alert type="success" :session="session('login_success')"/>
                <!--
                    以下の文をコンポーネントにより省略
                @if (session('login_success'))
                    <div class="alert alert-success">
                        {{ session('login_success') }}
                    </div>
                @endif
                -->
            </div>

            <div class="page-header">
                <h1 style="border-bottom: 1px solid #426579;border-left: 10px solid #426579;padding: 7px;">MENU</h1>
            </div>

            <ul>
                <li>name：{{ Auth::user()->name }}</li>
                <li>login_mail：{{ Auth::user()->email }}</li>
            </ul>

            <div class="A">
                <div style="padding: 25px;margin: 10px" class="B">
                    <a class="D btn btn-outline-primary" href="{{ route('field_list') }}"><i class="fa-solid fa-graduation-cap fa-3x"></i></a>
                </div>
                <div style="padding: 25px;margin: 10px" class="C">
                    <a class="D btn btn-outline-success" href="{{ route('picture_list') }}"><i class="fa-solid fa-leaf fa-3x"></i></a>
                </div>
            </div>

            <div style="display:flex;padding: 0px 5px;;">
                <div class="B">
                    <p>field_list</p>
                </div>
                <div class="C">
                    <p>pictures</p>
                </div>
            </div>

            <div class="A">
                <div style="padding: 25px;margin: 10px" class="B">
                    <a href="/create3" class="D btn btn-outline-dark"><i class="fa-solid fa-images fa-3x"></i></a>
                </div>
                <div style="padding: 25px;margin: 10px" class="C">
                    <a class="D btn btn-outline-primary" href="{{ route('facility_information') }}"><i class="fa-solid fa-desktop fa-3x"></i></a>
                </div>
            </div>

            <div style="display:flex;padding: 0px 5px;;">
                <div class="B">
                    <p>picture_upload</p>
                </div>
                <div class="C">
                    <p>note</p>
                </div>
            </div>

            <div class="A">
                <div style="padding: 25px;margin: 10px" class="B">
                    <a class="D btn btn-outline-primary" href="{{ route('setting_home') }}"><i class="fa-solid fa-desktop fa-3x"></i></a>
                </div>
                <div style="padding: 25px;margin: 10px" class="C">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="D btn btn-outline-danger"><i class="fa-solid fa-power-off fa-3x"></i></button>
                    </form>
                </div>
            </div>

            <div style="display:flex;padding: 0px 5px;;">
                <div class="B">
                    <p>setting/documents</p>
                </div>
                <div class="C">
                    <p>logout</p>
                </div>
            </div>

        </div>


    </div>

<script src="https://kit.fontawesome.com/3a89fbfd00.js" crossorigin="anonymous"></script>
</body>
</html>
