<!-- @Overide some fa styling -->
<style>
    .navbar-nav i.fas {
        color: green !important;
        font-size: 190% !important;
    }

    .collapse-inner a {
        color: green ! important;
    }

    .collapse-inner a:hover {
        background-color: lightgreen !important;
        color: black !important;
    }

    li span {
        color: green;
        font-style: bold !important;
        font-size: 110% !important;
    }

    .sidebar-light .sidebar-brand {
        color: green;
    }

    .sidebar_new_bg {
        background: white;
    }

    .sidebar-light .nav-item .nav-link[data-toggle="collapse"]::after {
        display: none;

    }
</style>

<ul class="navbar-nav sidebar_new_bg sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <?php
        //Get Title..
        $query = "SELECT name FROM school_info ";
        $results = mysqli_query($db, $query);
        $row = mysqli_fetch_array($results);
        $admin_acc_title = $row['name'];
        ?>
        <div class="sidebar-brand-text mx-3"> <img src="../../../assets/logo/vle.png" height="70px" width="200px"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <br>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="../index.php">
            <i class="fa fas fa-fw fa-tachometer"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../staff/all_staff.php">
            <i class="fa fas fa-fw fa-users"></i>
            <span>Manage Teachers</span></a>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../complaints/index.php">
            <i class="fa fas fa-fw fa-frown-o"></i>
            <span>Queries </span></a>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../announcements/index.php">
            <i class="fa fas fa-fw fa-commenting"></i>
            <span>Announcements</span></a>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../../../../lms/drc/zone.php">
            <i class="fa fas fa-fw fa-users"></i>
            <span>Zone</span></a>
    </li>

    <!-- <li class="nav-item text-color-dark">
        <a class="nav-link" href="../announcements/pta.php">
            <i class="fa fas fa-fw fa-commenting"></i>
            <span>PTA</span></a>
    </li> -->

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#staff" aria-expanded="true" aria-controls="staff">
            <i class="fa fas fa-fw fa-users"></i>
            <span>PTA</span>
        </a>
        <div id="staff" class="collapse" aria-labelledby="staff" data-parent="#accordionSidebar">
            <div class="bg- py-2 collapse-inner rounded">
                <a class="collapse-item" href="../announcements/pta.php">My Notices</a>
                <a class="collapse-item" href="../announcements/view_pta.php">View Notices</a>
            </div>
        </div>
    </li> -->

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../account/reports.php">
            <i class="fa fas fa-fw fa-tachometer"></i>
            <span>Enrollment </span></a>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../blogs/index.php">
            <i class="fa fas fa-fw fa-rss-square"></i>
            <span>Blogs</span></a>
    </li>

    <!-- <li class="nav-item text-color-dark">
        <a class="nav-link" href="../zones/index.php">
            <i class="fa fas fa-fw fa-list"></i>
            <span>Zones</span></a>
    </li> -->


</ul>