<?php
// require_once('../scripts/program_validation.php');
require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');
function limitTxt($str, $max, $print)
{
    if (strlen($str) > $max) {
        $str = substr($str, 0, $print) . '...';
    }
    return $str;
}
?>

<hr />
<main>
    <div class="container-fluid col-md-12">


        <div class="card mb-4">
            <div class="card-header text-center">
                <h3> Blog Posts </h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="create.php"> Create blog post <i class="fa fa-plus "></i> </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Blog Post</th>
                                <th>File</th>
                                <th>Created By</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT b.*, u.name FROM blogs b 
                                                JOIN users u ON u.id = b.created_by
                                                WHERE b.created_by = '$id'
                                                ORDER BY id DESC ";
                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['title']; ?> </td>
                                    <td> <?php echo limitTxt($row['blog'], 200,150); ?></td>
                                    <td> <a href="../../../utils/blogs/<?php echo $row['file']; ?>" target="_blank">File</a> </td>
                                    <td> <?php echo $row['name']; ?> </td>
                                    <td> <?php echo date_format(date_create($row['timestamp']), "d M, Y"); ?> </td>
                                    <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update.php?id=<?php echo $row['id'] ?>">Edit</a>
                                        <a class="btn btn-danger btn-sm text-light" href="?id=<?php echo $row['id'] ?>&delete=true">Delete </a>
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
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>


    </div>
</main>


<?php 

// Get id and delete blog and unlink the file

if (isset($_GET['id']) && isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM blogs WHERE id = $id";
    $res = mysqli_query($db, $sql) or die('An error occured: '. mysqli_error($db));
    if ($res) {
        echo "<script> window.location = './index.php?deleted=true' </script>";
    }
}

require_once('../layouts/footer_to_end.php');
?>