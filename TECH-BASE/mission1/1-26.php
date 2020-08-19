<?php

  $f_name = "mission_1-24.txt";

  if (file_exists($f_name)) {

    $f_rows = file($f_name, FILE_IGNORE_NEW_LINES);

    foreach ($f_rows as $f_row) {
      echo $_rows, "<br>";
    }

  }

?>