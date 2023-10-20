<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
    $message = app::post("message");

    $create = DB::insert("compliants", [
        "message" => $message,
        "user_id" => app::getSession("id"),
        "status" => 0,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $create = DB::execute();

   if($create) {
    echo "<script>alert('1 record created!')</script>";
    app::redirect("compliants.php");  
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
  <title>Compliant create</title>
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
        <li class="breadcrumb-item"><a href="compliants.php">Compliants</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Create</b>
              </h5>
            </div>
            <div class="card-body">
            <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="message">Message</label>
                  <textarea class="form-control font-12 shadow-none border" id="message" name="message" rows="6"></textarea>
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