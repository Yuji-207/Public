<?php

  // DB接続

  $dsn = 'dsn';
  $user = 'user';
  $password = 'password';

  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


  // テーブル作成

  $sql = "CREATE TABLE IF NOT EXISTS tbtest421 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name char(32),
    comment TEXT
  );";

	$stmt = $pdo->query($sql);


?>