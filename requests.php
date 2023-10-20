<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php // Listing
  $page = (isset($_GET["page"])) ? $_GET["page"] : 1;
  $page = ($page == 0) ? 1 : $page ;
  $limit = 10;
  $colspan = 10;

  $listing = DB::columns(["r.id","r.user_id","r.speed","r.price","r.status","r.created_at", "r.updated_at"]);
  $listing = DB::columnsmore(["r.account_id","r.issuance_date","r.ptcl_number"]);
  $listing = DB::columnsmore(["u.first_name","u.last_name","u.email","u.phone","u.address"]);
  $listing = DB::table("requests as r");
  $listing = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
  $listing = DB::where(["r.user_id"=> app::getSession("id")]);
  $listing = DB::order("r.id", "DESC");
  $listing = DB::paging($page, $limit);
  $listing = DB::execute();
  $listing = DB::fetch("all"); ?>

  <?php // Delete
    if(isset($_GET["id"])){
      $delete = DB::delete("requests");
      $delete = DB::where(["id" => app::get("id")]);
      $delete = DB::execute();
      echo "<script>alert('1 record deleted!')</script>";
      app::redirect("requests.php");
  } ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Connection requests</title>
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
        <li class="breadcrumb-item active">Connection requests</li>
      </ol>
      <div class="card shadow p-0 bg-white">
            <div class="d-flex align-items-center px-3 py-2">
              <h6 class="m-0 align-middle">
                <i class=" fa fa-check-circle text-success"></i> <b>Connection requests</b>
              </h6>
              <a class="btn btn-success btn-sm font-12 rounded ml-auto" href="request-create.php" >
                <span class="fa fa-plus-circle"></span> Create
              </a>
            </div>
            <table class="table table-card table-sm mb-0">
              <thead class="bg-light border-top">
                <tr>
                  <th class="px-3 border-0" scope="col">ID</th>
                  <th class="border-0" scope="col">Speed</th>
                  <th class="border-0" scope="col">Price</th>
                  <th class="border-0" scope="col">Account id</th>
                  <th class="border-0" scope="col">Issuance date</th>
                  <th class="border-0" scope="col">Ptcl number</th>
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
                        <td class="align-middle text-break" data-label="Speed">
                          <?php echo $data["speed"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Price">
                          <?php echo $data["price"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Account id">
                         #<?php echo $data["account_id"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Issuance date">
                          <?php echo app::formatDatetime($data["issuance_date"]); ?>
                        </td>
                        <td class="align-middle text-break" data-label="Ptcl number">
                          <?php echo $data["ptcl_number"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Status">
                        <?php app::is_approved($data["status"]); ?>
                        </td>
                        <td class="align-middle text-break" data-label="Created at">
                          <?php echo app::formatDatetime($data["created_at"]); ?>
                        </td>
                        <td class="align-middle text-break" data-label="Updated at">
                          <?php echo app::formatDatetime($data["updated_at"]); ?>
                        </td>
                        <td class="align-middle px-3" data-label="Controls">
                        <a href="request-details.php?id=<?php echo $data["id"]; ?>" class="fa fa-eye text-success"></a>
                        <a href="request-update.php?id=<?php echo $data["id"]; ?>" class="fa fa-pencil text-info"></a>
                        <a href="requests.php?id=<?php echo $data["id"]; ?>" class="fa fa-trash text-danger"></a>
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
                      <a href="requests.php?page=<?php echo $page - 1; ?>" class="btn btn-sm btn-light border font-12 px-3" >
                        <b>Back</b>
                      </a>
                    <?php endif;?>

                    <?php if($listing): ?>
                      <a href="requests.php?page=<?php echo $page + 1; ?>" class="btn btn-sm btn-light border font-12 px-3" <?php echo ($listing) ? "": "disbaled"; ?>>
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