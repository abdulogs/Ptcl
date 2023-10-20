<?php require_once "./classes/database.php"; ?>
<?php require_once "./classes/media.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $ofile = app::post("ofile");
    $id = app::post("id");

    if(!empty($_FILES["file"]["name"])){
      $file = media::file("file");
      $file = media::type(["png","jpg","jpeg"]);
      $file = media::size(2097152);
      $file = media::name("bill");
      $file = media::folder("admin/uploads/bills");
      // Delete file
      media::remove("admin/uploads/bills/{$ofile}");
    } else{
      $file = $ofile;
    }

    $update = DB::update("bills", [
        "image" => $file,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("bills.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["id","user_id","due_amount","late_amount","status","image","created_at", "updated_at"]);
    $data = DB::columnsmore(["usage_mbs","due_date","wh_tax","service_tax","arrears","month","credits"]);
    $data = DB::table("bills");
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
  <title>Bill update</title>
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
        <li class="breadcrumb-item"><a href="bills.php">Bills</a></li>
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
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="usage_mbs">Usage</label>
                  <input class="form-control font-12 shadow-none border" id="usage_mbs" name="usage_mbs" type="text" value="<?php echo $data['usage_mbs']; ?>" disabled />
                  <input  id="id" name="id" type="hidden" value="<?php echo $data['id']; ?>" />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="due_amount">Due amount</label>
                  <input class="form-control font-12 shadow-none border" id="due_amount" name="due_amount" type="text" value="<?php echo $data['due_amount']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="late_amount">Late amount</label>
                  <input class="form-control font-12 shadow-none border" id="late_amount" name="late_amount" type="text" value="<?php echo $data['late_amount']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="due_date">Due date</label>
                  <input class="form-control font-12 shadow-none border" id="due_date" name="due_date" type="date" value="<?php echo $data['due_date']; ?>" disabled />
                </div>
                <div class="form-group col-sm-4 mb-2">
                  <label class="font-weight-bolder mb-0" for="wh_tax">W.H Tax</label>
                  <input class="form-control font-12 shadow-none border" id="wh_tax" name="wh_tax" type="text" value="<?php echo $data['wh_tax']; ?>" disabled />
                </div>
                <div class="form-group col-sm-4 mb-2">
                  <label class="font-weight-bolder mb-0" for="service_tax">Service Tax</label>
                  <input class="form-control font-12 shadow-none border" id="service_tax" name="service_tax" type="text" value="<?php echo $data['service_tax']; ?>" disabled />
                </div>
                <div class="form-group col-sm-4 mb-2">
                  <label class="font-weight-bolder mb-0" for="arrears">Arrears</label>
                  <input class="form-control font-12 shadow-none border" id="arrears" name="arrears" type="text" value="<?php echo $data['arrears']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="month">Month</label>
                  <input class="form-control font-12 shadow-none border" id="month" name="month" type="text" value="<?php echo $data['month']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="credits">Credits</label>
                  <input class="form-control font-12 shadow-none border" id="credits" name="credits"  type="text" value="<?php echo $data['credits']; ?>" disabled />
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="file">File</label>
                  <input class="form-control font-12 shadow-none border p-1" id="file" name="file" type="file" />
                  <input type="hidden" name="ofile" value="<?php echo $data['image']; ?>">
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