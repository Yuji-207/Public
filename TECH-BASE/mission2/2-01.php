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

    if ($txt != NULL) {
      echo $txt, " を受け付けました。";
    }
  
  ?>
</body>
</html>