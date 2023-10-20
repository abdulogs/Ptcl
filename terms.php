<?php require_once "./classes/database.php"; ?>
<?php app::isLogin("id", "dashboard.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTCL | Terms and conditions</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="assets/css/admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Your custom styles -->
  <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body class="h-100 d-flex flex-column bg-white">


  <?php app::component("navbar"); ?>
  <main class="container h-100 content">
    <div class="row pt-3">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center">
            <h1 class=" mb-4"><b>Terms and conditions</b></h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea voluptates tempore quidem voluptas sit,
                blanditiis autem nesciunt
                tempora non nemo similique, voluptatibus numquam fugit odio quisquam. Aliquam accusantium eos illo.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea voluptates tempore quidem voluptas sit,
                blanditiis autem nesciunt
                tempora non nemo similique, voluptatibus numquam fugit odio quisquam. Aliquam accusantium eos illo.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea voluptates tempore quidem voluptas sit,
                blanditiis autem nesciunt
                tempora non nemo similique, voluptatibus numquam fugit odio quisquam. Aliquam accusantium eos illo.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea voluptates tempore quidem voluptas sit,
                blanditiis autem nesciunt
                tempora non nemo similique, voluptatibus numquam fugit odio quisquam. Aliquam accusantium eos illo.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea voluptates tempore quidem voluptas sit,
                blanditiis autem nesciunt
                tempora non nemo similique, voluptatibus numquam fugit odio quisquam. Aliquam accusantium eos illo.
            </p>

        </div>
        <div class="col-sm-3"></div>
    </div>
</main>

<?php app::component("footer-2"); ?>

</body>

</html>