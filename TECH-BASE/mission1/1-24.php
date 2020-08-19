<?php

  $str = "Hello World\n";
  $file_name = "mission_1-24.txt";

  $handle = fopen($file_name, "a");
  
  fwrite($handle, $str);
  fclose($handle);
  
  echo "書き込み成功！";

?>