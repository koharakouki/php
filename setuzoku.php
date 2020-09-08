<?php
$s = new PDO("mysql:host=localhost;dbname=db1", "root", "root");
$s->query("INSERT INTO tb1 VALUES('K777', 'PHP太郎', 20)");
?>