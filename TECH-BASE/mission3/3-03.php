<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <p>
      <input type="text" placeholder="名前を入力" name="name">
      <input type="text" placeholder="コメントを入力" name="text">
    </p>
    <p>
      ※投稿内容を削除する場合はこちら↓<br>
      <input type="number" placeholder="投稿番号を入力" name="delete">
    </p>
    <p><input type="submit" value="送信"></p>
  </form>

  <?php
  

    // ファイルへ投稿

    $name = $_POST["name"];  // 名前を取得
    $text = $_POST["text"];  // コメントを取得
    $delete = $_POST["delete"];  // 投稿番号を取得

    $date = date("Y/m/d H:i:s");  // 現在の日時を取得
    $f_name = "mission_3-3.txt";  // ファイル名を指定

    touch($f_name);  // ファイルを新規作成
    $f = file($f_name, FILE_IGNORE_NEW_LINES);  // ファイルの内容を取得
    $number = count($f) + 1;  // 次回投稿番号を取得

    $f_post = "$number<>$name<>$text<>$date";  // 投稿内容


    // ファイル操作


    // 新規投稿

    if ($name != NULL && $text != NULL && $delete == NULL) {

      $handle = fopen($f_name, "a");
      fwrite($handle, $f_post.PHP_EOL);
      fclose($handle);
      echo "投稿しました。<br>";


    // 投稿削除

    } elseif ($name == NULL && $text == NULL && $delete != NULL) {

      $handle = fopen($f_name, "w");

      foreach ($f as $row) {

        $r = explode("<>", $row);  // 投稿内容を分割して取得

        // 投稿番号が削除番号より小さいとき
        if ($r[0] < $delete) {

          $number = $r[0];

        // 投稿番号が削除番号より大きいとき
        } elseif ($r[0] > $delete) {

          $rows = count(file($f_name, FILE_IGNORE_NEW_LINES)) + 1;  // 次回投稿番号を取得

          // 投稿が削除されたとき
          if ($r[0] > $rows) {

            $number = $r[0] - 1;  // 投稿を消した分番号をずらす

          // 投稿が削除されていないとき（存在しない投稿番号を指定したとき）
          } else {
            $number = $r[0];
          }

        // 投稿番号が削除番号のとき
        } else {

          echo "投稿を削除しました。<br><br>";
          continue;  // 投稿をコピーせずにスキップ

        }
          
        $f_post = "$number<>{$r[1]}<>{$r[2]}<>{$r[3]}<>{$r[4]}<><br>";  // 投稿内容
        fwrite($handle, $f_post.PHP_EOL);

      }

      fclose($handle);


    // エラー処理

    } else {
      echo "名前とコメント、または投稿番号を入力してください。<br>",
           "なお、投稿と削除は同時に行えません。<br>";
    }


    // ファイルから出力

    $f = file($f_name, FILE_IGNORE_NEW_LINES);

    foreach ($f as $row) {

      $r = explode("<>", $row);  // 投稿内容を分割して取得
      echo "{$r[0]}: {$r[1]} [ {$r[2]} ] ({$r[3]})<br><br>";

    }
  
  ?>

</body>
</html>