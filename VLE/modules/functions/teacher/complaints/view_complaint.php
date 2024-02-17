<?php
// require_once('../scripts/parent_validation.php');
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$complaint_id = $_GET['id'];

?>

<hr />
<style>
    .chat-container {
        max-width: 600px;
        margin: 20px auto;
        overflow: hidden;
    }

    .chat-bubble {
        background-color: #f0f0f0;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
        clear: both;
    }

    .chat-bubble.sent {
        float: right;
        background-color: #dcf8c6;
    }

    .chat-bubble.received {
        float: left;
        background-color: #f0f0f0;
    }

    .chat-bubble.right {
        float: right;
        background-color: #dcf8c6;
    }

    .chat-bubble p {
        margin: 0;
    }

    .chat-bubble p span {
        font-size: 12px;
        color: #777;
    }

    .chat-bubble blockquote {
        margin: 5px 0;
    }

    .chat-bubble a {
        color: blue;
    }


    table {
        width: 500px;
        margin-left: auto;
        margin-right: auto;

    }

    input {
        width: 90%;
        border-radius: 8px;
        border: 1px inset black;
    }

    textarea {
        width: 90%;
        border-radius: 8px
    }
</style>

<?php
$query = "SELECT  * from complaints where id = '$complaint_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dir = "../../../utils/complaints/";
?>

        <main>
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3> Query <?php echo ($row['status'] == 'Open') ? " - <a class='btn btn-sm btn-success' href='?close=" . $row['id'] . "' >Mark as Closed</a> " : ''; ?> </h3>

                    <!-- <h3> Query <?php echo ($row['created_by'] == $_SESSION['id'] && $row['status'] == 'Open') ? " - <a class='btn btn-sm btn-success' href='?close=" . $row['id'] . "' >Mark as Closed</a> " : ''; ?> </h3> -->
                </div>

                <div class="card-body">
                    <table>
                        <div class="chat-container">
                            <!-- Description -->
                            <div class="chat-bubble received">
                                <p><?php echo $row['complaint'] ?></p>
                            </div>

                            <!-- Attachment -->
                            <?php
                            if (isset($row['file']) && strlen($row['file']) > 3) {
                                if (file_exists($dir . $row['file'])) {
                                    echo '<div class="chat-bubble received">';
                                    echo '<a href="' . $dir . $row["file"] . '" target="_blank">Attachment</a>';
                                    echo '</div>';
                                } else {
                                    // Handle non-existing file case
                                }
                            } else {
                                // Handle empty file case
                            }
                            ?>

                            <?php
                            $query = "SELECT u.name, response, c.date, c.file
                                FROM complaint_responses c
                                INNER JOIN users u ON c.user_id = u.id 
                                WHERE complaint_id = '$complaint_id' ";
                            $resultss = mysqli_query($db, $query) or die('Error getting students: ' . mysqli_error($db));
                            while ($res_ = mysqli_fetch_array($resultss)) {
                                echo '<div class="chat-bubble right">';
                                echo "<p>" . $res_['name'] . " <span>- " . date_format(date_create($res_['date']), "d M, Y H:i:s") . "</span></p>";
                                echo "<blockquote><q>" . $res_['response'] . "</q></blockquote>";
                                if (isset($res_['file']) && strlen($res_['file']) > 3) {
                                    if (file_exists($dir . $res_['file'])) {
                                        echo '<a href="' . $dir . $res_["file"] . '" target="_blank">Attachment</a>';
                                    } else {
                                        // Handle non-existing file case
                                    }
                                } else {
                                    // Handle empty file case
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>



                        <tbody>
                            <!-- <tr>
                                <td>Description</td>
                                <td><?php echo $row['complaint'] ?> </td>
                            </tr>

                            <tr style="padding-bottom: 100px;">
                                <td>Attched File</td>
                                <td>
                                    <?php
                                    if (isset($row['file']) && strlen($row['file']) > 3) {
                                        if (file_exists($dir . $row['file'])) {
                                            echo '<a href="' . $dir . $row["file"] . '" target="_blank"> Attachment </a>';
                                        } else {
                                            echo "No attached files.";
                                        }
                                    } else {
                                        echo "No attached files";
                                    }
                                    ?>
                                </td>
                            </tr> -->

                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td colspan="2" style="text-align: center; font-weight:bold; font-size:130%; text-decoration: underline; padding-bottom: 20px">Responses</td> -->
                            </tr>

                            <!-- <tr>
                                <td colspan="2">
                                    <?php
                                    $query = "SELECT u.name, response, c.date, c.file
                                                FROM complaint_responses c
                                                INNER JOIN users u ON c.user_id = u.id 
                                                -- INNER JOIN complaints ON complaints.created_by = c.user_id
                                                WHERE complaint_id = '$complaint_id' ";
                                    $resultss = mysqli_query($db, $query) or die('Error getting students: ' . mysqli_error($db));
                                    while ($res_ = mysqli_fetch_array($resultss)) {
                                        echo " <hr>  ";
                                        echo "<p style='border:2px solid black' >" . $res_['name'] . " <span> - " . date_format(date_create($res_['date']), "d M, Y H:i:s") . " </span></p>  <blockquote> <q>" . $res_['response'] . " </q> </blockquote>";
                                        if (isset($res_['file']) && strlen($res_['file']) > 3) {
                                            if (file_exists($dir . $res_['file'])) {
                                                echo '<a href="' . $dir . $res_["file"] . '" target="_blank"> Attachment </a>';
                                            } else {
                                            }
                                        } else {
                                        }
                                    } ?>
                                    <hr>
                                    <br>
                                </td>
                            </tr> -->


                            <?php
                            // check status
                            // $q_check = mysqli_query($db, "SELECT status FROM complaints where id = '$complaint_id' AND status = 'Open' ");

                            // echo mysqli_num_rows($q_check);
                            if ($row['status'] == 'Open') {
                            ?>

                                <tr>
                                    <td colspan="2" style="border: 1px solid black; border-radius:20px">
                                        <div class="card-header">
                                        </div>

                                        <form action="#" method="post" enctype="multipart/form-data">

                                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                                <input id="id" type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                                                <tr>
                                                    <td class="text-center" colspan="2"> <textarea name="response" id="" cols="30" rows="4" required></textarea> </td>
                                                </tr>
                                                <tr>
                                                    <td>File Attachment: (optional)</td>
                                                    <td class="text-right"><input type="file" name="file"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="submit_response" value="Respond"></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                // complaint is closed
                            } else {
                            ?>
                                <tr>
                                    <td colspan="2" style="border: 1px solid black; border-radius:20px">
                                        <div class="card-header">
                                            <h5 class="text-center my-2">Query Closed </h5>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </main>
<?php
    }
} else {
    echo 'No Records Found!';
}




//? save

if (!empty($_POST['submit_response'])) {


    $id = $_POST['id'];
    $response = $_POST['response'];

    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        // echo file_exists()
        $file = $_FILES['file']['name'];
        move_uploaded_file($filetmp, $dir . $file);
    } else {
        $file = "";
    }

    // return var_dump($_POST);
    // die();


    $sql = mysqli_query($db, "INSERT INTO complaint_responses (`complaint_id`, `user_id`, `response`, `file`)
                    VALUES('$complaint_id', '$id', '$response', '$file' )") or die("Error saving complaint: " . mysqli_error($db));

    $_SESSION['created'] = "Added successfully";

    echo "<script> history.back() </script>";
}
//? close
if(isset($_GET['close'])){
    $complaint_id = $_GET['close'];
    $sql = mysqli_query($db, "UPDATE complaints SET status = 'Closed' WHERE id = '$complaint_id'") or die("Error closing complaint: ". mysqli_error($db));
    $_SESSION['closed'] = "Closed successfully";
    
    echo "<script> window.location = '../complaints/view_complaint.php?id=". $complaint_id."&updated=true' </script>";
}






?>



<?php require_once('../layouts/footer_to_end.php'); ?>