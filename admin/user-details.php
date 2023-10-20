<?php require_once "../classes/database.php"; ?>
<?php app::isLogout("id", "admin/index.php"); ?>

<?php // Single record 
    $data = DB::columns("*");
    $data = DB::table("users");
    $data = DB::where(["id" => app::get("id")]);
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
  <title>User details</title>
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
        <li class="breadcrumb-item"><a href="bills.php">User</a></li>
        <li class="breadcrumb-item active">Details</li>
      </ol>
      <div class="d-flex align-items-center justify-content-center">
          <div class="card shadow mb-5 m col-sm-6 p-0">
            <div class="card-header bg-white px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>User details</b>
              </h5>
            </div>
            <div class="card-body p-0 pb-3">
              <table class="table m-0">
                <tr>
                  <td class="border-top-0"><b>Fullname</b></td>
                  <td class="border-top-0"><?php echo $data['first_name']." ".$data['last_name']; ?></td>
                </tr>
                <tr>
                  <td><b>Username</b></td>
                  <td><?php echo $data['username']; ?></td>
                </tr>
                <tr>
                  <td><b>Email</b></td>
                  <td><?php echo $data['email']; ?></td>
                </tr>
                <tr>
                  <td><b>Phone</b></td>
                  <td><?php echo $data['phone']; ?></td>
                </tr>
                <tr>
                  <td><b>Cnic</b></td>
                  <td><?php echo $data['cnic']; ?></td>
                </tr>
                <tr>
                  <td><b>Address</b></td>
                  <td><?php echo $data['address']; ?></td>
                </tr>
                <tr>
                  <td><b>About</b></td>
                  <td><?php echo $data['about']; ?></td>
                </tr>

                <tr>
                  <td><b>Status</b></td>
                  <td><?php echo app::is_approved($data['status']); ?></td>
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