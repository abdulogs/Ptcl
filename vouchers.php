<?php require_once "./classes/database.php"; ?>
<?php app::isLogout("id", "index.php"); ?>

<?php // Listing
  $page = (isset($_GET["page"])) ? $_GET["page"] : 1;
  $page = ($page == 0) ? 1 : $page ;
  $limit = 10;
  $colspan = 10;

  $listing = DB::columns(["v.id","v.name","v.connection_id","v.status","v.created_at","v.updated_at"]);
  $listing = DB::columnsmore(["u.first_name","u.last_name","r.issuance_date","r.price","r.account_id"]);
  $listing = DB::table("vouchers as v");
  $listing = DB::join(["requests AS r" => ["r.id" => "v.connection_id"]],"LEFT");
  $listing = DB::join(["users AS u" => ["u.id" => "r.user_id"]],"LEFT");
  $listing = DB::where(["r.user_id" => app::getSession("id")]);
  $listing = DB::order("id", "DESC");
  $listing = DB::paging($page, $limit);
  $listing = DB::execute();
  $listing = DB::fetch("all"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Vouchers</title>
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
        <li class="breadcrumb-item active">Vouchers</li>
      </ol>
      <div class="card shadow p-0 bg-white">
            <div class="d-flex align-items-center px-3 py-2">
              <h6 class="m-0 align-middle">
                <i class=" fa fa-check text-success"></i> <b>Vouchers</b>
              </h6>
            </div>
            <table class="table table-card table-sm mb-0">
              <thead class="bg-light border-top">
                <tr>
                  <th class="px-3 border-0" scope="col">ID</th>
                  <th class="border-0" scope="col">Name</th>
                  <th class="border-0" scope="col">Customer</th>
                  <th class="border-0" scope="col">Issue date</th>
                  <th class="border-0" scope="col">Price</th>
                  <th class="border-0" scope="col">Account #</th>
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
                        <td class="align-middle text-break" data-label="Name">
                          <?php echo $data["name"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Customer">
                          <?php echo ucfirst($data["first_name"]." ".$data["last_name"]); ?>
                        </td>
                        <td class="align-middle text-break" data-label="Issue date">
                          <?php echo $data["issuance_date"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Price">
                          <?php echo $data["price"]; ?> PKR
                        </td>
                        <td class="align-middle text-break" data-label="Account #">
                          <?php echo $data["account_id"]; ?>
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
                            <a href="voucher-details.php?id=<?php echo $data["id"]; ?>" class="fa fa-eye text-success"></a>
                            <a href="voucher-update.php?id=<?php echo $data["id"]; ?>" class="fa fa-pencil text-info"></a>
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
                      <a href="vouchers.php?page=<?php echo $page - 1; ?>" class="btn btn-sm btn-light border font-12 px-3" >
                        <b>Back</b>
                      </a>
                    <?php endif;?>

                    <?php if($listing): ?>
                      <a href="vouchers.php?page=<?php echo $page + 1; ?>" class="btn btn-sm btn-light border font-12 px-3" <?php echo ($listing) ? "": "disbaled"; ?>>
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