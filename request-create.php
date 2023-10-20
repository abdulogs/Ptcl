<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $speed = app::post("speed");

    $create = DB::insert("requests", [
        "speed" => $speed,
        "user_id" => app::getSession("id") ,
        "status" => 0,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $create = DB::execute();

   if($create) {
    echo "<script>alert('Request sent successfully!')</script>";
    app::redirect("requests.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["id","username","first_name","last_name","email","phone","address"]);
    $data = DB::table("users");
    $data = DB::where(["id" => app::getSession("id")]);
    $data = DB::execute();
    $data = DB::fetch("one");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Send connection request</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="assets/css/admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Your custom styles -->
  <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">

  <?php app::component("navigation"); ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="requests.php">Connections</a></li>
        <li class="breadcrumb-item active">Send connection request</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Send connection request</b>
              </h5>
            </div>
            <div class="card-body">
              <div class="form-row">
              <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="uname">Username</label>
                  <input class="form-control font-12 shadow-none border" id="uname" name="uname" type="text" value="<?php echo $data['first_name']; ?>" disabled />
                </div>
              <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="fname">Firstname</label>
                  <input class="form-control font-12 shadow-none border" id="fname" name="fname" type="text" value="<?php echo $data['first_name']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="lname">Lastname</label>
                  <input class="form-control font-12 shadow-none border" id="lname" name="lname" type="text" value="<?php echo $data['last_name']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="email">Email</label>
                  <input class="form-control font-12 shadow-none border" id="email" name="email" type="email" value="<?php echo $data['email']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="phone">Phone</label>
                  <input class="form-control font-12 shadow-none border" id="phone" name="phone" type="phone" value="<?php echo $data['phone']; ?>" disabled />
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="address">Address</label>
                  <input class="form-control font-12 shadow-none border" id="address" name="address" type="address" value="<?php echo $data['address']; ?>" disabled />
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="speed">Internet speed</label>
                  <select name="speed" id="speed" class="custom-select  font-12 shadow-none border" required>
                    <option value="">Select</option>
                    <option value="6 mb">6 mb</option>
                    <option value="8 mb">8 mb</option>
                    <option value="12 mb">12 mb</option>
                  </select>
                </div>
                </div>
              </div>
            <div class="card-footer bg-white text-center px-3">
              <button class="btn btn-success btn-sm px-5" type="submit"><b>Proceed</b></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php app::component("footer"); ?>

</body>

</html>