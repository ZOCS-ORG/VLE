<!-- Dropdown Structure -->
<?php
include('../../modules/utils/vars.php');
if (empty($t_id)) {
    ?>

    <!-- for students -->

    <ul id="nav_drop" class="dropdown-content">
        <li><a href="../student/stud_profile.php">Home</a></li>
        <li><a href="../student/submit.php">Submit Assignments</a></li>
        <li><a href="../student/show_notices.php">Notifications</a></li>
        <li><a href="../student/forum.php">Forum</a></li>
        <li class="divider"></a></li>
        <li><a href="../../modules/functions/student/">Back to Dashboard</a></li>
    </ul>

<?php } else { ?>

    <!-- for teacher -->

    <ul id="nav_drop" class="dropdown-content">
        <li><a href="../moe/home.php">Home</a></li>
        <li><a href="../moe/notice_sub.php">My Notices</a></li>
        <li><a href="../moe/notice_ass.php">Assignment Notice</a></li>
        <li><a href="../moe/forum.php">Forum</a></li>
        <li class="divider"></a></li>
        <li><a href="../../modules/functions/moe/">Back to Dashboard</a></li>
    </ul>



<?php } ?>

<nav  style=" background-color: green ">
    <div class="nav-wrapper white-text" style="padding-left: 10px;">
      <!-- <a href="#" data-activates="slide-out" class="button-collapse white-text"><i class="material-icons">menu</i></a> -->
        <a href="" class="brand-logo white-text"><?php echo $school_name ?></a>
        <ul class="right hide-on-med-and-down">
            <!-- Dropdown Trigger -->
            <!-- <li><a href="../pages/submit.php">Submit</a></li> -->
            <li style="min-width: 200px"><a class="dropdown-button white-text" href="#!" data-activates="nav_drop">
                    <?php
                    if (empty($t_username)) {
                        echo $s_username;
                    } else {
                        echo $t_username;
                    }
                    ?>
                    <i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>