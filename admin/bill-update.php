<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
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
    $status = app::post("status");

    $update = DB::update("bills", [
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
        "status" => $status,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("admin/bills.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["id","user_id","due_amount","late_amount","status","created_at", "updated_at"]);
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
        <form method="POST" class="col-sm-6">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Update</b>
              </h5>
            </div>

            <div class="card-body">
              <div class="form-row">
              <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="user_id">Customer</label>
                  <input type="hidden" name="id" value="<?php echo app::get("id"); ?>">
                  <select name="user_id" id="user_id" class="custom-select  font-12 shadow-none border">
                    <?php // All users  
                      $users = DB::columns(["id","first_name","last_name", "username"])::table("users")::execute();
                      $users = DB::fetch("all");?>
                      <?php foreach ($users as $user):?>
                        <option value="<?php echo $user['id']; ?>" <?php echo ($data["user_id"] == $user["id"]) ? "selected" :"" ; ?>>
                        <?php echo $user['first_name']." ".$user['last_name']; ?> (@<?php echo $user['username']; ?>)
                        </option>
                      <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="usage_mbs">Usage</label>
                  <input class="form-control font-12 shadow-none border" id="usage_mbs" name="usage_mbs" type="text" value="<?php echo $data['usage_mbs']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="due_amount">Due amount</label>
                  <input class="form-control font-12 shadow-none border" id="due_amount" name="due_amount" type="text" value="<?php echo $data['due_amount']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="late_amount">Late amount</label>
                  <input class="form-control font-12 shadow-none border" id="late_amount" name="late_amount" type="text" value="<?php echo $data['late_amount']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="due_date">Due date</label>
                  <input class="form-control font-12 shadow-none border" id="due_date" name="due_date" type="date" value="<?php echo $data['due_date']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="wh_tax">W.H Tax</label>
                  <input class="form-control font-12 shadow-none border" id="wh_tax" name="wh_tax" type="text" value="<?php echo $data['wh_tax']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="service_tax">Service Tax</label>
                  <input class="form-control font-12 shadow-none border" id="service_tax" name="service_tax" type="text" value="<?php echo $data['service_tax']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="arrears">Arrears</label>
                  <input class="form-control font-12 shadow-none border" id="arrears" name="arrears" type="text" value="<?php echo $data['arrears']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="month">Month</label>
                  <select name="month" id="month" class="custom-select  font-12 shadow-none border" required>
                    <optgroup label="Selected">
                        <option value="<?php echo $data['month']?>"><?php echo $data['month']?></option>
                    </optgroup>
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
                  <input class="form-control font-12 shadow-none border" id="credits" name="credits"  type="text" value="<?php echo $data['credits']; ?>" required />
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