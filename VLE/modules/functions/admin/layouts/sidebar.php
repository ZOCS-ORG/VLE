<!-- @Overide some fa styling -->
<style>
    .navbar-nav i.fas{
        color: green !important;
        font-size: 190% !important;
    }
    .collapse-inner a {
        color: green! important;
    }
    .collapse-inner a:hover{
        background-color: lightgreen !important;
        color: black !important;
    }
    li span{
        color: green;
        font-style: bold!important;
        font-size: 110% !important;
    }
    .sidebar-light .sidebar-brand {
        color: green;
    }
    .sidebar_new_bg{
        background: white;
    }

    .sidebar-light .nav-item .nav-link[data-toggle="collapse"]::after {
        display: none;

    }

</style>

<ul class="navbar-nav sidebar_new_bg sidebar sidebar-light accordion" id="accordionSidebar" >

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
       
        <div class="sidebar-brand-text mx-3"> <img src="../vle.png" height="100px" width="200px"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="../index.php">
            <!--<i class="fas fa-fw fa-tachometer-alt "></i>-->
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#school"
           aria-expanded="true" aria-controls="school">
            <!--<i class="fas fa-fw fa-house-user"></i>-->
            <span>Manage Schools</span>
        </a>
        <div id="school" class="collapse" aria-labelledby="school" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item" href="../school/add_school.php">Add School</a>
                <a class="collapse-item" href="../school/all_schools.php">View all Schools</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#staff"
           aria-expanded="true" aria-controls="staff">
            <!--<i class="fas fa-fw fa-chalkboard-teacher"></i>-->
            <span>Manage Users</span>
        </a>
        <div id="staff" class="collapse" aria-labelledby="staff" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item" href="../staff/add_staff.php">Add User</a>
                <a class="collapse-item" href="../staff/all_staff.php">Manage Users</a>
            </div>
        </div>
    </li>

    <li class="nav-item text-color-dark">
        <a class="nav-link" href="../sms/index.php">
            <!--<i class="fas fa-fw fa-setting "></i>-->
            <span>SMS Manager</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


</ul>
