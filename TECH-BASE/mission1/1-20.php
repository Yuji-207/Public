<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="str">
    <input type="submit" name="submit">
  </form>

  <?php
    $str = $_POST["str"];
    echo $str;
  ?>
  
</body>
</html>