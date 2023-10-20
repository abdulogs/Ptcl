<?php require_once "../classes/database.php"; ?>
<?php app::isLogin("id", "admin/dashboard.php"); ?>

<?php 
    if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

        $email = app::post("email");
        $password = app::post("password");

        $user = DB::columns(["id","role","status"]);
        $user = DB::table("users");
        $user = DB::where(["email" => $email, "password" => md5($password)]); // md5 is used to encrypt password
        $user = DB::execute();
        $user = DB::fetch("one");

        if($user){
            if($user["status"] == 1){
                app::redirect("admin/dashboard.php");
                app::setSession("id", $user["id"]);
                app::setSession("role", $user["role"]);
            } else{
                app::alert("Your account is not approved yet!");
            }    
        } else{
                app::alert("Invalid credentials!");
        }
    }
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login to dashboard</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Signin page css -->
  <link rel="stylesheet" href="assets/css/signin.css">
  <!-- Custom -->
  <link href="assets/css/custom.css" rel="stylesheet">

</head>

<body>
  <form class="form-signin text-center" method="POST">
    <h1 class="font-weight-bolder"><b class="text-success">PTCL</b></h1>
    <h4 class="font-weight-normal"><b>Login to your account</b></h4>
    <p class="mb-4 font-12 text-center text-muted">Welcome back now login to your account</p>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control form-control-sm shadow-none font-12 border" placeholder="Email address" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password"  class="form-control form-control-sm shadow-none font-12 border" placeholder="Password" required>
    <div class="checkbox d-flex mb-3">
      <label class="font-12"><input type="checkbox" value="remember-me"> Remember me</label>
      <a href="forgot-password.php" class="ml-auto text-dark font-12">Forgot password?</a>
    </div>
    <button class="btn btn-lg font-12 font-weight-bolder btn-success btn-block" type="submit">Sign in</button>
  </form>

</body>

</html>