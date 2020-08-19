<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'assets/stylesheets.php' ?>
    <title>Make a New Plan!</title>
  </head>
  <body class="bg-light">
    <header>
    </header>

    <?php include 'assets/header.php' ?>
    <?php redirect('login.php', empty($_SESSION['user'])) ?>

    <main class="col-md-6 mx-md-auto py-5">
      <form class="bg-light" action="backend/make_plan.php" method="POST" enctype="multipart/form-data">
        <h5>タイトル</h5>
        <div class="input-group mb-3">
          <input class="form-control" type="text" name="title" placeholder="タイトル" required>
          <div class="input-group-append">
            <span class="input-group-text">への旅行</span>
          </div>
        </div>
        <h5>スケジュール</h5>
        <textarea class="form-control mb-3" name="schedule" cols="30" rows="10" placeholder="スケジュール" required></textarea>
        <h5>コメント</h5>
        <textarea class="form-control mb-3" name="comment" cols="30" rows="10" placeholder="コメント"></textarea>
        <h5 class="mb-2">画像</h5>
        <input class="form-control-file mb-2" type="file" name="image" accept="image/*">
        <p class="alert alert-warning mb-3">画像は3MBまでアップロードできます。</p>
        <input class="btn btn-info btn-lg btn-block" type="submit" value="作成！">
      </form>
    </main>
    <footer>
    </footer>
    <?php include 'assets/scripts.php' ?>
  </body>
</html>