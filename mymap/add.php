<?php
session_start();
//echo $_SESSION['addfav'];
require_once('../dbc.php');
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();
//header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

//home.phpからのアクセス以外を飛ばす
if (!isset($_SESSION['addfav'])) {
    header('Location: home2.php');
    exit();
}

//add.phpからフォームが送信されたら↓
if (!empty($_POST['check'])) {
    // 入力情報をデータベースに登録
    $statement = $dbh->prepare("INSERT INTO favorites SET user_id=?, stores_name=?, stores_address=?, video_id=?, youtube_url=?, latitude=?, longitude=?");
    $statement->execute(array(
        $_SESSION['user_id'],
        $_SESSION['stores_name'],
        $_SESSION['stores_address'],
        $_SESSION['video_id'],
        $_SESSION['youtube_url'],
        $_SESSION['latitude'],
        $_SESSION['longitude']
    ));

    echo 'SUCCESS';
    unset($_SESSION['addfav']);   // セッションを破棄
    //unset($_SESSION['user_id']);
    unset($_SESSION['stores_name']);
    unset($_SESSION['stores_address']);
    unset($_SESSION['video_id']);
    unset($_SESSION['youtube_url']);
    unset($_SESSION['latitude']);
    unset($_SESSION['longitude']);
    header('Location: home2.php');   // thank.phpへ移動
    exit();
}

$posted_url = $_SESSION['addfav'];
//echo $posted_url;
//echo $_SESSION['addfav'];
$posted_url = implode($posted_url);

/*
$dsn = 'mysql:dbname=ramen_maps;host=localhost;charset=utf8';
$user = 'root';
$password = '785HuezRS';
*/
/*$db_link = mysqli_connect( 'mysql64.conoha.ne.jp', '4rgdb_yutadb', 'Yuta_0224', '4rgdb_ramenmap');*/
$db_link = mysqli_connect( 'localhost', 'root', '785HuezRS', 'ramen_maps');

if( mysqli_connect_errno($db_link) ) {
	echo mysqli_connect_errno($db_link) . ' : ' . mysqli_connect_error($db_link);
}

mysqli_set_charset($db_link, 'utf8');

var_dump(mysqli_real_escape_string($db_link, $posted_url));

$v_id_sample = "LaFiSxDIIQs";
//$ull = $dbc->videoidToGetColumn($v_id_sample);
$video_id = $dbc->urlToVideoid($posted_url);
//echo $video_id;
$result_json = $dbc->videoidToGetColumn($video_id);
//echo $result_json;
$result_array = json_decode($result_json, true);
//echo $result_array;

$_SESSION['stores_name'] = $result_array["stores_name"];
$_SESSION['stores_address'] = $result_array["stores_address"];
$_SESSION['video_id'] = $result_array["video_id"];
$_SESSION['youtube_url'] = $result_array["youtube_url"];
$_SESSION['latitude'] = $result_array["latitude"];
$_SESSION['longitude'] = $result_array["longitude"];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="add.php" method="post">
      <input type="hidden" name="check" value="checked">
      <h1>入力情報の確認</h1>

      <div class="control">
        <?php
          $message = <<<EOF
          <a><img src="http://img.youtube.com/vi/{$_SESSION['video_id']}/mqdefault.jpg"></a>

          EOF;
          echo $message;
        ?>
      </div>

      <?php// echo  $result_array["video_id"];?>
      <div class="control">
          <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($result_array["stores_name"], ENT_QUOTES); ?></span></p>
      </div>

      <br>
      <button type="submit" class="btn next-btn">Myマップに登録する</button>
    </form>

  </body>
</html>
