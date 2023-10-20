<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
    $price = app::post("price");
    $account_id = app::post("account_id");
    $issuance_date = app::post("issuance_date");
    $ptcl_number = app::post("ptcl_number");
    $status = app::post("status");

    $update = DB::update("requests", [
        "price" => $price,
        "account_id" => $account_id,
        "issuance_date" => $issuance_date,
        "ptcl_number" => $ptcl_number,
        "status" => $status,
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("admin/requests.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns(["r.id","r.user_id","r.speed","r.price","r.status","r.created_at", "r.updated_at"]);
    $data = DB::columnsmore(["r.account_id","r.issuance_date","r.ptcl_number"]);
    $data = DB::columnsmore(["u.first_name","u.last_name","u.email","u.phone","u.address"]);
    $data = DB::table("requests as r");
    $data = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
    $data = DB::where(["r.id" => app::get("id")]);
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
  <title>Request update</title>
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
        <li class="breadcrumb-item"><a href="requests.php">Connection requests</a></li>
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
                  <label class="font-weight-bolder mb-0" for="speed">Internet speed</label>
                  <input class="form-control font-12 shadow-none border" id="speed" name="speed" type="text" value="<?php echo $data['speed']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="price">Price</label>
                  <input class="form-control font-12 shadow-none border" id="price" name="price" type="text" value="<?php echo $data['price']; ?>"  />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="account_id">Account id</label>
                  <input class="form-control font-12 shadow-none border" id="account_id" name="account_id" type="text" value="<?php echo $data['account_id']; ?>"  />
                </div>
                <div class="form-group col-sm-4 mb-2">
                  <label class="font-weight-bolder mb-0" for="issuance_date">Issuance date</label>
                  <input class="form-control font-12 shadow-none border" id="issuance_date" name="issuance_date" type="date" value="<?php echo $data['issuance_date']; ?>"  />
                </div>
                <div class="form-group col-sm-4 mb-2">
                  <label class="font-weight-bolder mb-0" for="ptcl_number">Ptcl number</label>
                  <input class="form-control font-12 shadow-none border" id="ptcl_number" name="ptcl_number" type="text" value="<?php echo $data['ptcl_number']; ?>"  />
                </div>
                <div class="form-group col-sm-4 mb-2">
                  <label class="font-weight-bolder mb-0" for="status">Status</label>
                  <select name="status" id="status" class="custom-select  font-12 shadow-none border">
                    <optgroup label="Select">
                        <option value="<?php echo $data['status']?>">
                        <?php if($data["status"] == 0): ?>
                            Pending
                          <?php elseif($data["status"] == 1): ?>
                            Approved
                          <?php elseif($data["status"] == 2):?>
                            Rejected
                          <?php endif;?>
                        </option>
                    </optgroup>
                    <option value="0">Pending</option>
                    <option value="1">Accept</option>
                    <option value="2">Reject</option>
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