<?php require_once "./classes/database.php"; ?>
<?php app::isLogin("id", "dashboard.php"); ?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTCL | Home</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="assets/css/admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Your custom styles -->
  <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body class="h-100 d-flex flex-column bg-white">


  <?php app::component("navbar"); ?>
    
  <main class="container h-100 pt-5">
        <div class="row pt-5">
            <div class="col-sm-6 pt-5">
                <h1 class="mb-2"> Welcome to <b>PTCL</b> platform</h1>
                <p class="text-muted font-12">
                PTCL is proud of its more than 70 years heritage; connecting people of Pakistan. PTCL has always played its part in development of the country and is committed to building a prosperous and digitally connected Pakistan
                </p>
                <a href="register.php" class="btn btn-success">Get started</a>
                <a href="login.php" class="btn btn-dark">Login</a>
            </div>
            <div class="col-sm-6 text-right">
                <img src="./assets/images/main.jpg" class="img-fluid" alt="">
            </div>
        </div>
    </main>

    <?php app::component("footer-2"); ?>

</body>

</html>