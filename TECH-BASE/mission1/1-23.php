<?php

  $people = array(
    "Ken",
    "Alice",
    "Judy",
    "BOSS",
    "Bob"
  );

    foreach ($people as $person) {
      
      if ($person == "BOSS") {
        echo "Good morning BOSS!<br>";
      } else {
        echo "Hi! {$person}<br>";
      }

    }

?>