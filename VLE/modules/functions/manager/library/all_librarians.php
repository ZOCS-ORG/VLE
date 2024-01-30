<?php 
    require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>   						
<hr/>
<main>
    <div class="container-fluid col-md-9">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-center">Librarian's list</h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="add_librarian.php">Add <i class="fas fa-plus "></i> </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Picture</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM librarians;";
                                $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                $string = "";
                                $images_dir = "../../../utils/images/librarians/";
                                while($row = mysqli_fetch_array($res)){
                                    $picname = $row['img'];
                            ?>
                            <tr>
                                <td><a href="view_librarian.php?id=<?php echo $row["id"]; ?>"><?php echo $row['id']; ?> </td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='50' height='50'> "?></td>
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
