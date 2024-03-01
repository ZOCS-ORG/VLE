<!-- @Overide some fa styling -->
<style>

      /* Add custom styles for sidebar */
      .navbar-nav.sidebar_new_bg .nav-item {
        white-space: normal; 
        /* overflow: clip;  */
       
    }

    /* Adjust padding/margin as needed */
    .navbar-nav.sidebar_new_bg .nav-item .nav-link {
        padding: 10px; /* Adjust as needed */
        margin: 0; /* Reset margin */
    }

    .navbar-nav.sidebar_new_bg .nav-item .nav-link span{
       font-size: 80% !important;
    }

    /* Ensure icon and text are vertically centered */
    .navbar-nav.sidebar_new_bg .nav-item .nav-link i {
        vertical-align: middle;
    }
    
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
        padding-bottom: 10px;

    }

    .sidebar_new_bg {
        background: white;
    }

    .sidebar-light .nav-item .nav-link[data-toggle="collapse"]::after {
        display: none;

    }


    
    /* Fix overlapping dropdown menu items */
    .bg-py-2.collapse-inner.rounded {
        position: relative;
        z-index: 9999; /* Ensure dropdown is on top */
    }

    /* Change background color of dropdown menu */
    .navbar-nav.sidebar_new_bg .nav-item .collapse.show {
        background-color: lightgray;
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#school" aria-expanded="true" aria-controls="school">
            <i class="fa fas fa-fw fa-hospital"></i>
            <span>Manage Schools</span>
        </a>
        <div id="school" class="collapse" aria-labelledby="school" data-parent="#accordionSidebar">
            <div class="bg- py-2 collapse-inner rounded">
                <a class="collapse-item" href="../school/add_school.php">Add School</a>
                <a class="collapse-item" href="../school/all_schools.php">View all Schools</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#staff" aria-expanded="true" aria-controls="staff">
            <i class="fa fas fa-fw fa-users"></i>
            <span>Manage Users</span>
        </a>
        <div id="staff" class="collapse" aria-labelledby="staff" data-parent="#accordionSidebar">
            <div class="bg- py-2 collapse-inner rounded">
                <a class="collapse-item" href="../staff/add_staff.php">Add User</a>
                <a class="collapse-item" href="../staff/all_staff.php">Manage Users</a>
            </div>
        </div>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../complaints/index.php">
            <i class="fa fas fa-fw fa-commenting"></i>
            <span>Queries</span></a>
    </li>
    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../announcements/view_pta.php">
            <i class="fa fas fa-fw fa-book"></i>
            <span>View PTA Notices</span></a>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ptaCollapse" aria-expanded="true" aria-controls="ptaCollapse">
            <i class="fa fas fa-fw fa-users"></i>
            <span>PTA</span>
        </a>
        <div id="ptaCollapse" class="collapse" aria-labelledby="ptaCollapse" data-parent="#accordionSidebar">
            <div class="bg- py-2 collapse-inner rounded">
                <a class="collapse-item" href="../announcements/pta.php">My Notices</a>
                <a class="collapse-item" href="../announcements/view_pta.php">View Notices</a>
            </div>
        </div>
    </li> -->

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../announcements/index.php">
            <i class="fa fas fa-fw fa-commenting"></i>
            <span>Announcements</span></a>
    </li>



    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../../../../lms/<?php echo $_SESSION['role'] ?>">
            <i class="fa fas fa-fw fa-hospital"></i>
            <span>E-Files </span></a>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../blogs/index.php">
            <i class="fa fas fa-fw fa-rss-square"></i>
            <span>Blogs</span></a>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../forums/index.php">
            <i class="fa fas fa-fw fa-comment-o"></i>
            <span> Discussions</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


</ul>