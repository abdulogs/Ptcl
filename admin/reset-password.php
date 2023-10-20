<?php require_once "../classes/database.php"; ?>
<?php app::isLogin("id", "admin/dashboard.php"); ?>
<?php 
    if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

      $id = app::get('id');
      $token = app::get('token');
      $password = app::post('password');
      $cpassword = app::post('cpassword');

      if($password !== $cpassword){
        app::alert("Password not matched yet!");
      } else{
        if(!DB::exists("recovery", ["user_id"], ["user_id" =>  $id, "token" =>  $token])) {
          app::alert("Something went wrong");
        } else {
          DB::update("users", [
          "password" => md5($password),
          "updated_at" => date("Y/m/d h:i:s A"),
        ]);
          DB::where(["id" => $id]);
          DB::execute();
      
          DB::delete("recovery")::where(["user_id" => $id])::execute();
          app::alert("Password change successfully");
          app::redirect("admin/index.php");
        }
      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Change password</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Signin page css -->
  <link rel="stylesheet" href="assets/css/signin.css">
  <!-- Custom -->
  <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
  <main class="form-signin text-center">
      <form  method="post">
        <h2 class="mb-1 font-weight-bolder"><b><span class="text-success">E</span>Library</b></h2>
        <h5 class="mb-4 font-weight-bold text-center">Change password!</h5>
        <label for="password" class="sr-only">password address</label>
        <input type="password" id="password" name="password" class="form-control form-control-sm shadow-none font-12 border" placeholder="Create password" required autofocus>
        <label for="cpassword" class="sr-only">Password</label>
        <input type="password" id="cpassword" name="cpassword"  class="form-control form-control-sm shadow-none font-12 border" placeholder="Confirm password" required>
        <button class="w-100 btn btn-lg btn-success font-12" type="submit">Change</button>
    </form>
</main>

</body>

</html>