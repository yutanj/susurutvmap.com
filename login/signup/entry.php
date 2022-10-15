<?php
require("../../dbc.php");
session_start();
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();
if (!empty($_POST)) {
    /* 入力情報の不備を検知 */
    if ($_POST['email'] === "") {
        $error['email'] = "blank";
    }
    if ($_POST['password'] === "") {
        $error['password'] = "blank";
    }

    /* メールアドレスの重複を検知 */
    if (!isset($error)) {
        $member = $dbh->prepare('SELECT COUNT(*) as cnt FROM members WHERE email=?');
        $member->execute(array(
            $_POST['email']
        ));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }

    /* エラーがなければ次のページへ */
    if (!isset($error)) {
        $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
        header('Location: check.php');   // check.phpへ移動
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>アカウント作成</title>
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../menu.css">
</head>
<body>
  <header>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <nav class="NavMenu">
      <ul>
        <li><a href="../top_page_production.php">ホーム</a></li>
        <li><a href="../../about_website.html">SUSURU TV. map の使い方</a></li>
        <li><a href="../login/login.php">ログイン</a></li>
        <li><a href="../login/signup/entry.php">新規会員登録</a></li>
        <li><a href="https://docs.google.com/forms/d/e/1FAIpQLScBeeJlCakzFg-Y3H_bQVE7KnjgCuIa_3kxGSuSvndNFFInpQ/viewform?usp=sf_link">お問い合わせ</a></li>
      </ul>
    </nav>

    <!-- ハンバーガーメニュー -->
    <div class="Toggle">
      <span class="toggle-span"></span>
      <span></span>
      <span></span>
    </div>
  </header>
    <div class="content">
        <form action="" method="POST">
            <h1>アカウント作成</h1>
            <p>当サービスをご利用するために、次のフォームに必要事項をご記入ください。</p>
            <br>

            <div class="control">
                <label for="name">ユーザー名</label>
                <input id="name" type="text" name="name">
            </div>

            <div class="control">
                <label for="email">メールアドレス<span class="required">必須</span></label>
                <input id="email" type="email" name="email">
                <?php if (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                    <p class="error">＊メールアドレスを入力してください</p>
                <?php elseif (!empty($error["email"]) && $error['email'] === 'duplicate'): ?>
                    <p class="error">＊このメールアドレスはすでに登録済みです</p>
                <?php endif ?>
            </div>

            <div class="control">
                <label for="password">パスワード<span class="required">必須</span></label>
                <input id="password" type="text" name="password">
                <?php if (!empty($error["password"]) && $error['password'] === 'blank'): ?>
                    <p class="error">＊パスワードを入力してください</p>
                <?php endif ?>
            </div>

            <div class="control">
                <button type="submit" class="btn">確認する</button>
            </div>
        </form>
        <a href="../login.php">すでにアカウントをお持ちの方（ログイン）</a>
    </div>
    <script>
    // ハンバーガー
    $(function () {
        $('.Toggle').click(function () {
            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
               $('.NavMenu').addClass('active');
            } else {
              $('.NavMenu').removeClass('active');
            }
        });
    });
    </script>
</body>
</html>
