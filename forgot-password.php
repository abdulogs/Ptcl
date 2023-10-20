<?php require_once "./classes/database.php"; ?>
<?php app::isLogin("id", "dashboard.php"); ?>

<?php 
    if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

        $email = app::post("email");
        $token = md5(time().date("y-m-d"));

        $user = DB::columns(["id","email"]);
        $user = DB::table("users");
        $user = DB::where(["email" => $email]);
        $user = DB::execute();
        $user = DB::fetch("one");

        if($user){
            DB::insert("recovery", [
            "token" => $token,
            "email" => $email,
            "user_id" => $user["id"],
            ])::execute();

            app::redirect("email-sent.php");
        } else{
            app::alert("This email does\'t exists");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Signin page css -->
    <link rel="stylesheet" href="assets/css/signin.css">
    <!-- Custom -->
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body class="main-bg">
  <main class="form-signin text-center">
      <form  method="POST">
      <h1 class="font-weight-bolder"><b class="text-success">PTCL</b></h1>
        <h4 class="font-weight-normal"><b>Forgot password!</b></h4>
            <p class="mb-4 font-12 text-center text-muted">We will send you a token for password change authentication!</p>
            <div class="form-group">
                <input type="email" class="form-control shadow-none border rounded font-12"
                    placeholder="Email address..." id="email" name="email" autofocus required>
            </div>
            <button class="w-100 btn btn-lg btn-success font-12" type="submit"><b>Procced</b></button>
            <a href="login.php" class="text-dark font-12 mt-2 mb-2 d-block text-left">
                - <span class="text-dark">Login?</span>
            </a>
        </form>
    </main>

</body>

</html>