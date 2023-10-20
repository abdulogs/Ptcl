<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php // Single record 
  $data = DB::columns(["b.id","b.due_amount","b.late_amount","b.status","b.created_at", "b.updated_at"]);
  $data = DB::columnsmore(["b.usage_mbs","b.due_date","b.wh_tax","b.service_tax","b.arrears",]);
  $data = DB::columnsmore(["b.month","b.credits","u.first_name","u.last_name","b.image"]);
  $data = DB::table("bills as b");
  $data = DB::join(["users AS u" => ["u.id" => "b.user_id"]],"LEFT");
  $data = DB::where(["b.id" => app::get("id")]);
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
  <title>Bill details</title>
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
        <li class="breadcrumb-item"><a href="bills.php">Bills</a></li>
        <li class="breadcrumb-item active">Details</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
          <div class="card shadow mb-5 m col-sm-6 p-0">
            <div class="card-header bg-white px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Details</b>
              </h5>
            </div>
            <div class="card-body p-0 pb-3">
              <table class="table m-0">
                <tr>
                  <td class="border-top-0"><b>Customer</b></td>
                  <td class="border-top-0"><?php echo $data['first_name']." ".$data['last_name']; ?></td>
                </tr>
                <tr>
                  <td><b>Usage</b></td>
                  <td><?php echo $data['usage_mbs']; ?></td>
                </tr>
                <tr>
                  <td><b>Due amount</b></td>
                  <td><?php echo $data['due_amount']; ?> PKR</td>
                </tr>
                <tr>
                  <td><b>Plenty amount</b></td>
                  <td><?php echo $data['late_amount']; ?> PKR</td>
                </tr>
                <tr>
                  <td><b>Due date</b></td>
                  <td><?php echo $data['due_date']; ?></td>
                </tr>
                <tr>
                  <td><b>W.H Tax</b></td>
                  <td><?php echo $data['wh_tax']; ?> PKR</td>
                </tr>
                <tr>
                  <td><b>Service Tax</b></td>
                  <td><?php echo $data['service_tax']; ?> PKR</td>
                </tr>
                <tr>
                  <td><b>Arrears</b></td>
                  <td><?php echo $data['arrears']; ?> PKR</td>
                </tr>
                <tr>
                  <td><b>Month</b></td>
                  <td><?php echo $data['month']; ?></td>
                </tr>
                <tr>
                  <td><b>Credits</b></td>
                  <td><?php echo $data['credits']; ?></td>
                </tr>
                <tr>
                  <td><b>Paid image</b></td>
                  <td> 
                    <?php if(!empty($data["image"])):?>
                      <a href="./uploads/bills/<?php echo $data["image"]; ?>" download="<?php echo $data["image"]; ?>" class="fa fa-download text-success"></a>
                    <?php else:?>
                      <span class="badge badge-danger">N/A</span>  
                    <?php endif;?> 
                  </td>
                </tr>
                <tr>
                  <td><b>Status</b></td>
                  <td><?php echo app::is_paid($data['status']); ?></td>
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