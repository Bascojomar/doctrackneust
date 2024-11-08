<?php
if(session_id()==''){session_start();} 
if (file_exists('../backEnd/database.php')) {include_once('../backEnd/database.php'); }
if (file_exists('../backEnd/function.php')) {include_once('../backEnd/function.php'); }

if(!isset($_SESSION['user_id'])){
    header("Location: ../index");

}
$sessionId = $_SESSION['accesstype'];

if($sessionId != 1 && $sessionId != 6 && $sessionId != 4){
    header("Location: ../index");
}

$_SESSION['z_tmp_signatory'] = 'z_tmp_signatory'.$_SESSION['user_id'];
$result = mysqli_query($conn,'DROP TABLE IF EXISTS '.$_SESSION['z_tmp_signatory'].'') or die(mysqli_error($conn));
$str = "CREATE TABLE  ".$_SESSION['z_tmp_signatory']." (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `indexing` INT(11) DEFAULT 0,
        `os_id` INT(11) DEFAULT 0,
        primary key(`id`) ) 
        ENGINE=INNODB DEFAULT CHARSET=latin1;";
mysqli_query($conn,$str) or die(mysqli_error($conn));

$docu_id = secureData($_GET['attachmentID'],'d');

$officeCreated = secureData($_GET['officeCreated'],'d');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>eDoctrack - Users</title>
    <link rel="icon" type="image/x-icon" href="img/title_logo.png">
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <style>
        .custom-container {
            background-color: #f8f9fa !important; /* Light smoke color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important; /* Light shadow */
            padding: 20px !important; /* Optional padding */
            border-radius: 8px !important; /* Optional rounded corners */
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
            padding-top: 100px; /* Adjusted for the profile picture overlap */
            text-align: center;
        }
        .button-s:hover{
            opacity: 0.5;
        }
    </style>
    <script>
    function ajax_new(url_, tmp_container) {
        $.ajax({
            url: url_,
            method: "post",
            data: {record: 1},
            success: function(data) {
                $('#' + tmp_container).html(data);
                $('#myTable').DataTable();
            }
        });
    }

    function ajax_post(name_of_id,id,url_, tmp_container){
        let myForm = new FormData();
        myForm.append(name_of_id, id);
        //$('#'+tmp_container).html("<div align='center'><img src='images/ajax-loader3.gif' width='15px' /></div>");
        $.ajax({
            url: url_,
            type: "POST",
            data: myForm,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#'+tmp_container).html(data);
                $('#myTable').DataTable();
            }
        });
    }

    //ajax_post(\'os_id\','.$rw['os_id'].',\'signatories_add_select.php\',\'tmp_select\')
    function add_signatory(os_id){
        url_ = 'signatories_add_select.php';
        var os_id = document.getElementById('os_id'+os_id).value
        let myForm = new FormData();
        myForm.append('os_id', os_id);
        Swal.fire({
            title: "Do you want to add this signatory?",
            showCancelButton: true,
            confirmButtonText: "Save"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url_,
                        type: "POST",
                        data: myForm,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $("#tmp_select").html(data);
                            $("#tmp_select").css('opacity', '1');
                            // Swal.fire({
                            //     icon: 'success',
                            //     text: 'Successfully Processed Request',
                            //     toast: true,
                            //     position: 'top-end',
                            //     showConfirmButton: false,
                            //     timer: 3000,
                            //     timerProgressBar: true
                            // });
                        },
                        error: function () {
                            Swal.fire('Error', 'Error Processing Request', 'error');
                        }
                    });   
                } 
        });

    }

    function change_signatory(id){
        let myForm = new FormData();
        myForm.append('get_this_id', id);
        $.ajax({
            url: 'signatories_change.php',
            type: "POST",
            data: myForm,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#tmp_s"+id).html(data);
                $("#tmp_s"+id).css('opacity', '1');
            },
            error: function () {
                Swal.fire('Error', 'Error Processing Request', 'error');
            }
        });   
    }

    function swap_it(){
        let myForm = new FormData();
        myForm.append('swaps', document.getElementById('swaps').value);
        myForm.append('allow_transaction', document.getElementById('swaps').value);
        url_ = 'signatories_add_select.php';
        $.ajax({
            url: url_,
            type: "POST",
            data: myForm,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#tmp_select").html(data);
                $("#tmp_select").css('opacity', '1');
            },
            error: function () {
                Swal.fire('Error', 'Error Processing Request', 'error');
            }
        });  
    }

    //ajax_post('str',this.value,'signatories_add_search.php','tmp')
    function str_search(){
        url_ = 'signatories_add_search.php';
        var str = document.getElementById('str').value
        var office_id = document.getElementById('office_id').value
        var officeCreated = document.getElementById('officeCreated').value
        let myForm = new FormData();
        myForm.append('str', str);
        myForm.append('office_id', office_id);
        myForm.append('officeCreated', officeCreated);
        $.ajax({
            url: url_,
            type: "POST",
            data: myForm,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#tmp").html(data);
                $("#tmp").css('opacity', '1');
            },
            error: function () {
                Swal.fire('Error', 'Error Processing Request', 'error');
            }
        });   
    }


    function process_signatory(docu_id){
        url_ = 'signatories_add.php';
        var is_valid = document.getElementById('is_valid').value;
        var is_valid_ = document.getElementById('is_valid_').value;
        let myForm = new FormData();
        myForm.append('docu_id', docu_id);
        myForm.append('add_', 1);
        if(is_valid!=0){
            if(is_valid_!=0){
                Swal.fire({
                    title: "Do you want to Process this?",
                    showCancelButton: true,
                    confirmButtonText: "Save"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url_,
                                type: "POST",
                                data: myForm,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    $("#main_c").html(data);
                                    $("#main_c").css('opacity', '1');
                                    $("#process_sig").hide();
                                    // Swal.fire({
                                    //     icon: 'success',
                                    //     text: 'Successfully Processed Request',
                                    //     toast: true,
                                    //     position: 'top-end',
                                    //     showConfirmButton: false,
                                    //     timer: 3000,
                                    //     timerProgressBar: true
                                    // });
                                    window.location.href='document?added';
                                },
                                error: function () {
                                    Swal.fire('Error', 'Error Processing Request', 'error');
                                }
                            });   
                        } 
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    text: 'Please select atleast one signatory',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        } else {
            Swal.fire({
                icon: 'warning',
                text: 'Error on the list',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    }

    function update_signatory(docu_id){
        url_ = 'signatories_add.php';
        var is_valid = document.getElementById('is_valid').value;
        var is_valid_ = document.getElementById('is_valid_').value;
        let myForm = new FormData();
        myForm.append('docu_id', docu_id);
        myForm.append('edit_', 1);
        if(is_valid!=0){
            if(is_valid_!=0){
                Swal.fire({
                    title: "Do you want to Process this?",
                    showCancelButton: true,
                    confirmButtonText: "Save"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url_,
                                type: "POST",
                                data: myForm,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    $("#main_c").html(data);
                                    $("#main_c").css('opacity', '1');
                                    $("#process_sig").hide();
                                    // Swal.fire({
                                    //     icon: 'success',
                                    //     text: 'Successfully Processed Request',
                                    //     toast: true,
                                    //     position: 'top-end',
                                    //     showConfirmButton: false,
                                    //     timer: 3000,
                                    //     timerProgressBar: true
                                    // });
                                    window.location.href='document?updated';
                                },
                                error: function () {
                                    Swal.fire('Error', 'Error Processing Request', 'error');
                                }
                            });   
                        } 
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    text: 'Please select atleast one signatory',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        } else {
            Swal.fire({
                icon: 'warning',
                text: 'No updates found',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    }
        

    </script>
</head>

<body id="page-top">
    <?php if(isset($_GET['success'])){echo'Success';} ?>
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
                                    $user_id = $_SESSION['user_id'];
                                    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                    $result = $conn->query($query);

                                    if ($result->num_rows == 1) {
                                        $user_data = $result->fetch_assoc();
                                        echo  $user_data['fullname'];
                                        echo '</span>
                                        <img class="img-profile rounded-circle"
                                        src="../img/profile/'; echo $user_data['pic']; 
                                        echo '">
                                        </a>';

                                    } else {
                                    }
                                } else {
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

                    <!-- Content Row -->
                    <div class="row" >
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                <?php
                    echo GetData('select documentCode from documenttransac where docu_id='.$docu_id);
                ?>
                 | 
                    <?php
                        echo GetData('select documentSubject from documenttransac where docu_id='.$docu_id);
                    ?>
                </h1>
            </div>

                        <div class="container mt-5" id="main_c">
                           <?php include('signatories_add.php'); ?>
                        </div>
                    </div>

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
</body>
</html>