<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');


// Fetch all schools
$schools_sql = "SELECT * FROM schools";
$schools_result = mysqli_query($db, $schools_sql) or die('An error occurred while fetching schools: ' . mysqli_error($db));

?>

<hr />

<main>
    <div class="container-fluid col-md-10">

        <div id="tabs">

            <div id="lecturers">
                <div class="justify text-right">            
                    <!-- Dropdown list to select schools -->
                    <div class="form-group" style="width:30%;">
                        <label for="schoolSelect">Select School:</label>
                        <select class="form-control" id="schoolSelect">
                            <?php while ($school_row = mysqli_fetch_assoc($schools_result)) { ?>
                                <option value="<?php echo $school_row['school_id']; ?>"><?php echo $school_row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- <span><a class="btn btn-success btn-sm" href="add_staff.php">Add Teacher</a></span> -->
                </div>


                <div class="card-body">
                    <div class="table-responsive" style="border:2px solid black; padding:1rem; ">
                    <table class="table table-bordered" id="staff_tea" width="100%" cellspacing="0" >
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Age</td>
                                    <td>Gender</td>
                                </tr>
                            </thead>
                            <tbody id="reportBody">
                                <!-- Report data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
    // Function to generate report based on selected school
    function generateReport(schoolId) {
        $.ajax({
            url: 'generate_report.php', // Change this to the PHP file that generates the report
            method: 'POST',
            data: {
                schoolId: schoolId
            },
            success: function(response) {
                $('#reportBody').html(response);
            }
        });
    }

    // When the document is ready
    $(document).ready(function() {
        // Generate report for the initially selected school
        var initialSchoolId = $('#schoolSelect').val();
        generateReport(initialSchoolId);

        // When the value of the dropdown changes
        $('#schoolSelect').change(function() {
            var selectedSchoolId = $(this).val();
            generateReport(selectedSchoolId);
        });
    });
</script>

            </div>

        </div>
    </div>
    </div>
</main>

<?php require_once('../layouts/footer_to_end.php'); ?>