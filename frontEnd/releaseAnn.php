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
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>

function ajax_fn(url,container_x){
    $.ajax({
        url: url,           // The URL to send the request to
        type: 'GET',        // The HTTP method to use for the request
        success: function(data) {
            // On successful response, load the data into the container
            $(container_x).html(data);
            $('#example').datatable();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle any errors
            console.error("Error: " + textStatus + ": " + errorThrown);
            $(container_x).html("<p>An error occurred while loading data.</p>");
        }
    });
}


</script>
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

        //darren
        function param(w,h) {
            var width  = w;
            var height = h;
            var left = (screen.width  - width)/2;
            var top = (screen.height - height)/2;
            var params = 'width='+width+', height='+height;
            params += ', top='+top+', left='+left;
            params += ', directories=no';
            params += ', location=no';
            params += ', resizable=no';
            params += ', status=no';
            params += ', toolbar=no';
            return params;
        }

        function openWin(url){
            myWindow=window.open(url,'mywin',param(800,500));
            myWindow.focus();
        }

        function openCustom(url,w,h){
            myWindow=window.open(url,'mywin',param(w,h));
            myWindow.focus();
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
        
                        // Use user data as needed
                        echo  $user_data['fullname'];
                        
                        echo '</span>
                        <img class="img-profile rounded-circle"
                            src="../img/profile/'; echo $user_data['pic']; 
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
                                    <a class="dropdown-item" type="button" class="btn btn-primary" href="viewAnn">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Announcment
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
    include "view.php";
    ?>

                        <!-- Content Row -->
                        <div class="row">

                        <div class="container mt-5">

							<div class="container card mb-3" style="margin-top:-50px;">
								<div class="card-body">

                                <div class="card-title">
                                     <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Released Attachment | 

                            
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

                        if($getOfficess == 0){
                            echo "All Offices";
                        } else{
                            echo OfficeName($user_data['offices']);

                        }
                        
                    
                    } else {
                    }
                } else {

                }
                    ?>
                            </h1>
                        </div>


                                </div>

                                <table id="example" class="table table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Reference Number</th>
                                            <th class="text-center">Attachment Title</th>
                                            <th class="text-center">Attachment File</th>
                                    </thead>
                                    <?php
                                      
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
                                    
                                        
                                                $user_id = $_SESSION['user_id'];
                                            
                                                $sql = "SELECT * FROM attachment where is_released = 1 and user_id ='$user_id'";
                                                $result = mysqli_query($conn, $sql);
            
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
            
            
            
            
            
                                                        echo "<tr>";
                                                        echo "<td>" . $row['attachmentReferenceNo'] . "</td>";
                                                        echo "<td  class='text-center'>" . $row['attachmentTitle'] .    "</td>";

                                                        $file_dir = '../Attachment/'.$row['attachmentFile'];
                                                        echo '<td class="text-center">
                                                        <button type="button" title="BARCODE" onclick="openCustom(\''.
                                                                                $file_dir.'?'.time().'\',1000,1000)" class="btn button-s btn-sm"><i class="fa fa-file"></i></button>
                                                        </td>';
                                                    
                                                            echo'
                                                        </td>'
                                                        ;

                                                        
            
                                                        echo "</tr>";
                                                        include 'modal/docuModalAuth.php';
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9' class='text-center'>No data found</td></tr>";
                                                }
            
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


        <!-- Bootstrap JS 05-07-24 -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->





<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


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
        $(document).ready(function() {
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
    <script>
    function openNewWindow(userId) {
        // Generate a unique ID for the new window
        var uniqueID = Math.random().toString(36).substring(7);
        // URL for the new window, you can replace 'new_window_content.php' with your actual PHP file name
        var url = 'pdfFile.php?id=' + userId + '&windowId=' + uniqueID;
        // Open the new window
        window.open(url, uniqueID, 'width=600,height=400');
    }
    </script>
    <script>
        $(document).ready(function() {
            $('.signatory_add').select2({
                placeholder: "Search Signatory...",
                allowClear: true
            });

            function updateSelectedOptionsDisplay(selectElement, container) {
                var selectedOptions = $(selectElement).val();
                $(container).empty();
                if (selectedOptions) {
                    selectedOptions.forEach(function(option, index) {
                        var optionText = $(selectElement).find('option[value="' + option + '"]').text();
                        var order = getOrdinal(index + 1);
                       // $(container).append('<div class="selected-option" data-id="' + option + '">' + order + ' Signatory - ' + optionText + '</div>');
                    });
                }
            }

            function getOrdinal(n) {
                var s = ["th", "st", "nd", "rd"],
                    v = n % 100;
                return n + (s[(v - 20) % 10] || s[v] || s[0]);
            }

            $('.signatory_add').on('select2:select', function(e) {
                var data = e.params.data;
                var selectElement = this;
                var option = $(selectElement).find('option[value="' + data.id + '"]');
                option.detach().appendTo($(selectElement));
                updateSelectedOptionsDisplay(selectElement, '#selectedOptions' + $(selectElement).attr('id'));
            });

            $('.signatory_add').on('select2:unselect', function(e) {
                var selectElement = this;
                updateSelectedOptionsDisplay(selectElement, '#selectedOptions' + $(selectElement).attr('id'));
            });

            $('.signatory_add').each(function() {
                updateSelectedOptionsDisplay(this, '#selectedOptions' + $(this).attr('id'));
            });




        });





       $(document).ready(function() {
        $('.signatory_edit').select2({
            placeholder: "Search Signatory...",
            allowClear: true,
        });

        function updateSelectedOptionsDisplay(selectElement, container) {
            var selectedOptions = $(selectElement).val();
            $(container).empty();
            if (selectedOptions) {
                selectedOptions.forEach(function(option, index) {
                    var optionText = $(selectElement).find('option[value="' + option + '"]').text();
                    var order = getOrdinal(index + 1);
                    //$(container).append('<div class="selected-option" data-id="' + option + '">' + order + ' Signatory - ' + optionText + '</div>');
                });
            }
        }

        function getOrdinal(n) {
            var s = ["th", "st", "nd", "rd"],
                v = n % 100;
            return n + (s[(v - 20) % 10] || s[v] || s[0]);
        }

        $('.signatory_edit').on('select2:select', function(e) {
            var data = e.params.data;
            var selectElement = this;
            var option = $(selectElement).find('option[value="' + data.id + '"]');
            option.detach().appendTo($(selectElement));
            updateSelectedOptionsDisplay(selectElement, '#selected_options' + $(selectElement).attr('id'));
        });

        $('.signatory_edit').on('select2:unselect', function(e) {
            var selectElement = this;
            updateSelectedOptionsDisplay(selectElement, '#selected_options' + $(selectElement).attr('id'));
        });

        $('.signatory_edit').each(function() {
            updateSelectedOptionsDisplay(this, '#selected_options' + $(this).attr('id'));
        });

    });


    </script>

    </body>

    </html>