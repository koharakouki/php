<?php

// データベース情報などの読み込み
require_once("date/db_info.php");

// データベースへ接続、データベース選択
$s = new PDO("mysql:host=$SERV;dbname=$DBNM", $USER, $PASS);

// タイトルの表示
print <<<eot1
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SQLカフェ</title>
  </head>

  <body>
    <span style="color: purple; font-size: 35pt">
      SQLカフェ掲示板
    </span>
    <p>見たいスレッドの番号をクリックしてください</p>
    <hr>
    <div style="font-size: 20pt">(スレッド一覧)</div>
eot1;

// クライアントのIPアドレス取得
$ip = getenv("REMOTE_ADDR");

// スレッド名の変数$su_dにデータがあればtbj0に挿入
$su_d = isset($_GET["su"]) ? htmlspecialchars($_GET["su"]) : null; //三項演算子
if($su_d<>""){
  $s->query("INSERT INTO tbj0 (sure, niti, aipi) VALUES ('$su_d', now(), '$ip'");
}

$re = $s->query("SELECT * FROM tbj0");
while($kekka = $re->fetch()){
  print <<<eo2
    <a href="keizi.php?gu=$kekka[0]">$kekka[0] $kekka[1]</a>
    <br>
    $kekka[2]作成<br><br>
eo2;
}

// スレッド作成用フォーム、検索フォームへのリンク
print <<<eo3
<hr>
<div style="font-size: 20pt">(スレッド作成)</div>
  新しいスレッドを作るときは、ここでどうぞ！
<br>
<form method="GET" action="keizi.top.php">
  新しく作るスレッドのタイトル
  <input type="text" name="su" size="50">
  <div><input type="submit" value="作成"></div>
</form>
<hr>
<span style="font-size: 20pt">(メッセージ検索)</span>
<a href="keizi_search.php">検索するときはここをクリック</a>
<hr>
</body>
</html>
eo3;

?>