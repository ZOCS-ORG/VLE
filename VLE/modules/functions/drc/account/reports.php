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


    <div class="container-fluid col-md-12">
        <div class="form-group" style="width:25%;">
            <label for="schoolSelect">Select School:</label>
            <select class="form-control" id="schoolSelect">
                <?php while ($school_row = mysqli_fetch_assoc($schools_result)) { ?>
                    <option value="<?php echo $school_row['school_id']; ?>"><?php echo $school_row['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div id="tabs">

            <div id="lecturers">

                <div class="" style="background: white;">
                    <div class="table-responsive" style="border:2px solid black; padding:1.5rem; ">
                        <table class="table table-bordered" id="staff_tea" width="100%" cellspacing="0">
                            <button onclick="exportToExcel()" class='btn btn-success' style="margin-right: 10px;">Export to Excel</button>
                            <span id="totalCount" style="margin-bottom: 10px;"></span>
                            <!-- <button onclick="exportToPdf()" class='btn btn-danger'>Export to PDF</button> -->
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Age</td>
                                    <td>Gender</td>
                                    <td>Address</td>
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

                                // Update total count
                                var count = $('#reportBody tr').length;
                                $('#totalCount').html("<strong>Total Learners: </strong>" + count);
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
                <script>
                    function exportToExcel() {
                        const table = document.getElementById("staff_tea");
                        const rows = table.querySelectorAll("tr");
                        let csv = [];

                        for (let i = 0; i < rows.length; i++) {
                            const row = [],
                                cols = rows[i].querySelectorAll("td, th");

                            for (let j = 0; j < cols.length; j++) {
                                row.push(cols[j].innerText);
                            }

                            csv.push(row.join(","));
                        }

                        const csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
                        const encodedUri = encodeURI(csvContent);
                        const link = document.createElement("a");
                        link.setAttribute("href", encodedUri);
                        link.setAttribute("download", "export.csv");
                        document.body.appendChild(link);
                        link.click();
                    }                    
                </script>

            </div>

        </div>
    </div>
    </div>
</main>

<?php require_once('../layouts/footer_to_end.php'); ?>