<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>
    						
              <hr/>



<main>
    <div class="container-fluid col-md-10">

            <div id="tabs">
                <ul>
                    <li><a href="#all-staff">All</a></li>
                    <li><a href="#lecturers">Teachers</a></li>
                    <li><a href="#accountants">Accountants</a></li>
                    <li><a href="#librarians">Librarians</a></li>
                    <li><a href="#managers">School Management</a></li>
                </ul>
                <div id="all-staff">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>User Type</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM users WHERE user_role != 'student' AND user_role != 'parent' ";
                                        $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                        //$dir = "../../../utils/images/lecturers/";
                                        while($row = mysqli_fetch_array($res)){
                                            //$picname = $row['userid'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['userid']; ?> </td>
                                        <td><?php echo$row['name']; ?> </td>
                                        <td><?php echo $row['user_role']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div id="lecturers">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="staff_tea" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Picture</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM teachers;";
                                        $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                        $string = "";
                                        $images_dir = "../../../utils/images/lecturers/";
                                        while($row = mysqli_fetch_array($res)){
                                            $picname = $row['img'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='50' height='50'> "?></td>
                                        <th><div class="btn-group"><a class="btn btn-success btn-sm text-light" href="../lecturers/view_lecturer.php?id=<?php echo $row["id"]; ?>">View</a>
                                            </div>
                                        </th>
                                    </tr>
                                    <?php

                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div id="accountants">
                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="staff_acc" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Picture</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM accountants;";
                                        $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                        $string = "";
                                        $acc_img = "../../../utils/images/accountants/";
                                        while($row = mysqli_fetch_array($res)){
                                            $picname = $row['img'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo "<img src='".$acc_img.$picname."' alt='".$picname."' width='50' height='50'> "?></td>
                                        <th><div class="btn-group"><a class="btn btn-success btn-sm text-light" href="../accountants/view_accountant.php?id=<?php echo $row["id"]; ?>">View</a>
                                            </div>
                                        </th>
                                    </tr>
                                    <?php

                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div id="librarians">
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="staff_lib" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Picture</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM librarians;";
                                        $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                        $string = "";
                                        $lib_img = "../../../utils/images/librarians/";
                                        while($row = mysqli_fetch_array($res)){
                                            $picname = $row['img'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo "<img src='".$lib_img.$picname."' alt='".$picname."' width='50' height='50'> "?></td>
                                        <th><div class="btn-group"><a class="btn btn-success btn-sm text-light" href="../library/view_librarian.php?id=<?php echo $row["id"]; ?>">View</a>
                                            </div>
                                        </th>
                                    </tr>
                                    <?php

                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div id="managers">
                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="staff_man" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Picture</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM managers;";
                                        $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                        $string = "";
                                        $man_img = "../../../utils/images/school_manager/";
                                        while($row = mysqli_fetch_array($res)){
                                            $picname = $row['img'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo "<img src='".$man_img.$picname."' alt='".$picname."' width='50' height='50'> "?></td>
                                        <th><div class="btn-group"><a class="btn btn-success btn-sm text-light" href=../school_manager/view_manager.php?id=<?php echo $row["id"]; ?>">View</a>
                                            </div>
                                        </th>
                                    </tr>
                                    <?php

                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</main>

<?php require_once('../layouts/footer_to_end.php'); ?>
