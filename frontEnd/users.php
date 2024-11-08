<?php
session_start();

include "../backEnd/database.php";
include "../backEnd/function.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index");

}

$sessionId = $_SESSION['accesstype'];

if ($sessionId != 1) {
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

    <title>eDoctrack - Document Type</title>
    <link rel="icon" type="image/x-icon" href="img/title_logo.png">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .custom-container {
            background-color: #f8f9fa !important;
            /* Light smoke color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
            /* Light shadow */
            padding: 20px !important;
            /* Optional padding */
            border-radius: 8px !important;
            /* Optional rounded corners */
        }

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

        .table-container {
            width: 100%;
            /* Set the width of the container */
            overflow-y: auto;
            /* Add vertical scrollbar when needed */
            max-height: 300px;
            /* Set the maximum height of the container */
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
                    }).then(function () {
                        window.location = "logout";
                    });
                }
            });
        }

    </script>


</head>

<body id="page-top">
    <?php
    include "message/erroroffices.php";
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
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        // Retrieve user data from the database
                                        $user_id = $_SESSION['user_id'];
                                        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                        $result = $conn->query($query);

                                        if ($result->num_rows == 1) {
                                            $user_data = $result->fetch_assoc();

                                            // Use user data as needed
                                            echo $user_data['fullname'];

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
                                        <a class="dropdown-item" type="button" class="btn btn-primary"
                                            data-toggle="modal" data-target="#userDetailsModal">
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
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#logoutModal">
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


                    <!-- Content Row -->
                    <div class="row">

                        <div class="container mt-5">


                            <div class="container card mb-3" style="margin-top:-50px;">
                                <div class="card-body">

                                    <div class="card-title">
                                        <!-- Page Heading -->
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <h1 class="h3 mb-0 text-gray-800">Users |


                                                <?php

                                                if (isset($_SESSION['user_id'])) {
                                                    // Retrieve user data from the database
                                                    $user_id = $_SESSION['user_id'];
                                                    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                                    $result = $conn->query($query);

                                                    if ($result->num_rows == 1) {
                                                        $user_data = $result->fetch_assoc();

                                                        // Use user data as needed
                                                        $getOfficess = $user_data['offices'];

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

                                        <div class="d-flex justify-content-end mb-3" style="margin-top:-60px;">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#exampleModaladd" >

                                                <i class="fas fa-user-plus"></i> Add Users
                                            </button>

                                            <?php
                                            include "modal/userModalAuth.php";
                                            ?>
                                        </div>
                                    </div>

                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Campus</th>
                                                <th>Offices</th>
                                                <th>Access Type</th>
                                                <th class="text-center">Action</th>
                                                <!-- <th class="text-center">Status</th> -->
                                            </tr>
                                        </thead>
                                        <?php

                                        // Fetch data from the database
                                        $sql = "SELECT * FROM users where dateDeleted is null ";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            // Output data of each row
                                            while ($row = mysqli_fetch_assoc($result)) {





                                                echo "<tr>";
                                                echo "<td>" . $row['fullname'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "<td>" . Getcampus($row['offices']) . "</td>";
                                                echo "<td>" . OfficeName($row['offices']) . "</td>";
                                                echo "<td>" . GetAccessname($row['accesstype']) . "</td>";

                                                echo '<td class="text-center">     

              <a type="button" title="Remove Users" data-bs-toggle=
              "modal" data-bs-target="#exampleModalremove' . $row['user_id'] . '" class="btn btn-danger btn-sm"><i class="fas fa-eye"></i></a>

              
              <a type="button" title="Edit Users" data-bs-toggle=
              "modal" data-bs-target="#exampleModaledit' . $row['user_id'] . '" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
          </td>';

                                    //   if ($row['is_online'] == 0) {
                                    //     echo "<td class='text-center'> <span class='badge-pill bg-gradient-secondary'></span></td>";
                                    // } else {
                                    //     echo "<td class='text-center'> <span class='badge-pill bg-gradient-success'></span></td>";
                                    // }


                                                // Add more columns if needed
                                                echo "</tr>";

                                                include "modal/userModalAuth.php";

                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No data found</td></tr>";
                                        }


                                  ?>
                            </table>
                        </div>
                    </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->
      
     
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
include "active.php";
                    ?>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('image-preview');
            var container = document.getElementById('preview-container');

            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }

            var reader = new FileReader();
            reader.onload = function () {
                var img = new Image();
                img.src = reader.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '150px';
                img.style.border = 'solid'
                preview.src = reader.result;
                container.appendChild(img);
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                paging: true,         // Enable pagination
                searching: true,      // Enable search
                ordering: false,       // Enable sorting
                info: true,           // Display table information
                lengthChange: true,   // Enable the change of page length
                pageLength: 10        // Set the initial page length
            });
        });
    </script>

</body>

</html>