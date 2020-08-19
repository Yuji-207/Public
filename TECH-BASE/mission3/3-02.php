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

      // ファイルから出力

      $f = file($f_name, FILE_IGNORE_NEW_LINES);

      foreach ($f as $row) {

        $r = explode('<>', $row);  // 投稿内容を分割して取得
        echo "{$r[0]}: {$r[1]} [ {$r[2]} ] ({$r[3]})<br>";

      }
    
    ?>
  </body>
</html>