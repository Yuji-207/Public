<?php

  // DB接続

  $dsn = 'dsn';
  $user = 'user';
  $password = 'password';
  
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


  // 投稿表示

  $sql = "SELECT * FROM tbtest";
  $stmt = $pdo -> query($sql);
  $results = $stmt -> fetchAll();

  foreach ($results as $result) {
    echo "{$result['id']}, {$result['name']}, {$result['comment']}, {$result['password']}, {$result['date']}<br>";
  }


?>