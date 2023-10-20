<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
    $speed = app::post("speed");

    $update = DB::update("requests", [
        "speed" => $speed,
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("requests.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["r.id","r.user_id","r.speed","r.price","r.status","r.created_at", "r.updated_at"]);
    $data = DB::columnsmore(["r.account_id","r.issuance_date","r.ptcl_number"]);
    $data = DB::columnsmore(["u.first_name","u.last_name","u.email","u.phone","u.address"]);
    $data = DB::table("requests as r");
    $data = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
    $data = DB::where(["r.id" => app::get("id")]);
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
  <title>Request update</title>
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
        <li class="breadcrumb-item active">Update</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Update</b>
              </h5>
            </div>
            <div class="card-body">
              <div class="form-row">
              <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="uname">Username</label>
                  <input class="form-control font-12 shadow-none border" id="uname" name="uname" type="text" value="<?php echo $data['first_name']; ?>" disabled />
                  <input id="id" name="id" type="hidden" value="<?php echo $data['id']; ?>" />
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
                  <label class="font-weight-bolder mb-0" for="speed">Speed</label>
                  <select name="speed" id="speed" class="custom-select  font-12 shadow-none border">
                    <optgroup label="Selected">
                        <option value="<?php echo $data['speed']?>"><?php echo $data['speed']?></option>
                    </optgroup>
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