<?php
if (isset($_SESSION['user_id'])) {
    // Retrieve user data from the database
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        // Use user data as needed
        $accesstype = $_SESSION['accesstype'];
        $getOfficess = $user_data['offices'];

        if ($accesstype == 1) {
            echo '
                                        <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF ON GOING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF RECEIVED DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count1 FROM documentdetails where status = 4";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count1'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-cogs fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF RELEASED DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count2 FROM documentdetails where status = 3";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count2'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                NO. OF USERS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM users";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';

            echo '
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary mr-5">RECENT UPLOADS</h6>
                                    <div class="date-range-container mr-auto">
                                        <table border="0" cellspacing="5" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                <td> <span class="m-0 font-weight-bold text-primary mr-1">FILTER :</span></td>
                                                <td><input class="form-control" type="text" id="date-range" name="date-range" placeholder="Date Range" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="document" style="text-decoration: none;">
                                        <div class="btn btn-sm btn-primary ml-3">SEE ALL DOCUMENTS</div>
                                    </a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" style="height:660px;">
                                    <table id="example" class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Document Number</th>
                                                <th>Title</th>
                                                <!-- <th>Document Type</th>
                                            <th>Office Created</th> -->
                                                <th>User Created</th>
                                                <th>Remarks</th>
                                                <th>Office Created</th>
                                            </tr>
                                        </thead>';


            //   $options = array(
            //     'cluster' => 'ap1',
            //     'useTLS' => true
            //   );
            //   $pusher = new Pusher\Pusher(
            //     'f44a1e2fff923310c605',
            //     '5e822c4fb3965d78ba39',
            //     '1819454',
            //     $options
            //   );

            //   $data['message'] = 'hello world';
            //   $pusher->trigger('my-channel', 'my-event', $data);
            if (isset($_SESSION['user_id'])) {
                // Retrieve user data from the database
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = $conn->query($query);


                if ($result->num_rows == 1) {
                    $user_data = $result->fetch_assoc();

                    $accesstype = $user_data['accesstype'];

                    if ($accesstype == 1) {
                        $sql = "SELECT * FROM documenttransac where dateDeleted is null";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                //include "modal/docuModalSignatoryEdit.php";

                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    } elseif ($accesstype == 4) {
                        $id = $_SESSION['offices'];

                        $sql = "SELECT * FROM documenttransac where officeCreated ='$id' and dateDeleted is null ";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {





                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                include "modal/docuModalSignatoryEdit.php";
                            }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    }
                }
            }

            echo '
                                    </table>

                                </div>
                            </div>
                        </div>';

// Query to get counts by month
$count_query = $conn->query("
    SELECT COUNT(*) as count, DATE_FORMAT(dt.dateCreated, '%Y-%m') as month
    FROM documenttransac dt
    GROUP BY month;
");

// Initialize arrays for chart data
$allMonths = [];
$data = [];

// Create an array for all months in the current year
$currentYear = date('Y');
for ($i = 1; $i <= 12; $i++) {
    $allMonths[] = date('Y-m', strtotime("$currentYear-$i"));
    $data[$i] = 0; // Initialize all month counts to 0
}

// Collect data from query result
foreach ($count_query as $row) {
    $monthIndex = (int)date('n', strtotime($row['month'])); // Get the month number (1-12)
    $data[$monthIndex] = $row['count']; // Update count for the specific month
}

// Prepare data for JSON
$labelsJSON = json_encode(array_map(function($m) {
    return date('F', strtotime($m)); // Convert to month names
}, $allMonths));
$dataJSON = json_encode(array_values($data));

echo '
                        <!-- Bar Chart -->
                        <div class="card shadow mb-4 mr-2" style="width:100%;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Documents Count by Month</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar">
                                    <div class="text-center">
                                        <canvas id="myBarChart" style="width: 100%; height: 30vh;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        } elseif ($accesstype == 2) {
            echo '
                                        <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF ON PROCESS DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF PENDING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF OUT GOING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 1";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    ';

            echo '
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary mr-5">RECENT UPLOADS</h6>
                                    <div class="date-range-container mr-auto">
                                        <table border="0" cellspacing="5" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                <td> <span class="m-0 font-weight-bold text-primary mr-1">FILTER :</span></td>
                                                <td><input class="form-control" type="text" id="date-range" name="date-range" placeholder="Date Range" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="document" style="text-decoration: none;">
                                        <div class="btn btn-sm btn-primary ml-3">SEE ALL DOCUMENTS</div>
                                    </a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" style="height:660px;">
                                    <table id="example" class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Document Number</th>
                                                <th>Title</th>
                                                <!-- <th>Document Type</th>
                                            <th>Office Created</th> -->
                                                <th>User Created</th>
                                                <th>Remarks</th>
                                                <th>Office Created</th>
                                            </tr>
                                        </thead>';


            //   $options = array(
            //     'cluster' => 'ap1',
            //     'useTLS' => true
            //   );
            //   $pusher = new Pusher\Pusher(
            //     'f44a1e2fff923310c605',
            //     '5e822c4fb3965d78ba39',
            //     '1819454',
            //     $options
            //   );

            //   $data['message'] = 'hello world';
            //   $pusher->trigger('my-channel', 'my-event', $data);
            if (isset($_SESSION['user_id'])) {
                // Retrieve user data from the database
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = $conn->query($query);


                if ($result->num_rows == 1) {
                    $user_data = $result->fetch_assoc();

                    $accesstype = $user_data['accesstype'];

                    if ($accesstype == 1) {
                        $sql = "SELECT * FROM documenttransac where dateDeleted is null";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                //include "modal/docuModalSignatoryEdit.php";

                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    } elseif ($accesstype == 4) {
                        $id = $_SESSION['offices'];

                        $sql = "SELECT * FROM documenttransac where officeCreated ='$id' and dateDeleted is null ";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {





                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                include "modal/docuModalSignatoryEdit.php";
                            }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    }
                }
            }

            echo '
                                    </table>

                                </div>
                            </div>
                        </div>';


            // $count_query = $conn->query("
            //             SELECT COUNT(*) as count, o.officeName as office
            //             FROM documenttransac dt
            //             JOIN offices o ON dt.officeCreated = o.office_id
            //             GROUP BY dt.officeCreated;
            //             ");


            // // Initialize arrays for chart data
            // $labels = [];
            // $data = [];

            // // Collect data from query result
            // foreach ($count_query as $row) {
            //     $labels[] = $row['office'];  // Office names
            //     $data[] = $row['count'];     // Count of documents per office
            // }

            // // Convert arrays to JSON format for JavaScript
            // $labelsJSON = json_encode($labels);
            // $dataJSON = json_encode($data);

            // echo '
            //             <!-- Bar Chart -->
            //             <div class="card shadow mb-4 mr-2" style="width:100%;">
            //                 <div class="card-header py-3">
            //                     <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
            //                 </div>
            //                 <div class="card-body">
            //                     <div class="chart-bar">
            //                         <div class="text-center">
            //                             <canvas id="myBarChart" width="100%" height="30"></canvas>
            //                         </div>
            //                     </div>
                                
            //                 </div>
            //             </div>

            //         </div>';
        } elseif ($accesstype == 4) {
           echo '
                                        <div class="row">

                                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF ANNOUNCEMENT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

    
                                            $newcount = 0;

                                            $user_office = $_SESSION['offices'];
                        
                                            $sql = "SELECT * FROM attachmentdetails WHERE office_tag = $user_office";
                                            $result = mysqli_query($conn, $sql);
                        
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $attachmentReferenceNo = $row['attachmentReferenceNo'];
                        
                                                $sql1 = "SELECT * FROM attachment WHERE is_released = 1 AND attachmentReferenceNo = '$attachmentReferenceNo'";
                                                $result1 = mysqli_query($conn, $sql1);
                                                
                                            }
                        
                                            if ($result1 > 0) {
                                                $sql2 = "SELECT * FROM attachmentdetails WHERE isView = 0 AND office_tag = $user_office";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $c = mysqli_num_rows($result2);
                        
                                                $newcount += $c;
                        
                                                if ($newcount) {
                                                    echo '' . $newcount . '';
                                                }else {
                                                echo '0';
                                            }
                                            } else {
                                                echo '0';
                                            }

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF ON GOING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

    
            $checkQuery = "SELECT * FROM officesignatory WHERE office_id = '$getOfficess'";
            $resultt = $conn->query($checkQuery);

            $rs = $resultt->fetch_assoc();
            $os_id = $rs['os_id'];

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2 and office_tag = '$os_id'";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF RECEIVED DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $checkQuery = "SELECT * FROM officesignatory WHERE office_id = '$getOfficess'";
            $resultt = $conn->query($checkQuery);

            $rs = $resultt->fetch_assoc();
            $os_id = $rs['os_id'];

            $queryload = "SELECT COUNT(*) as count1 FROM documentdetails where status = 4 and office_tag = '$os_id'";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count1'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-cogs fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF RELEASED DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $checkQuery = "SELECT * FROM officesignatory WHERE office_id = '$getOfficess'";
            $resultt = $conn->query($checkQuery);

            $rs = $resultt->fetch_assoc();
            $os_id = $rs['os_id'];

            $queryload = "SELECT COUNT(*) as count2 FROM documentdetails where status = 3 and office_tag = '$os_id'";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count2'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    ';

            echo '
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary mr-5">RECENT UPLOADS</h6>
                                    <div class="date-range-container mr-auto">
                                        <table border="0" cellspacing="5" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                <td> <span class="m-0 font-weight-bold text-primary mr-1">FILTER :</span></td>
                                                <td><input class="form-control" type="text" id="date-range" name="date-range" placeholder="Date Range" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="document" style="text-decoration: none;">
                                        <div class="btn btn-sm btn-primary ml-3">SEE ALL DOCUMENTS</div>
                                    </a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" style="height:660px;">
                                    <table id="example" class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Document Number</th>
                                                <th>Title</th>
                                                <!-- <th>Document Type</th>
                                                <th>Office Created</th> -->
                                                <th>User Created</th>
                                                <th>Remarks</th>
                                                <th>Date Created</th>
                                            </tr>
                                        </thead>';


            //   $options = array(
            //     'cluster' => 'ap1',
            //     'useTLS' => true
            //   );
            //   $pusher = new Pusher\Pusher(
            //     'f44a1e2fff923310c605',
            //     '5e822c4fb3965d78ba39',
            //     '1819454',
            //     $options
            //   );

            //   $data['message'] = 'hello world';
            //   $pusher->trigger('my-channel', 'my-event', $data);
            if (isset($_SESSION['user_id'])) {
                // Retrieve user data from the database
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = $conn->query($query);


                if ($result->num_rows == 1) {
                    $user_data = $result->fetch_assoc();

                    $accesstype = $user_data['accesstype'];

                    if ($accesstype == 1) {
                        $sql = "SELECT * FROM documenttransac where dateDeleted is null";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                //include "modal/docuModalSignatoryEdit.php";

                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    } elseif ($accesstype == 4) {
                        $id = $_SESSION['offices'];

                        $sql = "SELECT * FROM documenttransac where officeCreated ='$id' and dateDeleted is null ";
                        $result = mysqli_query($conn, $sql);


                        

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {


                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                include "modal/docuModalSignatoryEdit.php";
                            }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    }
                }
            }

            echo '
                                    </table>

                                </div>
                            </div>
                        </div>';


            // $count_query = $conn->query("
            //             SELECT COUNT(*) as count, o.officeName as office
            //             FROM documenttransac dt
            //             JOIN offices o ON dt.officeCreated = o.office_id
            //             GROUP BY dt.officeCreated;
            //             ");


            // // Initialize arrays for chart data
            // $labels = [];
            // $data = [];

            // // Collect data from query result
            // foreach ($count_query as $row) {
            //     $labels[] = $row['office'];  // Office names
            //     $data[] = $row['count'];     // Count of documents per office
            // }

            // // Convert arrays to JSON format for JavaScript
            // $labelsJSON = json_encode($labels);
            // $dataJSON = json_encode($data);

            // echo '
            //             <!-- Bar Chart -->
            //             <div class="card shadow mb-4 mr-2" style="width:100%;">
            //                 <div class="card-header py-3">
            //                     <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
            //                 </div>
            //                 <div class="card-body">
            //                     <div class="chart-bar">
            //                         <div class="text-center">
            //                             <canvas id="myBarChart" style="width: 100%; height: 100%;"></canvas>
            //                         </div>
            //                     </div>
                                
            //                 </div>
            //             </div>

            //         </div>';
                    
        } elseif ($accesstype == 5) {
            echo '
                                        <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF ON PROCESS DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF PENDING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF OUT GOING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 1";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    ';

            echo '
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary mr-5">RECENT UPLOADS</h6>
                                    <div class="date-range-container mr-auto">
                                        <table border="0" cellspacing="5" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                <td> <span class="m-0 font-weight-bold text-primary mr-1">FILTER :</span></td>
                                                <td><input class="form-control" type="text" id="date-range" name="date-range" placeholder="Date Range" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="document" style="text-decoration: none;">
                                        <div class="btn btn-sm btn-primary ml-3">SEE ALL DOCUMENTS</div>
                                    </a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" style="height:660px;">
                                    <table id="example" class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Document Number</th>
                                                <th>Title</th>
                                                <!-- <th>Document Type</th>
                                            <th>Office Created</th> -->
                                                <th>User Created</th>
                                                <th>Remarks</th>
                                                <th>Office Created</th>
                                            </tr>
                                        </thead>';


            //   $options = array(
            //     'cluster' => 'ap1',
            //     'useTLS' => true
            //   );
            //   $pusher = new Pusher\Pusher(
            //     'f44a1e2fff923310c605',
            //     '5e822c4fb3965d78ba39',
            //     '1819454',
            //     $options
            //   );

            //   $data['message'] = 'hello world';
            //   $pusher->trigger('my-channel', 'my-event', $data);
            if (isset($_SESSION['user_id'])) {
                // Retrieve user data from the database
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = $conn->query($query);


                if ($result->num_rows == 1) {
                    $user_data = $result->fetch_assoc();

                    $accesstype = $user_data['accesstype'];

                    if ($accesstype == 1) {
                        $sql = "SELECT * FROM documenttransac where dateDeleted is null";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                //include "modal/docuModalSignatoryEdit.php";

                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    } elseif ($accesstype == 4) {
                        $id = $_SESSION['offices'];

                        $sql = "SELECT * FROM documenttransac where officeCreated ='$id' and dateDeleted is null ";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {





                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                include "modal/docuModalSignatoryEdit.php";
                            }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    }
                }
            }

            echo '
                                    </table>

                                </div>
                            </div>
                        </div>';


            // $count_query = $conn->query("
            //             SELECT COUNT(*) as count, o.officeName as office
            //             FROM documenttransac dt
            //             JOIN offices o ON dt.officeCreated = o.office_id
            //             GROUP BY dt.officeCreated;
            //             ");


            // // Initialize arrays for chart data
            // $labels = [];
            // $data = [];

            // // Collect data from query result
            // foreach ($count_query as $row) {
            //     $labels[] = $row['office'];  // Office names
            //     $data[] = $row['count'];     // Count of documents per office
            // }

            // // Convert arrays to JSON format for JavaScript
            // $labelsJSON = json_encode($labels);
            // $dataJSON = json_encode($data);

            // echo '
            //             <!-- Bar Chart -->
            //             <div class="card shadow mb-4 mr-2" style="width:100%;">
            //                 <div class="card-header py-3">
            //                     <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
            //                 </div>
            //                 <div class="card-body">
            //                     <div class="chart-bar">
            //                         <div class="text-center">
            //                             <canvas id="myBarChart" width="100%" height="30"></canvas>
            //                         </div>
            //                     </div>
                                
            //                 </div>
            //             </div>

            //         </div>';
        } elseif ($accesstype == 6) {
            echo '
                                        <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF ON PROCESS DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF PENDING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 2";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                NO. OF OUT GOING DOCUMENTS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';

            $queryload = "SELECT COUNT(*) as count FROM documentdetails where status = 1";
            //  WHERE officeCreated =  $getOfficess
            $result = mysqli_query($conn, $queryload);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
            }

            echo '' . $count . '';

            echo '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    ';

            echo '
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary mr-5">RECENT UPLOADS</h6>
                                    <div class="date-range-container mr-auto">
                                        <table border="0" cellspacing="5" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                <td> <span class="m-0 font-weight-bold text-primary mr-1">FILTER :</span></td>
                                                <td><input class="form-control" type="text" id="date-range" name="date-range" placeholder="Date Range" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="document" style="text-decoration: none;">
                                        <div class="btn btn-sm btn-primary ml-3">SEE ALL DOCUMENTS</div>
                                    </a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" style="height:660px;">
                                    <table id="example" class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Document Number</th>
                                                <th>Title</th>
                                                <!-- <th>Document Type</th>
                                            <th>Office Created</th> -->
                                                <th>User Created</th>
                                                <th>Remarks</th>
                                                <th>Office Created</th>
                                            </tr>
                                        </thead>';


            //   $options = array(
            //     'cluster' => 'ap1',
            //     'useTLS' => true
            //   );
            //   $pusher = new Pusher\Pusher(
            //     'f44a1e2fff923310c605',
            //     '5e822c4fb3965d78ba39',
            //     '1819454',
            //     $options
            //   );

            //   $data['message'] = 'hello world';
            //   $pusher->trigger('my-channel', 'my-event', $data);
            if (isset($_SESSION['user_id'])) {
                // Retrieve user data from the database
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = $conn->query($query);


                if ($result->num_rows == 1) {
                    $user_data = $result->fetch_assoc();

                    $accesstype = $user_data['accesstype'];

                    if ($accesstype == 1) {
                        $sql = "SELECT * FROM documenttransac where dateDeleted is null";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                //include "modal/docuModalSignatoryEdit.php";

                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    } elseif ($accesstype == 4) {
                        $id = $_SESSION['offices'];

                        $sql = "SELECT * FROM documenttransac where officeCreated ='$id' and dateDeleted is null ";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {





                                echo "<tr>";
                                echo "<td>" . $row['documentCode'] . "</td>";
                                echo "<td>" . $row['documentSubject'] . "</td>";
                                // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                echo "<td>" . GetUserCreated($row['userCreated']) . "</td>";
                                echo "<td>" . $row['remarks'] . "</td>";
                                echo "<td>" . $row['dateCreated'] . "</td>";


                                // Add more columns if needed
                                echo "</tr>";

                                include "modal/docuModalAuth.php";
                                include "modal/docuModalSignatory.php";
                                include "modal/docuModalSignatoryEdit.php";
                            }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                    }
                }
            }

            echo '
                                    </table>

                                </div>
                            </div>
                        </div>';


            // $count_query = $conn->query("
            //             SELECT COUNT(*) as count, o.officeName as office
            //             FROM documenttransac dt
            //             JOIN offices o ON dt.officeCreated = o.office_id
            //             GROUP BY dt.officeCreated;
            //             ");


            // // Initialize arrays for chart data
            // $labels = [];
            // $data = [];

            // // Collect data from query result
            // foreach ($count_query as $row) {
            //     $labels[] = $row['office'];  // Office names
            //     $data[] = $row['count'];     // Count of documents per office
            // }

            // // Convert arrays to JSON format for JavaScript
            // $labelsJSON = json_encode($labels);
            // $dataJSON = json_encode($data);

            // echo '
            //             <!-- Bar Chart -->
            //             <div class="card shadow mb-4 mr-2" style="width:100%;">
            //                 <div class="card-header py-3">
            //                     <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
            //                 </div>
            //                 <div class="card-body">
            //                     <div class="chart-bar">
            //                         <div class="text-center">
            //                             <canvas id="myBarChart" width="100%" height="30"></canvas>
            //                         </div>
            //                     </div>
                                
            //                 </div>
            //             </div>

            //         </div>';
        }
    } else {
        // Handle the case where user data couldn't be retrieved
    }
} else {
    // Redirect to the login page if the user is not logged in
    // header("Location: index.php");
    // exit();
}
?>