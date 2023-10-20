<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = app::post("name");
    $connection_id = app::post("connection_id");
    $status = app::post("status");

    $create = DB::insert("vouchers", [
        "name" => $name,
        "connection_id" => $connection_id,
        "status" => 0,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $create = DB::execute();

   if($create) {
    echo "<script>alert('1 record inserted!')</script>";
    app::redirect("admin/vouchers.php");  
   } 
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Voucher create</title>
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
        <li class="breadcrumb-item"><a href="compliants.php">Voucher</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6" enctype="multipart/form-data">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Create</b>
              </h5>
            </div>
            <div class="card-body">
              <div class="form-row">
              <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="name">Title</label>
                  <input class="form-control font-12 shadow-none border" id="name" name="name" type="text" required />
                </div>
              <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="connection_id">Connection</label>
                  <select name="connection_id" id="connection_id" class="custom-select  font-12 shadow-none border">
                  <?php // All users  
                      $connections = DB::columns(["r.id","u.first_name","u.last_name","r.speed","u.username"]);
                      $connections = DB::table("requests as r");
                      $connections = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
                      $connections = DB::execute();
                      $connections = DB::fetch("all"); ?>
                      <?php foreach ($connections as $connection):?>
                        <option value="<?php echo $connection['id']; ?>">
                        <?php echo $connection['first_name']." ".$connection['last_name']; ?> 
                        (@<?php echo $connection['username']; ?>) (<?php echo $connection['speed']; ?>)
                        </option>
                      <?php endforeach;?>
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