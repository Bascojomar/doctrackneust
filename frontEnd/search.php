<?php
session_start();

include "../backEnd/database.php";
include "../backEnd/function.php";
include "../backEnd/checksession.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="img/title_logo.png">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">

    <!-- Moment.js for date manipulation -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- vanilla-datetimerange-picker library -->
    <script src="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.js"></script>


    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .cover-photo {
            width: 100%;
            height: 200px;
            background-color: #ddd;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            position: absolute;
            bottom: -75px;
            left: 20px;
            background-size: cover;
            background-position: center;
        }

        .profile-section {
            padding-top: 100px;
            /* Adjusted for the profile picture overlap */
            text-align: center;
        }

        .table-div {
                            display: flex;
                            flex-direction: column;
                            border: 1px solid #dee2e6;
                        }

                        .table-header,
                        .table-row {
                            display: flex;
                            width: 100%;
                        }

                        .table-cell {
                            padding: 0.75rem;
                            border: 1px solid #dee2e6;
                            flex: 1;
                        }

                        .table-header {
                            background-color: #f8f9fa;
                            font-weight: bold;
                        }

    </style>
    <script>
        function MyFunction() {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to logout",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Logout it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Successfully Logout!",
                        text: "Your session are ended.",
                        icon: "success"
                    }).then(function() {
                        window.location = "logout";
                    });
                }
            });
        }
    </script>


</head>

