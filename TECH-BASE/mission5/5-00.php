<?php


  // DB接続

  $dsn = 'dsn';
  $user = 'user';
  $password = 'password';

  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


  // テーブル作成

  $sql = 'CREATE TABLE IF NOT EXISTS mission5 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(32),
    comment TEXT,
    password CHAR(255),
    date DATETIME ON UPDATE CURRENT_TIMESTAMP
  )';

  $stmt = $pdo->query($sql);


  // テーブルを表示

  $sql = 'SHOW CREATE TABLE mission5';
  $result = $pdo -> query($sql);
  
	foreach ($result as $row){
		echo $row[1], '<br>';
  }


?>