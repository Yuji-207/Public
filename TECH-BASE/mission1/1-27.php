<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <input type="number" placeholder="数字を入力してください" name="num">
    <input type="submit" value="表示">
  </form>

  <?php
  
    $num = $_POST["num"];
    $f_name = "1-27.txt";

    if ($num != NULL) {
      $handle = fopen($f_name, "a");
      fwrite($handle, $num.PHP_EOL);
      fclose($handle);
    }    

    foreach (file($f_name, FILE_IGNORE_NEW_LINES) as $i) {

      if ($i % 3 == 0 && $i % 5 != 0) {
        echo "Fizz<br>";
      } elseif ($i % 3 != 0 && $i % 5 == 0) {
        echo "Buzz<br>";
      } elseif ($i % 3 == 0 && $i % 5 == 0 && $i != 0){
        echo "FizzBuzz<br>";
      } else {
        echo $i, "<br>";
      }

    }

  ?>

</body>
</html>