<body id="page-top">
    <?php
    include "message/erroruser.php";
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "nav.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                <a href="home" style="text-decoration: none;"><i class="fas fa-times fa-sm" style="color: white;"></i></a>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        

                      

                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        // Retrieve user data from the database
                                        $user_id = $_SESSION['user_id'];
                                        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                        $result = $conn->query($query);

                                        if ($result->num_rows == 1) {
                                            $user_data = $result->fetch_assoc();
                                            echo  "<br>" . Getcampus($user_data['offices']) ;
                                            // Use user data as needed
                                            echo '   <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">';
                                            echo  $user_data['fullname'];

                                            echo '</span>
                      <img class="img-profile rounded-circle"
                          src="../img/profile/';
                                            echo $user_data['pic'];
                                            echo '">
                  </a>';
                                        } else {
                                            // Handle the case where user data couldn't be retrieved
                                        }
                                    } else {
                                        // Redirect to the login page if the user is not logged in
                                        // header("Location: index.php");
                                        // exit();
                                    }
                                    ?>

                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#userDetailsModal">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Activity Log
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>


                                    </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    include "profile.php";
                    ?>
                    <div class="container card">
                    <div class="card-body">
                    
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Search |

                            <?php
                            if (isset($_SESSION['user_id'])) {
                                // Retrieve user data from the database
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                $result = $conn->query($query);

                                if ($result->num_rows == 1) {
                                    $user_data = $result->fetch_assoc();

                                    // Use user data as needed
                                    $getOfficess =   $user_data['offices'];

                                    if ($getOfficess == 0) {
                                        echo "All Offices";
                                    } else {
                                        echo OfficeName($user_data['offices']);
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
                        </h1>
                    </div>

                    <?php
                    if (isset($_POST['submit'])) {
                        // Assuming you have a valid database connection in $conn
                        $searchRef = $_POST['searchref'];
                
                        if (empty($searchRef)) {
                            echo "<script>alert('Please Enter Reference Number')</script>";
                             echo "<script>window.location.href = 'home'</script>";
                        }else {
                            
                            // Prepare the SQL statement to prevent SQL injection
                            $stmt = $conn->prepare("SELECT * FROM documenttransac WHERE documentCode = ?");
                            $stmt->bind_param("s", $searchRef);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        if ($result->num_rows == 0) {
                            echo "<script>alert('Please Enter Reference Number')</script>";
                             echo "<script>window.location.href = 'home'</script>";
                        } 
                        else {
                            
                            $query = "SELECT * FROM documenttransac WHERE documentCode = '" . $searchRef . "'";
                            $result = $conn->query($query);
                            $numrows = $result->num_rows;
            
                            if ($numrows > 0) {
                              while ($rows = $result->fetch_assoc()) {

                    echo'
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 mb-2">
                            <span style="font-weight: bold;"> Document Details </span>
                                <div class="col mb-1">
                                Reference No: <span id="referenceNumber">' . $rows["documentCode"] . '</span> <i class="fa fa-clone" style="cursor: pointer;" onclick="copyReference()" title="Copy"></i>
                                </div>
                                <div class="col mb-1">
                                Title: ' . $rows["documentSubject"] . '
                                </div>
                                <div class="col mb-1">
                                User Created: ' . GetUserCreated($rows["userCreated"]) . '
                                </div>
                                <div class="col mb-4">
                                Office Created: '. OfficeName($rows["officeCreated"]) .'
                                </div>
                            <span style="font-weight: bold;"> Legend </span>
                                    <div class="col mb-1 ">
                                        <i class="fa fa-check-circle mt-2 on_half"></i> Pending
                                    </div>
                                    <div class="col mb-1 ">
                                        <i class="fa fa-check-circle mt-2 on"></i> Received
                                    </div>
                                    <div class="col mb-1 ">
                                        <i class="fa fa-check-circle mt-2 off_on"></i> Signed
                                    </div>
                                    <div class="col mb-1 ">
                                        <i class="fa fa-check-circle mt-2 off"></i> Released
                                    </div>
                                </div>

                            <div class="col-6">
                            <style>
                                    .on{
                                    opacity: 1;
                                    color: green !important;
                                }
                            
                                .on_half{
                                    opacity: .7;
                                    color: #17399D !important;
                                }
                                .on_red{
                                    opacity: .7;
                                    color: red !important;
                                }
                            
                                .off{
                                    opacity: .2;
                                }
                                .off_on{
                                     color: orange !important;
                                }
                            </style>';
                        }
                    }
                }
            }
        }

        echo '<span style="font-weight: bold;">Document Status as follows</span>';
        
                            $master_reference = GetData('select referenceNo  from documenttransac where documentCode=\''.$searchRef.'\' ');

                            $sql = "SELECT * FROM documentdetails WHERE referenceNo = '$master_reference'";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $docstatus_records = $row['status'];
                                    $office_tag = $row['office_tag'];
                            
                                   
                                    if ($docstatus_records == 2) {

                                echo '<div class="row mb-3 ml-5 off">
                                            <div class="col col-4 text-end text-right style="font-size: 12px;"> '.$row['dateCreated'].' </div>
                                            <div class="col col-1">
                                                <i class="fa fa-check-circle pt-2"></i>
                                            </div>
                                            <div class="col col-7 text-start">Not Receive : ' . GetOffice_ID(htmlspecialchars($office_tag)) . '
                                            <br> <span style="font-size: 12px;">Remarks : ' . htmlspecialchars($row['Remarks']) . '</span></div>
                                </div>'; }
                                elseif ($docstatus_records == 5) {

                                    echo '<div class="row mb-3 ml-5 off_on">
                                                <div class="col col-4 text-end text-right style="font-size: 12px;"> '.$row['dateCreated'].' </div>
                                                <div class="col col-1">
                                                    <i class="fa fa-check-circle pt-2"></i>
                                                </div>
                                                <div class="col col-7 text-start">Signed by : ' . GetOffice_ID(htmlspecialchars($office_tag)) . '
                                                <br> <span style="font-size: 12px;">Remarks : ' . htmlspecialchars($row['Remarks']) . '</span></div>
                                    </div>'; }

                                elseif ($docstatus_records == 4) {
                                    echo '<div class="row mb-3 ml-5 on_half">
                                                <div class="col col-4 text-end text-right style="font-size: 12px;"> '.$row['dateCreated'].' </div>
                                                <div class="col col-1">
                                                    <i class="fa fa-check-circle pt-2"></i>
                                                </div>
                                                <div class="col col-7 text-start">Received by : ' . GetOffice_ID(htmlspecialchars($office_tag)) . '
                                                <br> <span style="font-size: 12px;">Remarks : '.$row['Remarks'].' </span></div>
                                    </div>'; }

                                elseif ($docstatus_records == 3) {

                                    echo '<div class="row mb-3 ml-5 on">
                                                <div class="col col-4 text-end text-right style="font-size: 12px;"> '.$row['dateCreated'].' </div>
                                                <div class="col col-1">
                                                    <i class="fa fa-check-circle pt-2"></i>
                                                </div>
                                                <div class="col col-7 text-start">Released by : ' . GetOffice_ID(htmlspecialchars($office_tag)) . '
                                                <br> <span style="font-size: 12px;">Remarks : '.$row['Remarks'].' </span></div>
                                    </div>'; }

                                elseif ($docstatus_records == 6) {

                                    echo '
                                    <div class="row mb-3 ml-5 on_red">
                                                <div class="col col-4 text-end text-right style="font-size: 12px;"> '.$row['dateCreated'].' </div>
                                                <div class="col col-1">
                                                    <i class="fa fa-check-circle pt-2"></i>
                                                </div>
                                                <div class="col col-7 text-start">Reject by : ' . GetOffice_ID(htmlspecialchars($office_tag)) . '
                                                <br> <span style="font-size: 12px;">Remarks : '.$rows['Remarks'].' </span></div>
                                    </div>'; }
                                }
                            }
                                else{

                                    echo '
                                    <div class="row mb-3 ml-5 on_half">
                                                <div class="col col-4 text-end text-right" style="font-size: 12px;"> '.$row['dateCreated'].' </div>
                                                <div class="col col-1">
                                                    <i class="fa fa-check-circle pt-2"></i>
                                                </div>
                                                <div class="col col-7 text-start">Received by : ' . GetOffice_ID(htmlspecialchars($office_tag)) . '
                                                <br> <span style="font-size: 12px;">Remarks : '.$row['Remarks'].'</span></div>
                                    </div>'; }
                            echo '</div>
                        </div>
                    </div>';

                



                    ?>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Management Information System</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="endsession.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for allsb pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Date Range Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/demo/chart-bar-demo.js"></script>

    <script>
function copyReference() {
    var referenceNumber = document.getElementById("referenceNumber").innerText;
    var tempInput = document.createElement("input");
    tempInput.value = referenceNumber;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    var notification = document.createElement("div");
    notification.innerHTML = "Copied";
    notification.style.cssText = "position: fixed; top: 37%; left: 53%; transform: translate(-50%, -50%); background-color: #ffffff; padding: 10px; border: 1px solid gary; z-index: 9999";
    document.body.appendChild(notification);
    setTimeout(function(){
        notification.style.display = "none";
    }, 2000); // Adjust the time for how long you want to display the notification (in milliseconds)

}
</script>
            

</body>

</html>