<?php

// データベース情報などの読み込み
require_once("date/db_info.php");

// データベースへ接続、データベース選択
$s = new PDO("mysql:host=$SERV;dbname=$DBNM", $USER, $PASS);

// スレッドグループ番号(gu)を取得し$gu_dに代入
$gu_d = $_GET["gu"];

// $gu_dに数字以外が含まれていたら処理を中止
if(preg_match("/[^0-9]/", $gu_d)){
  print <<<eot1
    不正な値が含まれています<br>
    <a href="keizi_top.php">ここをクリックしてスレッド一覧に戻ってください</a>
  eot1;

  // $gu_dに数字以外が含まれていない、正常な値での処理
  elseif(preg_match("/[0-9]/", $gu_d)){

    // 名前とメッセージを取得してタグを削除
    $na_d = isset($_GET["na"]) ? htmlspecialchars($_GET["na"]) : null;
    $na_d = isset($_GET["me"]) ? htmlspecialchars($_GET["me"]) : null;

    // IPアドレス取得
    $ip = getenv("REMOTE_ADDR");

    // スレッドグループ番号(gu)に一致するレコードを表示
    $re = $s->query("SELECT * FROM tbj0 WHERE guru = $gu_d ");
    $kekka = $re->fetch();

    // スレッド内容の表示文字列$sure_comを作成
    $sure_com = "[".$gu_d." ".$kekka[0]."]";
    
    // スレッド表示のタイトル等書き出し
    print <<<eot2
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>SQLカフェ</title>
      </head>

      <body style="background-color: silver">
        <div style="color: purple; font-size: 35pt">
          $sure_com　スレッド！
        </div>
        <br>
        <div style="font-size: 18pt">$sure_comのメッセージ</div>
    eot2;

    // 名前($na_d)が入力されていなければtbj1にレコード挿入
    if($na_d<>""){
      $s->query("INSERT INTO tbj1 VALUES (0, '$na_d', '$me_d', now(), $gu_d, '$ip')");
    }

    // 水平線表示
    print "<hr>";

    // 日時の順にレスデータ表示
    $re = $s->query("SELECT * FROM tbj1  WHERE guru = $gu_d ORDER BY niti");

    $n = 1;
    

      </body>
    
  }
}