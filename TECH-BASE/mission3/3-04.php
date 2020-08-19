<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<!-- 投稿フォーム -->
  <form action="" method="POST">
    <input type="text" placeholder="名前を入力" name="name">
    <input type="text" placeholder="コメントを入力" name="text">
    <input type="submit" value="投稿" name="form_1">
  </form>
  <!-- 修正フォーム -->
  <form action="" method="POST">
    <input type="number" placeholder="投稿番号を入力" name="number">
    <input type="text" placeholder="コメントを入力" name="text">
    <input type="submit" value="修正" name="form_2">
  </form>
  <!-- 削除フォーム -->
  <form action="" method="POST">
    <input type="number" placeholder="投稿番号を入力" name="number">
    <input type="submit" value="削除" name="form_3">
  </form>

  <?php
  

    // 変数宣言

    $form_1 = $_POST["form_1"];
    $form_2 = $_POST["form_2"];
    $form_3 = $_POST["form_3"];
    
    $number = $_POST["number"];  // 投稿番号を取得
    $name = $_POST["name"];  // 名前を取得
    $text = $_POST["text"];  // コメントを取得

    $date = date("Y/m/d H:i:s");  // 現在の日時を取得
    $f_name = "mission_3-4.txt";  // ファイル名を指定

    touch($f_name);  // ファイルを新規作成
    $f = file($f_name, FILE_IGNORE_NEW_LINES);  // ファイルの内容を取得
    $count = count($f) + 1;  // 次回投稿番号を取得


    // 投稿

    if ($form_1 != NULL && $name != NULL && $text != NULL) {

      $f_post = "$count<>$name<>$text<>$date";  // 投稿内容

      $handle = fopen($f_name, "a");
      fwrite($handle, $f_post.PHP_EOL);
      fclose($handle);

      echo "投稿しました。<br>";


    // 修正

    } elseif ($form_2 != NULL && $number != NULL && $text != NULL) {
      
      $handle = fopen($f_name, "w");

      foreach ($f as $row) {

        $r = explode("<>", $row);  // 投稿内容を分割して取得

        if ($r[0] == $number) {
          $f_post = "{$r[0]}<>{$r[1]}<>{$text}<>{$r[3]}";  // 投稿内容
          fwrite($handle, $f_post.PHP_EOL);
        } else {
          fwrite($handle, $row.PHP_EOL);
        }

      }

      fclose($handle);
      echo "投稿を修正しました。<br>";


    // 削除

    } elseif ($form_3 != NULL && $number != NULL) {
      
      $handle = fopen($f_name, "w");

      foreach ($f as $row) {

        $r = explode("<>", $row);  // 投稿内容を分割して取得

        if ($r[0] < $number) {
          $count = $r[0];
        } elseif ($r[0] > $number) {
          $count = $r[0] - 1;
        } else {
          continue;
        }
        
        $f_post = "$count<>{$r[1]}<>{$r[2]}<>{$r[3]}";  // 投稿内容
        fwrite($handle, $f_post.PHP_EOL);

      }

      fclose($handle);
      echo "投稿を削除しました。<br>";

    } else {

      echo "名前とコメント、または投稿番号を入力してください。<br>",
           "なお、投稿と削除は同時に行えません。<br>";

    }


    // ファイルから出力

    $f = file($f_name, FILE_IGNORE_NEW_LINES);

    foreach ($f as $row) {

      $r = explode("<>", $row);  // 投稿内容を分割して取得
      
      foreach ($r as $print) {
        echo $print, "-";  // 投稿内容を出力
      }

      echo "<br>";  // 1つの投稿内容ごとに改行
    }
  
  ?>
</body>
</html>