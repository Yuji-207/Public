<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <input type="number" name="num" placeholder="数字を入力してください">
    <input type="submit" name="submit">
  </form>

  <?php

    $num = $_POST["num"];
    
    if ($num % 3 == 0 && $num % 5 != 0) {
      echo "Fizz<br>";
    } elseif ($num % 3 != 0 && $num % 5 == 0) {
      echo "Buzz<br>";
    } elseif ($num % 3 == 0 && $num % 5 == 0 && $num != 0){
      echo "FizzBuzz<br>";
    } else {
      echo $num, "<br>";
    }

  ?>

</body>
</html>