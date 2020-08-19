<?php

  $str = "Hello World\n";
  $file_name = "mission_1-25.txt";

  $handle = fopen($file_name, "w");
  
  fwrite($handle, $str);
  fclose($handle);
  
  echo "書き込み成功！";

?>