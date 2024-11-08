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
                    <form action='search' method='post' onsubmit='return validateSearch();' class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" name = "searchref" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="sumbit" name="submit" id = "searchbuttonref">
                                <a href="search" style="text-decoration: none;"><i class="fas fa-search fa-sm" style="color: white;"></i></a>
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
                        <li class="nav-item dropdown no-arrow">';


                                $sql = "SELECT * FROM attachment";
                                $result = mysqli_query($conn, $sql);

                                $row = mysqli_fetch_assoc($result);
                                $attachmentReferenceNo = "$row[attachmentReferenceNo]";

                                $user_office = $_SESSION['offices'];

                                $sql = "SELECT * FROM attachmentdetails where office_tag = $user_office";
                                $result = mysqli_query($conn, $sql);

                                $newcount = 0;
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $attachmentReferenceNo = $row['attachmentReferenceNo'];

                                    $sql = "SELECT * FROM attachment WHERE is_released = 1 and attachmentReferenceNo = '$attachmentReferenceNo'";
                                    $result1 = mysqli_query($conn, $sql);

                                    $c = mysqli_num_rows($result1);

                                    $newcount += $c;

                                    $sql = "SELECT * FROM attachmentdetails where isView = 0 and office_tag = $user_office";
                                    $result2 = mysqli_query($conn, $sql);

                                    $q = mysqli_num_rows($result2);

                                    if ($q){
                                
                                if ($newcount > 0) {

                                    }
                                }
                                }

                            
                                echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><span class="badge badge-danger badge-counter">' . $q . '</span>';

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
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
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
                                    <a class="dropdown-item" type="button" class="btn btn-primary" href="Attachment">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Announcement
                                <?php

                                $sql = "SELECT * FROM attachment";
                                $result = mysqli_query($conn, $sql);

                                $row = mysqli_fetch_assoc($result);
                                $attachmentReferenceNo = "$row[attachmentReferenceNo]";

                                $user_office = $_SESSION['offices'];

                                $sql = "SELECT * FROM attachmentdetails where office_tag = $user_office";
                                $result = mysqli_query($conn, $sql);

                                $newcount = 0;
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $attachmentReferenceNo = $row['attachmentReferenceNo'];

                                    $sql = "SELECT * FROM attachment WHERE is_released = 1 and attachmentReferenceNo = '$attachmentReferenceNo'";
                                    $result1 = mysqli_query($conn, $sql);

                                    
                                }
                                if ($result1 > 0) {

                                    $sql = "SELECT * FROM attachmentdetails where isView = 0 and office_tag = $user_office";
                                    $result2 = mysqli_query($conn, $sql);

                                    $c = mysqli_num_rows($result2);

                                    $newcount += $c;

                                    if ($newcount){
                                    echo '<span class="badge badge-danger badge-counter">' . $newcount . '</span>';
                                    }
                                }
                                ?>
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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    include "profile.php";
                    include "view.php";
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard |


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

                    <!-- Content Row -->
                    <?php
                    include"dashboard.php";
                    ?>

                    <!-- Content Row -->



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
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo $labelsJSON; ?>,
            datasets: [{
                label: 'Number of Documents Sent by Month in <?php echo $currentYear; ?>',
                data: <?php echo $dataJSON; ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Single color for the bars
                borderColor: 'rgba(75, 192, 192, 1)',       // Same color for the border
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,      // Make the chart responsive
            maintainAspectRatio: false, // Allow the height to be defined
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#example').DataTable({
                "columnDefs": [{
                        "type": "date",
                        "targets": [4]
                    } // Apply 'date' type sorting to the 5th column (start date)
                ]
            });

            // Initialize daterangepicker
            $('#date-range').daterangepicker({
                autoUpdateInput: false, // Prevent automatic update of input field
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                }
            });

            // Apply date range filtering when apply button is clicked
            $('#date-range').on('apply.daterangepicker', function(ev, picker) {
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');

                // Update input field with selected range
                $(this).val(startDate + ' - ' + endDate);

                // Filter table based on selected range
                table.draw();
            });

            // Clear date range selection when cancel button is clicked
            $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                table.draw();
            });

            // Add custom filtering function for date range
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = moment($('#date-range').val().split(' - ')[0], 'YYYY-MM-DD');
                    var max = moment($('#date-range').val().split(' - ')[1], 'YYYY-MM-DD');
                    var startDate = moment(data[4], 'YYYY-MM-DD');

                    // If no range is selected, show all rows
                    if (min.isValid() && max.isValid()) {
                        if (startDate.isBetween(min, max, null, '[]')) {
                            return true;
                        }
                        return false;
                    }
                    return true;
                }
            );
        });
    </script>

</body>

</html>