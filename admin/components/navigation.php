<?php app::sessionRoleRedirect("role", 0, "403.php"); ?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand p-2" href="index.php"><b class="text-success">PTCL</b></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a class="nav-link" href="users.php">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="nav-link-text">Users</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bills">
                <a class="nav-link" href="bills.php">
                    <i class="fa fa-fw fa-dollar"></i>
                    <span class="nav-link-text">Bills</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Vouchers">
                <a class="nav-link" href="vouchers.php">
                    <i class="fa fa-fw fa-check"></i>
                    <span class="nav-link-text">Vouchers</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Compliants">
                <a class="nav-link" href="compliants.php">
                    <i class="fa fa-fw fa-flag"></i>
                    <span class="nav-link-text">Compliants</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Requests">
                <a class="nav-link" href="requests.php">
                    <i class="fa fa-fw fa-check-circle"></i>
                    <span class="nav-link-text">Connection Requests</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
                <a class="nav-link" href="profile.php">
                    <i class="fa fa-fw fa-user-circle"></i>
                    <span class="nav-link-text">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="../index.php">
                    <i class="fa fa-fw fa-globe"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-toggle="modal" data-target="#logout">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- /Navigation-->