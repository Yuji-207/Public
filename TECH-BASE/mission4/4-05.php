<?php

  // DB接続

  $dsn = 'dsn';
  $user = 'user';
  $password = 'password';
  
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


  // 投稿

  $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
  $sql -> bindParam(':name', $name, PDO::PARAM_STR);
  $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);

  $name = 'Yuji';
  $comment = 'first post';
  
  $sql -> execute();


?>