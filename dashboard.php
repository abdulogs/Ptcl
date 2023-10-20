<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php // Listing
  $page = (isset($_GET["page"])) ? $_GET["page"] : 1;
  $page = ($page == 0) ? 1 : $page ;
  $limit = 10;
  $colspan = 10;

  $listing = DB::columns(["b.id","b.due_amount","b.late_amount","b.status","b.created_at", "b.updated_at"]);
  $listing = DB::columnsmore(["b.usage_mbs","b.due_date","b.wh_tax","b.service_tax","b.arrears","b.month","b.credits"]);
  $listing = DB::columnsmore(["u.first_name","u.last_name","u.email","u.phone","u.address","b.image"]);
  $listing = DB::table("bills as b");
  $listing = DB::join(["users AS u" => ["u.id" => "b.user_id"]],"LEFT");
  $listing = DB::where(["b.user_id" => app::getSession("id")]);
  $listing = DB::order("b.id", "DESC");
  $listing = DB::paging($page, $limit);
  $listing = DB::execute();
  $listing = DB::fetch("all"); ?>

  <?php 
    // Delete
    if(isset($_GET["id"])){  
      $delete = DB::delete("bills")::where(["id" => app::get("id")])::execute();
      echo "<script>alert('1 record deleted!')</script>";
      app::redirect("bills.php");
  } ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Dashboard</title>
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
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Home</li>
      </ol>

      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-dark o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-fw fa-flag"></i></div>
              <div class="mr-5">
                <h3 class="text-white m-0">
                <?php 
                  $compliants = DB::count("id", "id");
                  $compliants = DB::table("compliants");
                  $compliants = DB::where(["user_id" => app::getSession("id")]);
                  $compliants = DB::execute();
                  $compliants = DB::fetch("one"); 
                  echo $compliants["id"]; ?>
                  <small class="font-12">Compliants</small>
                </h3>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="compliants.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fa fa-angle-right"></i></span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-fw fa-check"></i></div>
              <div class="mr-5">
                <h3 class="text-white m-0">
                <?php 
                  $vouchers = DB::count("v.id", "id");
                  $vouchers = DB::table("vouchers as v");
                  $vouchers = DB::join(["requests AS r" => ["r.id" => "v.connection_id"]],"LEFT");
                  $vouchers = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
                  $vouchers = DB::where(["r.user_id" => app::getSession("id")]);
                  $vouchers = DB::execute();
                  $vouchers = DB::fetch("one"); 
                  echo $vouchers["id"]; ?>
                  <small class="font-12">Vouchers</small>
                </h3>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="vouchers.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fa fa-angle-right"></i></span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-fw fa-check-circle"></i></div>
              <div class="mr-5">
                <h3 class="text-white m-0">
                <?php 
                  $requests = DB::count("id", "id");
                  $requests = DB::table("requests");
                  $requests = DB::execute();
                  $requests = DB::fetch("one"); 
                  echo $requests["id"]; ?>
                  <small class="font-12">Connection requests</small>
                </h3>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="requests.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fa fa-angle-right"></i></span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon"><i class="fa fa-fw fa-dollar"></i></div>
              <div class="mr-5">
                <h3 class="text-white m-0">
                <?php 
                  $bills = DB::count("id", "id");
                  $bills = DB::table("bills");
                  $bills = DB::where(["user_id" => app::getSession("id")]);
                  $bills = DB::execute();
                  $bills = DB::fetch("one"); 
                  echo $bills["id"]; ?>
                  <small class="font-12">Bills</small>
                </h3>
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="bills.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fa fa-angle-right"></i></span>
            </a>
          </div>
        </div>
      </div>

      <div class="card shadow p-0 bg-white">
            <div class="d-flex align-items-center px-3 py-2">
              <h6 class="m-0 align-middle">
                <i class=" fa fa-dollar text-success"></i> <b>Bills</b>
              </h6>
            </div>
            <table class="table table-card table-sm mb-0">
              <thead class="bg-light border-top">
                <tr>
                <th class="px-3 border-0" scope="col">ID</th>
                <th class="border-0" scope="col">Usage</th>
                <th class="border-0" scope="col">Due amount</th>
                <th class="border-0" scope="col">Plenty amount</th>
                <th class="border-0" scope="col">Due date</th>
                <th class="border-0" scope="col">Month</th>
                <th class="border-0" scope="col">Status</th>
                <th class="border-0" scope="col">Created at</th>
                <th class="border-0" scope="col">Updated at</th>
                <th class="px-3 border-0" scope="col">Controls</th>
                </tr>
              </thead>
              <tbody class="font-12">
                <?php if($listing):?>
                  <?php foreach($listing as $data):?>
                    <tr>
                    <td class="align-middle px-3" data-label="ID">
                <?php echo $data["id"]; ?>
              </td>
              <td class="align-middle text-break" data-label="Usage">
                <?php echo $data["usage_mbs"]; ?>
              </td>
              <td class="align-middle text-break" data-label="Due amount">
                <?php echo $data["due_amount"]; ?> PKR
              </td>
              <td class="align-middle text-break" data-label="Late amount">
                <?php echo $data["late_amount"]; ?> PKR
              </td>
              <td class="align-middle text-break" data-label="Due date">
                <?php echo app::formatDatetime($data["due_date"]); ?>
              </td>
              <td class="align-middle text-break" data-label="Month">
                <?php echo $data["month"]; ?>
              </td>
              <td class="align-middle text-break" data-label="Status">
                <?php echo app::is_paid($data["status"]); ?>
              </td>
              <td class="align-middle text-break" data-label="Created at">
                <?php echo app::formatDatetime($data["created_at"]); ?>
              </td>
              <td class="align-middle text-break" data-label="Updated at">
                <?php echo app::formatDatetime($data["updated_at"]); ?>
              </td>
              <td class="align-middle px-3" data-label="Controls">
                <a href="bill-details.php?id=<?php echo $data["id"]; ?>" class="fa fa-eye text-success"></a>
                <a href="bill-update.php?id=<?php echo $data["id"]; ?>" class="fa fa-pencil text-info"></a>
                <a href="bills.php?id=<?php echo $data["id"]; ?>" class="fa fa-trash text-danger"></a>
              </td>
                    </tr>
                  <?php endforeach;?>
                <?php else:?>
                    <tr><td colspan="<?php echo $colspan; ?>" class="text-center"><b>No records found</b></td></tr>
                <?php endif;?>
              </tbody>
              <tfoot>
                <tr id="pagination" class="bg-light">
                  <td colspan="<?php echo $colspan; ?>" class="text-center">
                    <?php if($page != 0 && $page != 1): ?>
                      <a href="bills.php?page=<?php echo $page - 1; ?>" class="btn btn-sm btn-light border font-12 px-3" >
                        <b>Back</b>
                      </a>
                    <?php endif;?>

                    <?php if($listing): ?>
                      <a href="bills.php?page=<?php echo $page + 1; ?>" class="btn btn-sm btn-light border font-12 px-3" <?php echo ($listing) ? "": "disbaled"; ?>>
                        <b>Next</b>
                      </a>
                    <?php endif;?>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
  <?php app::component("footer"); ?>
</body>

</html>