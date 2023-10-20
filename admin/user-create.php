<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = app::post("fname");
    $lastname = app::post("lname");
    $username = app::post("uname");
    $email = app::post("email");
    $about = app::post("about");
    $phone = app::post("phone");
    $address = app::post("address");
    $password = app::post("password");
    $cnic = app::post("cnic");
    $role = app::post("role");
    $status = app::post("status");

    $create = DB::insert("users", [
        "first_name" => $firstname,
        "last_name" => $lastname,
        "username" => $username,
        "email" => $email,
        "phone" => $phone,
        "password" => md5($password),
        "address" => $address,
        "about" => $about,
        "cnic" => $cnic,
        "role" => $role,
        "status" => $status,
        "created_at" => date("Y/m/d h:i:s A"),
        "updated_at" => date("Y/m/d h:i:s A")
    ])::execute();

   if($create) {
    echo "<script>alert('1 record inserted!')</script>";
    app::redirect("admin/users.php");  
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
  <title>User create</title>
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
        <li class="breadcrumb-item"><a href="users.php">Users</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="col-sm-6">
          <div class="card shadow mb-5 mt-5">
            <div class="card-header bg-white text-center px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-plus-circle mr-2 text-success"></span>CREATE</b>
              </h5>
            </div>
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="fname">Firstname</label>
                  <input class="form-control font-12 shadow-none border" id="fname" name="fname" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="lname">Lastname</label>
                  <input class="form-control font-12 shadow-none border" id="lname" name="lname" type="text" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="uname">Username</label>
                  <input class="form-control font-12 shadow-none border" id="uname" name="uname" type="uname" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="email">Email</label>
                  <input class="form-control font-12 shadow-none border" id="email" name="email" type="email" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="password">Password</label>
                  <input class="form-control font-12 shadow-none border" id="password" name="password" type="password" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="phone">Phone</label>
                  <input class="form-control font-12 shadow-none border" id="phone" name="phone" type="phone" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="cnic">Cnic</label>
                  <input class="form-control font-12 shadow-none border" id="cnic" name="cnic" type="cnic" required />
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="address">Address</label>
                  <input class="form-control font-12 shadow-none border" id="address" name="address" type="address" required />
                </div>
                <div class="form-group col-sm-12 mb-2">
                  <label class="font-weight-bolder mb-0" for="about">About</label>
                  <textarea class="form-control font-12 shadow-none border" id="about" name="about" rows="6"></textarea>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="status">Status</label>
                  <select name="status" id="status" class="custom-select font-12 shadow-none border">
                    <option value="0">Pending</option>
                    <option value="1">Accept</option>
                    <option value="2">Reject</option>
                  </select>
                </div>
                <div class="form-group col-sm-6 mb-2">
                  <label class="font-weight-bolder mb-0" for="role">Role</label>
                  <select name="role" id="role" class="custom-select  font-12 shadow-none border">
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