<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome!</title>
</head>
<body>
  <h1>ようこそ！</h1>
  <p>バグを発見したいので、テストにご協力ください！</p>
  <p>このページでは、コメントの投稿・修正・削除ができます。入力欄を埋めて、ボタンを押してみてください！<br>
     ただし、投稿・修正・削除は1度に実行できません。<br>
     わざとパスワードを間違えたりして、表示されるメッセージや投稿におかしいところがないか確認してみてください。</p>
  
  <!-- 投稿フォーム -->
  <h3>投稿はこちら</h3>
  <form action="" method="POST">
    <input type="text" placeholder="名前を入力" name="name" required>
    <input type="text" placeholder="コメントを入力" name="text" required>
    <input type="password" placeholder="パスワードを設定" name="password" required>
    <input type="submit" value="投稿" name="form_1">
  </form>
  <br>
  <!-- 修正フォーム -->
  <h3>投稿の修正はこちら</h3>
  <form action="" method="POST">
    <input type="number" placeholder="投稿番号を入力" name="number" required>
    <input type="text" placeholder="コメントを入力" name="text" required>
    <input type="password" placeholder="パスワードを入力" name="password" required>
    <input type="submit" value="修正" name="form_2">
  </form>
  <br>
  <!-- 削除フォーム -->
  <h3>投稿の削除はこちら</h3>
  <form action="" method="POST">
    <input type="number" placeholder="投稿番号を入力" name="number" required>
    <input type="password" placeholder="パスワードを入力" name="password" required>
    <input type="submit" value="削除" name="form_3">
  </form>
  <br>

  <?php
  

    // 変数宣言

    $form_1 = $_POST["form_1"];
    $form_2 = $_POST["form_2"];
    $form_3 = $_POST["form_3"];
    
    $number = $_POST["number"];  // 投稿番号を取得
    $name = $_POST["name"];  // 名前を取得
    $text = $_POST["text"];  // コメントを取得
    $password = $_POST["password"];  // パスワードを取得

    $date = date("Y/m/d H:i:s");  // 現在の日時を取得
    $f_name = "mission_3-5.txt";  // ファイル名を指定

    touch($f_name);  // ファイルを新規作成
    $f = file($f_name, FILE_IGNORE_NEW_LINES);  // ファイルの内容を取得
    $count = count($f) + 1;  // 次回投稿番号を取得


    // 投稿

    if ($form_1 != NULL) {

      $f_post = "$count<>$name<>$text<>$date<>$password<>";  // 投稿内容

      $handle = fopen($f_name, "a");
      fwrite($handle, $f_post.PHP_EOL);
      fclose($handle);

      echo "投稿しました。<br><br>";


    // 修正

    } elseif ($form_2 != NULL) {
      
      if ($number < $count) {  // 投稿が存在する場合

        $handle = fopen($f_name, "w");

        foreach ($f as $row) {

          $r = explode("<>", $row);  // 投稿内容を分割して取得

          if ($r[0] == $number) {
            
            // パスワード認証
            if ($password == $r[4]) {

              $f_post = "{$r[0]}<>{$r[1]}<>$text<>$date<>{$r[4]}<>";  // 投稿内容
              fwrite($handle, $f_post.PHP_EOL);
              echo "投稿を修正しました。<br><br>";

            } else {

              fwrite($handle, $row.PHP_EOL);
              echo "パスワードが間違っています。<br><br>";

            }

          } else {
            fwrite($handle, $row.PHP_EOL);
          }
        }

        fclose($handle);

      } else {
        echo "{$number}番の投稿は存在しません。<br><br>";  // 投稿が存在しない場合
      }


    // 削除

    } elseif ($form_3 != NULL) {
      
      if ($number < $count) {  // 投稿が存在する場合
        $handle = fopen($f_name, "w");

        foreach ($f as $row) {
          $r = explode("<>", $row);  // 投稿内容を分割して取得

          if ($r[0] < $number) {
            $count = $r[0];

          } elseif ($r[0] > $number) {
            $rows = count(file($f_name, FILE_IGNORE_NEW_LINES)) + 1;

            if ($r[0] > $rows) {  // 投稿が削除された場合
              $count = $r[0] - 1;  // 投稿を消した分番号をずらす

            } else {
              $count = $r[0];
            }

          } else {

            // パスワード認証
            if ($password == $r[4]) {

              echo "投稿を削除しました。<br><br>";
              continue;  // 投稿をコピーせずにスキップ

            } else {

              $count = $r[0];
              echo "パスワードが間違っています。<br><br>";

            }
          }
          
          $f_post = "$count<>{$r[1]}<>{$r[2]}<>{$r[3]}<>{$r[4]}<><br>";  // 投稿内容
          fwrite($handle, $f_post.PHP_EOL);

        }

        fclose($handle);

      } else {
        echo "{$number}番の投稿は存在しません。<br><br>";  // 投稿が存在しない場合
      }
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