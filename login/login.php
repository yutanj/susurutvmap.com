<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once('database.php'); // データベースアクセスファイル読み込み
//require_once('auth.php'); // ログイン認証ファイル読み込み

$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();

$errorMessage = ""; // エラーメッセージ初期化
// ログイン処理
if ($_POST['mode']=="login") {
  if(!empty($_POST['email']) && !empty($_POST['password'])){
    if (login($_POST['email'], $_POST['password'], $dbh)){
      $_SESSION['user_id'] = login($_POST['email'], $_POST['password'], $dbh);
      header("Location: ../mymap/home2.php");
    // ログイン失敗時の表示
    } else {
      $errorMessage = "ログインに失敗しました。";
    }
  } else {
    $errorMessage = "メールアドレスとパスワードを入力してください。";
  }
}
?>
<?php if($login){ ?>
  echo "ログインしました。";
<?php } else { ?>
  <?php //echo $errorMessage; ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="signup/style.css">
      <link rel="stylesheet" href="../menu.css">
      <title></title>
    </head>
    <body>
      <header>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <nav class="NavMenu">
          <ul>
            <li><a href="../top_page_production.php">ホーム</a></li>
            <li><a href="about_website.html">SUSURU TV. map の使い方</a></li>
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
        <form class="" action="login.php" method="post">
          <h1>ログイン</h1>
          <br>

          <div class="control">
            <label for="name">ユーザー名</label>
            <input type="text" name="email" value="" placeholder="メールアドレスを入力して下さい。">
          </div>

          <div class="control">
            <label for="name">パスワード</label>
            <input type="password" name="password" value="" placeholder="パスワードを入力して下さい。">
            <?php echo $errorMessage; ?>
          </div>

          <input type="hidden" name="mode" value="login">
          <div class="control">
            <input type="submit" name="login" value="ログイン">
          </div>

        </form>
        <a href="signup/entry.php">初めてご利用の方はこちらから（新規会員登録）</a>
      </div>

      <!--
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
      </div>
    -->
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
<?php } ?>
