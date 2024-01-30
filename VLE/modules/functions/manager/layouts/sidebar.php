    <!-- @Overide some fa styling -->
   <style>
    .navbar-nav i.fas{
        color: #f8f9fc !important;
        font-size: 190% !important;
    }
    .collapse-inner a {
        color: white! important;
    }
    .collapse-inner a:hover{
        background-color: lightgreen !important;
        color: black !important;
    }
    li span{
        color: #f8f9fc;
        font-style: bold!important;
        font-size: 110% !important;
    }
    .sidebar-light .sidebar-brand {
        color: #f8f9fc;
    }
    .sidebar_new_bg{
        background: #0067a9;
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
        <?php //Get Title..
        $query =  "SELECT name FROM school_info ";
        $results = mysqli_query($db, $query);
        $row = mysqli_fetch_array($results);
        $school_name = $row['name'];
        ?>
        <div class="sidebar-brand-text mx-3"><?php echo $school_name; ?> </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="../index.php">
         
          <span>Dashboard</span></a>
      </li>

      
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../classes/index.php">
      
        <span>Classes</span></a>
      </li>
      
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../subjects/index.php">
     
        <span>Subjects</span></a>
      </li>
      
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../events/index.php">
        
        <span>My Events</span></a>
      </li>
      
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../announcements/index.php">
       
        <span>My Announcements</span></a>
      </li>
      
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../calendar/index.php">
        
        <span>My Calendar </span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#students" aria-expanded="true" aria-controls="students">
          
          <span>Management Reports </span>
        </a>
        <div id="students" class="collapse" aria-labelledby="students" data-parent="#accordionSidebar">
          <div class="bg-dark py-4 collapse-inner rounded">
            <a class="collapse-item" href="">Student Achievements<br>
                By School</a>
            <a class="collapse-item" href="">Student demographics<br>
                Report</a>
            
            <a class="collapse-item" href="">Student growth<br>
                and progress Report</a>
            <a class="collapse-item" href="">Student Attendance<br>
                Report</a>
          
                       
            <!-- <a class="collapse-item" href="../reports/student_owing.php">Student Owing Report</a> -->
          </div>
        </div>
      </li>
      
      <!-- Divider -->
   
  

    </ul>