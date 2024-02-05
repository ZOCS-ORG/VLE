<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT  * from classes where id = '$id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                        <div class="card-header text-center">
                            <h3> Class <?php echo $row['name']; ?></h3>
                        </div>                    

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Class Teacher</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php 
                                        $teacher_id = $row['teacher_id'];
                                        $q = "SELECT name, id
                                        FROM teachers
                                        WHERE id = $teacher_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<p><a  href='../lecturers/view_lecturer.php?id=".$r['id']."'>".$teacher_name."</a></p>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Class Monitor</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <?php 
                                        $student_id = $row['monitor_id'];
                                        $q = "SELECT name, id
                                        FROM students
                                        WHERE id = $student_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $student_name = $r['name'];
                                                echo "<p><a  href='../students/view_student.php?id=".$r['id']."'>".$student_name."</a></p>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Class Room No.</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <p> <?php echo $row['room']; ?> </p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Students</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php
                                        $query ="SELECT students.*
                                                FROM students
                                                WHERE class_id = '$id' ";
                                        $resultss = mysqli_query($db, $query)or die('Error getting students: '. mysqli_error($db));
                                        while($res_student = mysqli_fetch_array($resultss)){
                                            $student_name = $res_student['name'];
                                            $student_id = $res_student['id'];
                                            echo "<a class='text-primary' href='../students/view_student.php?id=".$student_id."'>".$student_name."</a> | ";
                                        }
                                    ?>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>
        </main>
        <?php
                }
            } else {
            echo 'No Records Found!';
            }
        ?>

<?php require_once('../layouts/footer_to_end.php'); ?>
