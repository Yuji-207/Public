<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <input type="text" placeholder="コメントを入力" name="txt">
    <input type="submit" value="送信">
  </form>

  <?php
  
    $txt = $_POST["txt"];
    $f_name = "mission_2-4.txt";

    // $txtに値が入力されたとき
    if ($txt != NULL) {

      $handle = fopen($f_name, "a");
      
      fwrite($handle, $txt.PHP_EOL);
      fclose($handle);

    }

    // ファイルをブラウザに表示

    $f_rows = file($f_name, FILE_IGNORE_NEW_LINES);

    foreach ($f_rows as $row) {
      echo $row, "<br>";
    }
  
  ?>
</body>
</html>