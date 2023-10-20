<?php require_once "../classes/database.php"; ?>
<?php require_once "../classes/media.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
    $name = app::post("name");
    $status = app::post("status");
    $connection_id = app::post("connection_id");

    $update = DB::update("vouchers", [
        "name" => $name,
        "status" => $status,
        "connection_id" => $connection_id,
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("admin/vouchers.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["id","name","connection_id","status"]);
    $data = DB::table("vouchers");
    $data = DB::where(["id" => app::get("id")]);
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
  <title>Voucher Update</title>
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
        <li class="breadcrumb-item active">Update</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6" enctype="multipart/form-data">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Update</b>
              </h5>
            </div>
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="name">Name</label>
                  <input class="form-control font-12 shadow-none border" id="name" name="name" type="text" value="<?php echo $data['name']; ?>" required />
                  <input  id="id" name="id" type="hidden" value="<?php echo $data['id']; ?>" />
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="connection_id">Connection</label>
                  <select name="connection_id" id="connection_id" class="custom-select  font-12 shadow-none border">
                  <?php // All  
                      $connections = DB::columns(["r.id","u.first_name","u.last_name","r.speed","u.username"]);
                      $connections = DB::table("requests as r");
                      $connections = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
                      $connections = DB::execute();
                      $connections = DB::fetch("all"); ?>
                      <?php foreach ($connections as $connection):?>
                        <option value="<?php echo $connection['id']; ?>" <?php echo ($data["connection_id"] == $connection["id"]) ? "selected" :"" ; ?>>
                        <?php echo $connection['first_name']." ".$connection['last_name']; ?> 
                        (@<?php echo $connection['username']; ?>) (<?php echo $connection['speed']; ?>)
                        </option>
                      <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="status">Status</label>
                  <select name="status" id="status" class="custom-select font-12 shadow-none border">
                    <optgroup label="Select">
                        <option value="<?php echo $data['status']?>">
                          <?php if($data["status"] == 0): ?>
                            Unpaid
                          <?php elseif($data["status"] == 1): ?>
                            Paid
                          <?php endif;?>
                        </option>
                    </optgroup>
                    <option value="0">Unpaid</option>
                    <option value="1">Paid</option>
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