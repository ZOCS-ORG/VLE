<?php 
    require_once('../scripts/hostel_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>  						
    <hr/>

<main>
    <div class="container-fluid col-md-9">
        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Hostel's list</h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="add_hostel.php">Add <i class="fas fa-plus "></i> </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Beds</td>
                                <td>Patreon</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM hostels;";
                                $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                while($row = mysqli_fetch_array($res)){
                            ?>
                            <tr>
                                <td><a href="view_hostel.php?id=<?php echo $row["id"]; ?>"><?php echo $row['id']; ?> </td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['beds']; ?></td>
                                <td><?php echo $row['patreon']; ?></td>
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
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>
