<?php
require_once('header.php');
?>

<body>

    <?php
    error_reporting(0);
    $class_id = $_GET['class_id'];
    $subject_id = $_GET['sub_id'];
    require '../includes/profile_navbar.php';
    ?>

    <div class="row">
        <!-- search column starts here -->
        <div class="col s12 m2">
            <div class="card-panel ">
            </div><br>
            <div class="card horizontal">
                <div class="card-stacked">
                </div>
            </div>
        </div>

        <!-- search column ends here -->

        <div class="col s12 m8" style="margin-top: 1em;">
            <ul class="tabs">               
                <li class="tab col s3"><a href="#assignments">E-Documents</a></li>
                <li class="tab col s3"><a href="#recieved">Received Concerns / Messages </a></li>
            </ul>
        </div>

        <div id="assignments" class="col s12 m8">
            <div class="card-panel blue">
                <span class="white-text">E-Documents</span>
                <span class="right"> <a class="waves-effect waves-light btn-small btn" href="notice_ass.php">Add Document<i class="material-icons right">add</i></a>
                </span>
            </div>
            <br>
            <div class="row">
                <table id="table2" class="responsive-table striped">
                    <thead>
                        <tr>
                            <th data-field="ass_no">Name of Upload</th>
                            <th class="txt_limit" data-field="q">Document Details / Info</th>
                            <th data-field="subject">URL</th>
                            <th data-field="file">File</th>
                            <th data-field="date">Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $db->query("SELECT * FROM moe_uploads ");

                        while ($row = $query->fetch_assoc()) {

                            $name = $row['title'];
                            $question = $row['description'];
                            $url = $row['url'];

                            $file = $row['file'];
                            $dueDate = $row['date_added'];
                            $assDate = $row['date'];
                            $ass_id = $row['upload_id'];

                            $file_path = "../files/moe_uploads/" . $file;
                            ?>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $question ?></td> 
                                <td> <a href="<?php echo $url ?>"> Go to URL </a>  </td>                        
                                <td> <a href="<?php echo $file_path ?>"> File </a>  </td>
                                <td><?php echo $dueDate ?></td>
                                <td>                                 
                                    <a class="btn small red waves-effect waves-light" href="notice_ass.php?delete_upload=true&ass_id=<?php echo $ass_id ?>"> Delete </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="recieved" class="col s12 m8">
            <div class="card-panel green">
                <span class="white-text"> Received Concerns / Messages  </span>
            </div><br>
            <div class="row">
                <table id="table3" class="responsive-table striped">
                    <thead>
                        <tr>
                            <th data-field="ass_no">Name of Upload</th>
                            <th class="txt_limit" data-field="q">Document Details / Info</th>
                            <th data-field="subject">URL</th>
                            <th data-field="file">File</th>
                            <th data-field="date">Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $db->query("SELECT * FROM moe_uploads ");
                        while ($row = $query->fetch_assoc()) {
                            $name = $row['title'];
                            $question = $row['description'];
                            $url = $row['url'];
                            $file = $row['file'];
                            $dueDate = $row['date_added'];
                            $assDate = $row['date'];
                            $ass_id = $row['upload_id'];

                            $file_path = "../files/moe_uploads/" . $file;
                            ?>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $question ?></td>
                                <td><?php echo $url ?></td>                          
                                <td> <a href="<?php echo $file_path ?>"> File </a>  </td>
                                <td><?php echo $dueDate ?></td>
                                <td>                                 
                                    <a class="btn small red waves-effect waves-light" href="notice_ass.php?delete_upload=true&ass_id=<?php echo $ass_id ?>"> Delete </a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- reg srch column starts here -->

        <div class="col s12 m2">

        </div>

        <!-- reg srch column starts here   -->

    </div>


    <script>
        $(document).ready(function () {
            var table = $('#table1').DataTable({
                "order": [],
                "dom": 'Bfrtip',
            });
        });
        $(document).ready(function () {
            var table = $('#table2').DataTable({
                "order": [],
                "dom": 'Bfrtip',
            });
        });
        $(document).ready(function () {
            var table = $('#table3').DataTable({
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