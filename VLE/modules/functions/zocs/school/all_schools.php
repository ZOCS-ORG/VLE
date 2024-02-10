<?php
require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');
?>

<hr/>
<main>
    <div class="card-header text-center">
        <h3>School list</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>EMIS Number</th>
                        <th>School Name</th>
                        <th>School Location</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>Type of School</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM schools;";
                    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                    $string = "";
                    $images_dir = "../../../utils/images/students/";

                    while ($row = mysqli_fetch_array($res)) {
                        $picname = $row['img'];
                        ?>
                        <tr>
                            <td><?php echo $row['school_id']; ?> </td>
                            <td><?php echo $row['emis_number']; ?> </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['province']; ?></td>
                            <td><?php echo $row['district']; ?></td>
                            <td><?php echo $row['sch_type']; ?></td>
                            <th><div class="btn-group">

                                    <a class="btn btn-danger btn-sm text-light" href="../../../config/admin_server.php?id=<?php echo $row["school_id"] ?>&delete_school=true" onclick="clicked(event)">Delete </a>
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


<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>

<script>
    function clicked(e)
    {
        if (!confirm('Are you sure you want to delete this ?')) {
            e.preventDefault();
        }
    }
</script>
</div>
</div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>
