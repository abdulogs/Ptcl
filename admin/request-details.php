<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php // Single record 
    $data = DB::columns(["r.id","r.user_id","r.speed","r.price","r.status","r.created_at", "r.updated_at"]);
    $data = DB::columnsmore(["r.account_id","r.issuance_date","r.ptcl_number"]);
    $data = DB::columnsmore(["u.first_name","u.last_name","u.email","u.phone","u.address"]);
    $data = DB::table("requests as r");
    $data = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
    $data = DB::where(["r.id" => app::get("id")]);
    $data = DB::execute();
    $data = DB::fetch("one"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Request details</title>
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
      <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="requests.php">Connection requests</a></li>
        <li class="breadcrumb-item active">Details</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
          <div class="card shadow mb-5 m col-sm-6 p-0">
            <div class="card-header bg-white px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Connection requests details</b>
              </h5>
            </div>
            <div class="card-body p-0 pb-3">
              <table class="table m-0">
                <tr>
                  <td class="border-top-0"><b>Customer</b></td>
                  <td class="border-top-0"><?php echo $data['first_name']." ".$data['last_name']; ?></td>
                </tr>
                <tr>
                  <td><b>Speed</b></td>
                  <td><?php echo $data['speed']; ?></td>
                </tr>
                <tr>
                  <td><b>Price</b></td>
                  <td><?php echo $data['price']; ?> PKR</td>
                </tr>
                <tr>
                  <td><b>Account id</b></td>
                  <td><?php echo $data['account_id']; ?></td>
                </tr>
                <tr>
                  <td><b>Issuance date</b></td>
                  <td><?php echo $data['issuance_date']; ?></td>
                </tr>
                <tr>
                  <td><b>Ptcl number</b></td>
                  <td><?php echo $data['ptcl_number']; ?></td>
                </tr>
                <tr>
                  <td><b>Status</b></td>
                  <td><?php app::is_approved($data["status"]); ?></td>
                </tr>
                <tr>
                  <td><b>Created at</b></td>
                  <td><?php echo app::formatDatetime($data['created_at']); ?></td>
                </tr>
                <tr>
                  <td><b>Updated at</b></td>
                  <td><?php echo app::formatDatetime($data['updated_at']); ?></td>
                </tr>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>

  <?php app::component("footer"); ?>
</body>

</html>