<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <input type="text" placeholder="名前を入力" name="name">
    <input type="text" placeholder="コメントを入力" name="text">
    <input type="submit" value="送信">
  </form>

  <?php
  
    $name = $_POST["name"];  // 名前を取得
    $text = $_POST["text"];  // コメントを取得
    
    // nameとtextに値が入力されたとき
    if ($name != NULL && $text != NULL) {

      $f_name = "mission_3-1.txt";  // ファイル名を指定
      $handle = fopen($f_name, "a");  // ファイルを開く
      $f = file($f_name, FILE_IGNORE_NEW_LINES);  // ファイルの内容を取得
      
      $number = count($f) + 1;  // 次回投稿番号を取得
      $date = date("Y/m/d H:i:s");  // 現在の日時を取得

      $f_post = "$number<>$name<>$text<>$date";  // 投稿内容

      fwrite($handle, $f_post.PHP_EOL);  // ファイルに投稿
      fclose($handle);  // ファイルを閉じる

    } else {
      echo "名前とコメントを入力してください。";
    }
  
  ?>
</body>
</html>