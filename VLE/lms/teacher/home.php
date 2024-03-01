<?php
require_once('header.php');
?>

<style>
    .tabs li a {
        color: black !important;
    }

    .container p {
        /* line-height: -15px; */

    }
</style>

<body>

    <?php
    error_reporting(0);
    $class_id = $_GET['class_id'];
    $subject_id = $_GET['sub_id'];
    require '../includes/profile_navbar.php';
    ?>

    <div class="row">

        <div class="col s12 m2">
            <div class="card-panel ">
            </div><br>
            <div class="card horizontal">
                <div class="card-stacked">
                    <a class="card-conten btn small text -text" href="../<?php echo $_SESSION['role'] ?>/home.php">
                        <span class="cardtitle">Home</span>
                    </a>
                    <br>
                    <a class="card-conten btn small text -text" href="../<?php echo $_SESSION['role'] ?>/notice_sub.php">
                        <span class="cardtitle">My Notices</span>
                    </a>
                    <br>
                    <a class="card-conten btn small text -text" href="../<?php echo $_SESSION['role'] ?>/notice_ass.php">
                        <span class="cardtitle">Assignment Notice</span>
                    </a>
                    <br>
                    <a class="card-conten btn small text -text" href="../../modules/functions/teacher/">
                        <span class="cardtitle">Back to Dashboard</span>
                    </a>
                </div>
            </div>
        </div>


        <!-- search column ends here -->

        <div class="col s12 m8" style="margin-top: 1em;">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" href="#subjects">My Subjects</a></li>
                <li class="tab col s3"><a href="#assignments">My Assignments</a></li>
                <li class="tab col s3"><a href="#recieved">Recieved Assignments</a></li>
                <li class="tab col s3"><a href="#uploads">Upload Learning material</a></li>

            </ul>
        </div>


        <div id="subjects" class="col s12 m8">

            <div class="card-panel green ">

                <span class="white-text">My Subjects</span>

            </div><br>

            <div class="row">
                <table id="table1" class="responsive-table striped">

                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $select2_query = $db->query("SELECT * FROM teacher_subject_class WHERE teacher_id = '$t_id' ");

                        while ($row = $select2_query->fetch_assoc()) {
                        ?>
                            <tr>

                                <?php
                                $subject_id = $row['subject_id'];
                                $q = "SELECT name, id
                        FROM subjects
                        WHERE id = $subject_id";

                                $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                if (mysqli_num_rows($res) > 0) {
                                    while ($r = mysqli_fetch_assoc($res)) {
                                        $teacher_name = $r['name'];
                                        echo "<td>" . $teacher_name . "</td>";
                                    }
                                }
                                ?>

                                <?php
                                $class_id = $row['class_id'];
                                $q = "SELECT name, id
                        FROM classes
                        WHERE id = $class_id";

                                $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                if (mysqli_num_rows($res) > 0) {
                                    while ($r = mysqli_fetch_assoc($res)) {
                                        $teacher_name = $r['name'];
                                        echo "<td>" . $teacher_name . "</td>";
                                    }
                                }
                                ?>

                                <td><a class="btn green waves-effect waves-light" href="subject.php?class_id=<?php echo $class_id . "&sub_id=" . $subject_id ?>">View<i class="material-icons right">send</i></a>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>


        <div id="assignments" class="col s12 m8">
            <div class="card-panel green ">
                <span class="white-text">My Assignments.</span>
                <span class="right"> <a class="waves-effect waves-light btn-small btn" href="notice_ass.php">Create<i class="material-icons right">add</i></a>
                </span>
            </div>
            <br>
            <div class="row">
                <table id="table2" class="responsive-table striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Queston</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>File</th>
                            <th>Date Due </th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $db->query("SELECT * FROM ass_notice WHERE teacher_id='$t_id' ");

                        while ($row = $query->fetch_assoc()) {
                            $ass_id = $row['id'];
                            $name = $row['name'];
                            $question = $row['question'];
                            $subject_id = $row['subject_id'];
                            $class_id = $row['class_id'];
                            $file = $row['assFile'];
                            $dueDate = $row['date_due'];
                            $assDate = $row['date'];

                            $file_path = "../files/ass_notice/" . $file;
                            /*                             * File location */

                            $sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class_id' ");
                            while ($row = $sub_query2->fetch_assoc()) {
                                $class_name = $row['name'];
                            }
                            $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject_id' ");
                            while ($row = $sub_query3->fetch_assoc()) {
                                $sub_name = $row['name'];
                            }
                        ?>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $question ?></td>
                                <td><?php echo $sub_name ?></td>
                                <td><?php echo $class_name ?></td>
                                <td> <a href="<?php echo $file_path ?>"> File </a> </td>
                                <td><?php echo $dueDate ?></td>
                                <td><?php echo $assDate ?></td>
                                <td><a class="btn orange waves-effect waves-light" href="edit_ass.php?ass_id=<?php echo $ass_id . "&class_id=" . $class_id . "&sub_id=" . $subject_id; ?>">
                                        Edit<i class="material-icons right">edit</i></a>
                                </td>
                                <td><a class="btn green waves-effect waves-light" href="view_ass_notice.php?ass_id=<?php echo $ass_id . "&class_id=" . $class_id . "&sub_id=" . $subject_id; ?>">
                                        View<i class="material-icons right">send</i></a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div id="recieved" class="col s12 m8">
            <div class="card-panel green ">
                <span class="white-text"> Recently Recieved Assignments </span>
            </div><br>
            <div class="row">
                <table id="table3" class="responsive-table striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Learner</th>
                            <th>Submmited On</th>
                            <th>Late</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sub_query2 = $db->query("SELECT ass_notice.name AS ass_name, subjects.name AS sub_name, ass_notice.question AS q, classes.name AS class_name, 
                        students.name AS student_name, assignments.date AS date, assignments.late AS late, assignments.assFile
                        FROM assignments 
                        INNER JOIN ass_notice ON ass_notice.id = assignments.question_id
                        INNER JOIN subjects ON subjects.id = ass_notice.subject_id
                        INNER JOIN classes ON classes.id = ass_notice.class_id
                        INNER JOIN students ON students.id = assignments.student_id
                        AND ass_notice.teacher_id = '$t_id' ORDER BY assignments.id DESC");
                        if ($sub_query2->num_rows > 0) {
                            while ($row2 = $sub_query2->fetch_assoc()) {
                                $ass_name = $row2['ass_name'];
                                $sub_name = $row2['sub_name'];
                                $class_name = $row2['class_name'];

                                $student_name = $row2['student_name'];
                                $late = $row2['late'];
                                $assFile = $row2['assFile'];
                                $marks = $row2['marks'];
                                $assDate = $row2['date'];
                        ?>
                                <tr>
                                    <td><?php echo $ass_name; ?></td>
                                    <td><?php echo $sub_name; ?></td>
                                    <td> <?php echo $class_name; ?></td>
                                    <td><?php echo $student_name ?></td>
                                    <td><?php echo $assDate; ?></td>
                                    <td><?php echo $late; ?></td>
                                    <td><?php echo $marks; ?></td>
                                    <td><a class="btn-floating btn-large waves-effect waves-light" href="<?php echo "../files/assignment/" . $assFile; ?>"><i class="material-icons right">file_download</i></a></td>
                                </tr>

                        <?php }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div id="uploads" class="col s12 m8">
            <div class="card-panel green">
                <span class="white-text"> Uploads </span>
                <span class="right">
                    <a class="waves-effect waves-light btn-small btn" href="upload.php">Upload<i class="material-icons right">add</i></a>
                </span>
            </div>
            <br>
            <div class="row">
                <?php
                $query = $db->query("SELECT * FROM upload_materials");

                while ($row = $query->fetch_assoc()) {
                    $name = $row['name'];
                    $cover = $row['cover'];
                    $description = $row['description'];
                    $from = $row['from_age'];
                    $to = $row['to_age'];
                    $file = $row['file'];
                    $date = $row['date'];
                    $up_id = $row['id'];
                    $uploaded_by = $row['teacher_id']; // Retrieve the teacher ID who uploaded the material

                    $file_path = "../files/ass_notice/" . $file;
                    $cover_path = "../files/ass_notice/" . $cover;

                    if ($uploaded_by == $t_id) {
                ?>
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <div class="card" style="border: 1px solid #008000;">
                                <img src="<?php echo $cover_path ?>" class="card-img-top" alt="img" height="200" width="90">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $name ?></h5>
                                    <p class="card-text"><?php echo $description ?></p>
                                    <p class="card-text">From: <?php echo $from ?> - To: <?php echo $to ?></p>
                                    <p class="card-text">Date: <?php echo $date ?></p>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-success btn-sm" href="<?php echo $file_path; ?>"><i class="material-icons center">download</i> Download</a>
                                    <a class="btn btn-warning btn-sm" href="edit_upload.php?ass_id=<?php echo $up_id ?>"><i class="material-icons center">edit</i> Edit</a>
                                    <a class="btn btn-danger btn-sm" href="upload.php?delete_ass=true&ass_id=<?php echo $up_id ?>"><i class="material-icons center">delete</i> Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <div class="card" style="border: 1px solid #008000;">
                                <img src="<?php echo $cover_path ?>" class="card-img-top" alt="img" height="200" width="90">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $name ?></h5>
                                    <p class="card-text"><?php echo $description ?></p>
                                    <p class="card-text">From: <?php echo $from ?> - To: <?php echo $to ?></p>
                                    <p class="card-text">Date: <?php echo $date ?></p>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-primary btn-sm" href="<?php echo $file_path; ?>">Download File</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

        </div>


    </div>


    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                "order": [],
                "dom": 'Bfrtip',
            });
        });
        $(document).ready(function() {
            var table = $('#table2').DataTable({
                "order": [],
                "dom": 'Bfrtip',
            });
        });
        $(document).ready(function() {
            var table = $('#table3').DataTable({
                "order": [],
                "dom": 'Bfrtip',
            });
        });
        $(document).ready(function() {
            var table = $('#table4').DataTable({
                "order": [],
                "dom": 'Bfrtip',
            });
        });
    </script>


    <?php require '../includes/footer.php'; ?>

    <!--  Scripts-->
    <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <!-- <script src="../js/materialize.js"></script> -->

    <script src="../js/init.js"></script>

    <script src="../js/script.js"></script>

</body>

</html>


<?php ?>