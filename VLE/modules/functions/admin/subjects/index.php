<?php
// require_once('../scripts/program_validation.php');
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');

?>
<hr />

<style>

@media screen {
    .subbtn a{

        width: 40%;

    }
}

</style>

<main>
    <div class="container-fluid col-md-11">
        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Subjects offered</h3>
                <div class="text-right text-light">
                    <div class="d-flex flex-wrap justify-content-evenly subbtn">
                        <a class="btn btn-sm btn-dark flex-grow-1 mb-2 mb-md-0" href="../grades/index.php">Manage grades <i class="fas fa-percent "></i> </a>
                        <a class="btn btn-sm btn-secondary flex-grow-1 mb-2 mb-md-0" href="create_subject.php">Add subject <i class="fas fa-plus "></i> </a>
                        <a class="btn btn-sm btn-primary flex-grow-1" href="assign_subject.php">Assign subject to teacher <i class="fas fa-check "></i> </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM subjects;";
                            $res = mysqli_query($db, $sql) or die('An error occurred: ' . mysqli_error($db));

                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['id']; ?> </td>
                                    <td> <?php echo $row['name']; ?></td>
                                    <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_subject.php?id=<?php echo $row['id'] ?>">Edit</a>
                                        <form method="post" action="">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm text-light" name="delete_subject" onclick="return confirm('Are you sure you want to delete this subject?')">Delete</button>
                                        </form>
                                    </th>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if (isset($_POST['delete_subject'])) {
                        $delete_id = $_POST['delete_id'];
                        $sql = "DELETE FROM subjects WHERE id = $delete_id";
                        $res = mysqli_query($db, $sql) or die('Error: ' . mysqli_error($db));
                        // Reload the page
                        echo '<script>window.location.href = window.location.href;</script>';
                    }
                    ?>

                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>


    </div>
</main>




<?php require_once('../layouts/footer_to_end.php'); ?>