<?php require_once "./classes/database.php"; ?>
<?php app::isLogin("id", "admin/dashboard.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Email sent successfully</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Signin page css -->
  <link rel="stylesheet" href="assets/css/signin.css">
  <!-- Custom -->
  <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body class="main-bg">
    
    <main class="container mt-5 pt-5 pb-5 mb-5 text-center">
        <br><br><br><br>
        <br><br><br><br>
        <h1 class="fa fa-check-circle d-inline text-success" style="font-size:50px;"></h1>
        <h2 class="mt-2">Email sent successfully!</h2>
        <p>We sent you an email on your email account. you can check inbox to confirm email</p> 
        <a href="login.php" class="btn btn-success btn-sm px-3">Home</a>
        <br><br><br><br>
        <br><br><br><br>
    </main>

</body>

</html>