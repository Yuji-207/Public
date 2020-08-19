<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
  </head>
  <body>
    <h1>ようこそ！</h1>
    <p>バグを発見したいので、テストにご協力ください！<br>
       このページでは、コメントの投稿・修正・削除ができます。入力欄を埋めて、ボタンを押してみてください！</p>
    

    <?php


      // DB接続

      $dsn = 'dsn';
      $user = 'user';
      $password = 'password';
      
      $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


      // 変数宣言

      $type_value = $_POST['type'];  // 投稿タイプを取得
      $id = $_POST['id'];  // 投稿番号を取得
      $name = htmlspecialchars($_POST['name'], ENT_QUOTES|ENT_HTML5, 'UTF-8');  // 氏名を取得
      $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES|ENT_HTML5, 'UTF-8');  // コメントを取得
      $password = $_POST['password'];  // パスワードを取得

      

      $date = date('Y/m/d H:i:s');  // 現在の日時を取得
      $error = NULL;  // エラーメッセージ


      // 投稿フォーム

      if (isset($_POST['form_1'])) {

        // 修正
        if ($type_value == 'edit') {

          $sql = 'UPDATE mission5 SET comment=:comment WHERE id=:id AND password=:password';
          $stmt = $pdo -> prepare($sql);
          $stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
          $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
          $stmt -> bindParam(':password', $password, PDO::PARAM_STR);
          $stmt -> execute();

        }
        
        // 削除
        elseif ($type_value == 'delete') {

            $sql = 'DELETE FROM mission5 WHERE id=:id AND password=:password';
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
            $stmt -> bindParam(':password', $password, PDO::PARAM_STR);
            $stmt -> execute();

            // idを振り直すため、 カラムを再設定
            $sql = 'ALTER TABLE mission5 DROP COLUMN id;
                    ALTER TABLE mission5 ADD id INT AUTO_INCREMENT PRIMARY KEY FIRST;
                    ALTER TABLE mission5 AUTO_INCREMENT = 1;';
            $stmt = $pdo -> query($sql);
            
        }

        // 投稿
        else {

          $sql = 'INSERT INTO mission5 (name, comment, password, date) VALUES (:name, :comment, :password, :date)';
          $stmt = $pdo -> prepare($sql);
          $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
          $stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
          $stmt -> bindParam(':password', $password, PDO::PARAM_STR);
          $stmt -> bindParam(':date', $date, PDO::PARAM_STR);
          $stmt -> execute();

        }

        $id_value = NULL;  // 投稿フォーム用のIDを取得
        $type_value = NULL;  // 投稿タイプ
        $name_value = NULL;  // 投稿氏名
        $comment_value = NULL;  // 投稿コメント
        
      }


      // 修正フォーム

      elseif (isset($_POST['form_2'])) {

        $sql = 'SELECT * FROM mission5';
        $stmt = $pdo -> query($sql);
        $results = $stmt -> fetchAll();

        // 削除する投稿が存在するとき
        if ($id <= count($results)) {
          foreach ($results as $result) {
            if ($id == $result['id']) {
  
              $type_value = 'edit';
              $id_value = $id;  // 投稿フォーム用のIDを取得
              $name_value = $result['name'];  // 投稿フォームに表示する氏名を取得
              $comment_value = $result['comment'];  // 投稿フォームに表示するコメントを取得
              break;
  
            }
          }
        }

        // 削除する投稿が存在しないとき
        else $error = '投稿番号が存在しません';

      }


      // 削除フォーム
      
      elseif (isset($_POST['form_3'])) {

        $sql = 'SELECT * FROM mission5';
        $stmt = $pdo -> query($sql);
        $results = $stmt -> fetchAll();

        // 削除する投稿が存在するとき
        if ($id <= count($results)) {
          foreach ($results as $result) {
            if ($id == $result['id']) {
  
              $type_value = 'delete';
              $id_value = $id;  // 投稿フォーム用のIDを取得
              $name_value = $result['name'];  // 投稿フォームに表示する氏名を取得
              $comment_value = $result['comment'];  // 投稿フォームに表示するコメントを取得
              break;
  
            }
          }
        }

        // 削除する投稿が存在しないとき
        else $error = '投稿番号が存在しません';

      }
    ?>


    <!-- 投稿フォーム -->

    <h3>
      <?php
        if (empty($type_value)) echo '投稿はこちら';
        else echo 'パスワードを入力してください';
      ?>
    </h3>

    <form action="" method="POST">
      <input type="hidden" name="type" value="<?= $type_value ?>">
      <input type="hidden" name="id" value="<?= $id_value ?>">
      <input type="text" name="name" placeholder="氏名を入力" value="<?= $name_value ?>" required>
      <input type="text" name="comment" placeholder="コメントを入力" value="<?= $comment_value ?>" required>
      <input type="password" name="password" placeholder="パスワードを設定" required>
      <input type="submit" name="form_1" value="投稿">
    </form>
    <br>
    <!-- 修正フォーム -->
    <h3>投稿の修正はこちら</h3>
    <form action="" method="POST">
      <input type="number" name="id" placeholder="投稿番号を入力" required>
      <input type="submit" name="form_2" value="修正">
    </form>
    <br>
    <!-- 削除フォーム -->
    <h3>投稿の削除はこちら</h3>
    <form action="" method="POST">
      <input type="number" name="id" placeholder="投稿番号を入力" required>
      <input type="submit" name="form_3" value="削除">
    </form>
    <br>
    <!-- エラーメッセージ -->
    <p><?= $error ?></p>
    <!-- 投稿一覧 -->
    <h3>投稿一覧</h3>
    <p>投稿番号: 氏名 [ 投稿内容 ] (投稿日時)</p>


    <?php
    
      // 表示

      $sql = 'SELECT * FROM mission5';
      $stmt = $pdo -> query($sql);
      $results = $stmt -> fetchAll();

      foreach ($results as $result) {
        echo "{$result['id']}: {$result['name']} [ {$result['comment']} ] ({$result['date']})<br>";
      }
    ?>
  </body>
</html>