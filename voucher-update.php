<?php require_once "./classes/database.php"; ?>
<?php require_once "./classes/media.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
    $ofile = app::post("ofile");

    if(!empty($_FILES["file"]["name"])){
      $file = media::file("file");
      $file = media::type(["pdf","png","jpg","jpeg"]);
      $file = media::size(2097152);
      $file = media::name("voucher");
      $file = media::folder("admin/uploads/vouchers");
      // Delete file
      media::remove("admin/uploads/vouchers/{$ofile}");
    } else{
      $file = $ofile;
    }

    $update = DB::update("vouchers", [
        "image" => $file,
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("vouchers.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["id","name","image"]);
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
                  <input class="form-control font-12 shadow-none border" id="name" name="name" type="text" value="<?php echo $data['name']; ?>" disabled />
                </div>
                <div class="form-group col-sm-12 mb-2">
                <input  id="id" name="id" type="hidden" value="<?php echo $data['id']; ?>" />
                  <label class="font-weight-bolder mb-0" for="file">Image</label>
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