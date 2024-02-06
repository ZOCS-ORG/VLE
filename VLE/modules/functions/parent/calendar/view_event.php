<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $event_id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT  * from calendar where id = '$event_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                        <div class="card-header text-center">
                            <h3> <?php echo $row['name']; ?></h3>
                        </div>                    

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Event type</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php 
                                        echo "<p>".$row['type']."</p>"
                                    ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Event name</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <?php 
                                        echo "<p>".$row['name']."</p>"
                                    ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Description</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <p> <?php echo $row['description']; ?> </p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Start at:</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php
                                        //$unformated = strtotime()
                                        echo $row['start_date'];

                                    ?>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Finishes at:</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php
                                        //$unformated = strtotime()
                                        echo $row['end_date'];

                                    ?>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Created on:</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php
                                        //$unformated = strtotime()
                                        echo $row['created'];

                                    ?>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Created by:</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">

                                    <?php
                                        $created_by = $row['created_by'];
                                        $creator_query = " SELECT name, username, userid FROM users
                                                            WHERE userid = '$created_by' ";
                                        $creator_results = mysqli_query($db, $creator_query);
                                        $creator_row = mysqli_fetch_assoc($creator_results);
                                        echo $creator_row['name'];
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
