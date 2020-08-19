<?php

  // DB接続

  $dsn = 'dsn';
  $user = 'user';
  $password = 'password';
  
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


  // 投稿修正

  $id = 0;
  $name = 'yuji';
  $comment = 'my first post';
  $sql = 'UPDATE tbtest SET name=:name, comment=:comment WHERE id=:id';

  $stmt = $pdo -> prepare($sql);
  $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
  $stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
  $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
  $stmt -> execute();


  // 投稿表示

  $sql = "SELECT * FROM tbtest";

  $stmt = $pdo -> query($sql);
  $stmt -> execute();

  $results = $stmt -> fetchAll();

  foreach ($results as $result) {
    echo "{$result['id']}, {$result['name']}, {$result['comment']}<br>";
  }


?>