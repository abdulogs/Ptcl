<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>
<?php app::getRedirect(["id"],"admin/404.php", false)?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $id = app::post("id");
    $firstname = app::post("fname");
    $lastname = app::post("lname");
    $email = app::post("email");
    $oemail = app::post("oemail");
    $about = app::post("about");
    $phone = app::post("phone");
    $address = app::post("address");
    $password = app::post("password");
    $opassword = app::post("opassword");
    $cnic = app::post("cnic");
    $role = app::post("role");
    $status = app::post("status");


    if ($email == $oemail) {
        $email = $oemail;
    } elseif ($email != $oemail) {
        $email = $email;
    }
    
    if (!empty($password)) {
        $password = md5($password);
    } elseif (empty($password) && $password == "") {
        $password = $opassword;
    }

    $update = DB::update("users", [
        "first_name" => $firstname,
        "last_name" => $lastname,
        "email" => $email,
        "phone" => $phone,
        "password" => $password,
        "address" => $address,
        "about" => $about,
        "cnic" => $cnic,
        "role" => $role,
        "status" => $status,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ]);
    $update = DB::where(["id" => $id]);
    $update = DB::execute();

   if($update) {
    echo "<script>alert('1 record updated!')</script>";
    app::redirect("admin/users.php");  
   } 
}
?>

<?php
    // Single record 
    $data = DB::columns("*");
    $data = DB::table("users");
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
  <title>User update</title>
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
        <li class="breadcrumb-item"><a href="users.php">User</a></li>
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
                  <label class="font-weight-bolder mb-0" for="fname">Firstname</label>
                  <input class="form-control font-12 shadow-none border" id="fname" name="fname" type="text" value="<?php echo $data['first_name']; ?>" required />
                  <input type="hidden" name="id" value="<?php echo app::get("id"); ?>">
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="lname">Lastname</label>
                  <input class="form-control font-12 shadow-none border" id="lname" name="lname" type="text" value="<?php echo $data['last_name']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="uname">Username</label>
                  <input class="form-control font-12 shadow-none border" id="uname" name="uname" type="uname" value="<?php echo $data['username']; ?>" disabled />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="email">Email</label>
                  <input class="form-control font-12 shadow-none border" id="email" name="email" type="email" value="<?php echo $data['email']; ?>" required />
                  <input name="oemail" type="hidden" value="<?php echo $data['email'] ?>" />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="password">Password</label>
                  <input class="form-control font-12 shadow-none border" id="password" name="password" type="password" />
                  <input name="opassword" type="hidden" value="<?php echo $data['password'] ?>" />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="phone">Phone</label>
                  <input class="form-control font-12 shadow-none border" id="phone" name="phone" type="phone" value="<?php echo $data['phone']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="cnic">Cnic</label>
                  <input class="form-control font-12 shadow-none border" id="cnic" name="cnic" type="cnic" value="<?php echo $data['cnic']; ?>" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="address">Address</label>
                  <input class="form-control font-12 shadow-none border" id="address" name="address" type="address" value="<?php echo $data['address']; ?>" required />
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="about">About</label>
                  <textarea class="form-control font-12 shadow-none border" id="about" name="about" rows="6"><?php echo $data['first_name']; ?></textarea>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="status">Status</label>
                  <select name="status" id="status" class="custom-select font-12 shadow-none border">
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
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="role">Role</label>
                  <select name="role" id="role" class="custom-select  font-12 shadow-none border">
                    <optgroup label="Select">
                        <option value="<?php echo $data['role']?>">
                            <?php echo ($data["role"] == 1) ? "Admin" :"Customer" ; ?>
                        </option>
                    </optgroup>
                    <option value="1">Admin</option>
                    <option value="0">Customer</option>
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