<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php // Single record 
  $data = DB::columns(["v.id","v.name","v.connection_id","v.status","v.created_at","v.updated_at"]);
  $data = DB::columnsmore(["u.first_name","u.last_name","r.issuance_date","r.price","r.account_id"]);
  $data = DB::columnsmore(["r.ptcl_number","u.username","u.address","v.image","r.speed"]);
  $data = DB::table("vouchers as v");
  $data = DB::join(["requests AS r" => ["r.id" => "v.connection_id"]],"LEFT");
  $data = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
  $data = DB::where(["v.id" => app::get("id")]);
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
  <title>Voucher details</title>
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
        <li class="breadcrumb-item"><a href="bills.php">Vouchers</a></li>
        <li class="breadcrumb-item active">Details</li>
      </ol>
      <div class="d-flex flex-column">
        <div class="mb-4 mr-5">
        <button type="button" id="downloadBtn" class="btn btn-danger btn-sm float-right" >Download</button>
        </div>
        <div class="card shadow mb-5 m col-sm-6 p-0 bg-white ml-auto mr-auto">
            <div class="card-header bg-white px-3">
              <h5 class="card-title m-0">
                <b><span class="fa fa-edit mr-2 text-success"></span>Voucher details</b>
              </h5>
            </div>
            <div class="card-body p-0 pb-3 bg-white"  id="Boxdetials">
              <table class="table m-0 bg-white">
                <tr>
                  <td class="border-top-0"><b>Name</b></td>
                  <td class="border-top-0"><?php echo $data['name']; ?></td>
                </tr>
                <tr>
                  <td><b>Customer</b></td>
                  <td><?php echo $data['first_name']." ".$data['last_name']; ?></td>
                </tr>
                <tr>
                  <td><b>Username</b></td>
                  <td><?php echo $data['username']; ?></td>
                </tr>
                <tr>
                  <td><b>Address</b></td>
                  <td><?php echo $data['address']; ?></td>
                </tr>
                <tr>
                  <td><b>Speed</b></td>
                  <td><?php echo $data['speed']; ?></td>
                </tr>
                <tr>
                  <td><b>Due amount</b></td>
                  <td><?php echo app::is_available($data['price']); ?>PKR</td>
                </tr>
                <tr>
                  <td><b>Issuance date</b></td>
                  <td><?php echo app::is_available($data['issuance_date']); ?></td>
                </tr>
                <tr>
                  <td><b>Account#</b></td>
                  <td>#<?php echo app::is_available($data['account_id']); ?></td>
                </tr>
                <tr>
                  <td><b>Paid image</b></td>
                  <td> 
                    <?php if(!empty($data["image"])):?>
                      <a href="./admin/uploads/vouchers/<?php echo $data["image"]; ?>" download="<?php echo $data["image"]; ?>" class="fa fa-download text-success"></a>
                    <?php else:?>
                      <span class="badge badge-danger">N/A</span>  
                    <?php endif;?>  
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>

  <?php app::component("footer"); ?>

<script src="./assets/vendor/html2canvas/html2canvas.min2.js"></script>

<script>
$(document).on("click", "#downloadBtn", function(e){
  e.preventDefault();
  html2canvas(document.querySelector("#Boxdetials")).then(canvas => {
    saveAs(canvas.toDataURL(), `<?php echo $data['name']; ?>`);
  });
});

function saveAs(uri, filename) {
var link = document.createElement('a');
if (typeof link.download === 'string') {
  link.href = uri;
  link.download = filename;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
} else {
  window.open(uri);
}
}
</script>

</body>

</html>