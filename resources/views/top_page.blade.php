<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>Matsumoto Electric Management Office</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="ここにサイト説明を入れます">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.5.4/vegas.min.css">
        <link href="{{ asset('/css/home_css.css') }}" rel="stylesheet">

    </head>

    <body class="home">

        <!--メイン画像と２つのボタン-->
        <div id="mainimg">
            <div id="mainimg-title">
                <h1><span>Matsumoto Electric Management System</span></h1>
            </div>
            <div id="mainimg-inner">
                <div><a href="{{ route('admin_login') }}">customer<span><i class="far fa-edit"></i>check</span></a></div>
                <div><a href="{{ route('login.show') }}">　owner　<span><i class="fas fa-search"></i>tools</span></a></div>
            </div>
        </div>

        <div id="container">


            <main>

                <section>

                    <h2>matsumoto_electiric_company application</h2>

                    <h3>設備情報閲覧サービス</h3>
                    <p>このサービスは松本電気管理事務所のシステム管理webアプリケーションです。</p>
                    <p>customer check:お客様設備情報</p>
                    <p>owner tools:設備管理ツール（こちらは弊社専用となるため，お客様はご利用頂けません。ご了承下さい。)</p>
                    <h3>サービス内容</h3>
                    <p>松本電気管理事務所では、お客様の設備情報をリアルタイムで確認できるシステムを構築しています。法定点検の進捗状況，設備に関する記録についてご確認頂けます。</p>
                    <br>
                    <div style="text-align:right;"><a style="background-color:#a6f5a6;" href="https://matsumoto-engineering-service.com">ホームページへ</a></div>

                </section>


            </main>

            <footer>
                <span class="pr">松本電気管理事務所</span>
            </footer>

        </div>
        <!--/#container-->

        <!--jQueryの読み込み-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!--スライドショー（vegas）-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vegas/2.5.4/vegas.min.js"></script>
        <script src="{{ asset('/js/home/vegas.js') }}"></script>

        <!--job4用のスクリプト-->
        <script src="{{ asset('/js/home/main.js') }}"></script>

        <!--ページの上部へ戻るボタン-->
        <div class="pagetop"><a href="#">↑</a></div>

    </body>
</html>
