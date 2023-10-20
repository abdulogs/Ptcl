<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = app::post("user_id");
    $usage_mbs = app::post("usage_mbs");
    $due_amount = app::post("due_amount");
    $late_amount = app::post("late_amount");
    $due_date = app::post("due_date");
    $wh_tax = app::post("wh_tax");
    $service_tax = app::post("service_tax");
    $arrears = app::post("arrears");
    $month = app::post("month");
    $credits = app::post("credits");

    $create = DB::insert("bills", [
        "user_id" => $user_id,
        "usage_mbs" => $usage_mbs,
        "due_amount" => $due_amount,
        "late_amount" => $late_amount,
        "due_date" => $due_date,
        "wh_tax" => $wh_tax,
        "service_tax" => $service_tax,
        "arrears" => $arrears,
        "month" => $month,
        "credits" => $credits,
        "status" => 0,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $create = DB::execute();

   if($create) {
    echo "<script>alert('1 record inserted!')</script>";
    app::redirect("admin/bills.php");  
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
  <title>Bill create</title>
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
        <li class="breadcrumb-item active">Create</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-plus-circle mr-2 text-success"></span>Create</b>
              </h5>
            </div>
            <div class="card-body">
              <div class="form-row">
              <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="user_id">Customer</label>
                  <select name="user_id" id="user_id" class="custom-select  font-12 shadow-none border">
                    <?php // All users  
                      $users = DB::columns(["id","first_name","last_name", "username"]);
                      $users = DB::table("users");
                      $users = DB::execute();
                      $users = DB::fetch("all"); ?>
                      <?php foreach ($users as $user):?>
                        <option value="<?php echo $user['id']; ?>">
                        <?php echo $user['first_name']." ".$user['last_name']; ?> (@<?php echo $user['username']; ?>)
                        </option>
                      <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="usage_mbs">Usage</label>
                  <select name="usage_mbs" id="usage_mbs" class="custom-select  font-12 shadow-none border" required>
                    <option value="">Select</option>
                    <option value="6 mb">6 mb</option>
                    <option value="8 mb">8 mb</option>
                    <option value="12 mb">12 mb</option>
                  </select>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="due_amount">Due amount (PKR)</label>
                  <input class="form-control font-12 shadow-none border" id="due_amount" name="due_amount" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="late_amount">Late amount (PKR)</label>
                  <input class="form-control font-12 shadow-none border" id="late_amount" name="late_amount" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="due_date">Due date (PKR)</label>
                  <input class="form-control font-12 shadow-none border" id="due_date" name="due_date" type="date" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="wh_tax">W.H Tax (PKR)</label>
                  <input class="form-control font-12 shadow-none border" id="wh_tax" name="wh_tax" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="service_tax">Service Tax (PKR)</label>
                  <input class="form-control font-12 shadow-none border" id="service_tax" name="service_tax" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="arrears">Arrears (PKR)</label>
                  <input class="form-control font-12 shadow-none border" id="arrears" name="arrears" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="month">Month</label>
                  <select name="month" id="month" class="custom-select  font-12 shadow-none border" required>
                    <option value="">Select</option>
                    <option value="January">January</option>
                    <option value="Febuary">Febuary</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                  </select>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="credits">Credits</label>
                  <input class="form-control font-12 shadow-none border" id="credits" name="credits" type="text" required />
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