<?php


  // インクルード

  include '../libraries/main.php';
  $plans = new Plans();


  // リダイレクト

  redirect('timeline.php', empty($_SESSION['user'] || $_POST['title'] || $_POST['schedule']));


  // データの取得

  $user = $_SESSION['user'];
  $title = $_POST['title'];
  $schedule = $_POST['schedule'];
  $comment = $_POST['comment'];


  if (!empty($_GET['id'])) {

    $id = $_GET['id'];
    $plan = $plans -> get_plan($id);
    $image = $plan['image'];

  } elseif (!empty($_FILES['image']['tmp_name'])) {

    $file = $plans -> compress_img($_FILES['image']['tmp_name']);
    $image = file_get_contents($file);

  }

  if (!empty($img_del))  $image = NULL;

  
  // プランの登録
  $id = $plans -> make_plan($user, $title, $schedule, $comment, $image);

  
  // リダイレクト
  redirect("../plan.php?id=$id");


?>