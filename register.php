<?php require_once "./classes/database.php"; ?>
<?php app::isLogin("id", "dashboard.php"); ?>

<?php 
  if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = app::post("fname");
    $lastname = app::post("lname");
    $username = app::post("uname");
    $email = app::post("email");
    $phone = app::post("phone");
    $password = app::post("password");
    $cnic = app::post("cnic");
    $status = app::post("status");

    if(DB::exists("users", ["id"], ["username" =>  $username])) {
      app::alert("This username already exists");
    } else    if(DB::exists("users", ["id"], ["email" =>  $email])) {
      app::alert("This email address already exists");
    } else {
      $create = DB::insert("users", [
        "first_name" => $firstname,
        "last_name" => $lastname,
        "username" => $username,
        "email" => $email,
        "phone" => $phone,
        "password" => md5($password),
        "cnic" => $cnic,
        "role" => 0,
        "status" => 0,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
      ])::execute();
    if($create) {
      echo "<script>alert('Account created successfully!')</script>";
      app::redirect("login.php");  
    }
  }
}
?>

<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Register account</title>
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
    <h4 class="font-weight-normal"><b>Create account</b></h4>
    <p class="mb-4 font-12 text-center text-muted">By creating a new account you can apply for connection</p>
    <label for="uname" class="sr-only">Username</label>
    <input type="text" id="uname" name="uname" class="form-control form-control-m shadow-none font-12 border" placeholder="Username" required autofocus>
    <label for="fname" class="sr-only">Firstname</label>
    <input type="text" id="fname" name="fname" class="form-control form-control-sm shadow-none font-12 border" placeholder="Firstname" required>
    <label for="lname" class="sr-only">Lastname</label>
    <input type="text" id="lname" name="lname" class="form-control form-control-sm shadow-none font-12 border" placeholder="Lastname" required>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control form-control-sm shadow-none font-12 border" placeholder="Email address" required>
    <label for="phone" class="sr-only">Phone</label>
    <input type="text" id="phone" name="phone" class="form-control form-control-sm shadow-none font-12 border" placeholder="Phone number" required>
    <label for="cnic" class="sr-only">Cnix</label>
    <input type="text" id="cnic" name="cnic" class="form-control form-control-sm shadow-none font-12 border" placeholder="Cnic" required>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password"  class="form-control form-control-sm shadow-none font-12 border" placeholder="Password" required>
    <div class="checkbox d-flex mb-3">
      <label class="font-12 text-left">
        <input type="checkbox" value="remember-me"> 
        By clicking on sign up button you are agreed with our terms and conditions
      </label>
    </div>
    <button class="btn btn-lg font-12 font-weight-bolder btn-success btn-block" type="submit">Sign up</button>
    <a href="login.php" class="btn btn-lg font-12 font-weight-bolder btn-dark btn-block">Login instead</a>
  </form>
  

</body>

</html>