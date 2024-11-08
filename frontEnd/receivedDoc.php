<?php
session_start();

include "../backEnd/database.php";
include "../backEnd/function.php";
if(!isset($_SESSION['user_id'])){
  header("Location: ../index");

}
$sessionId = $_SESSION['accesstype'];

if($sessionId != 1 && $sessionId != 4 ){
    header("Location: ../index");
}

include '../backEnd/receivedDocAuth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eDoctrack - Campus</title>
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
include "message/errorcampus.php";
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
                    <form action = '' method='post' onsubmit='return validateSearch();'
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                        <input type="text" class="form-control" name = "reference" class = "searchinput" placeholder="barcode here">
                        <button class="btn btn-primary" type="submit" name="submit" id = "searchbuttonref">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                          
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
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                    <?php
                    include "profile.php";
                    include "view.php";
                    ?>

                    <!-- Content Row -->

        <div class="container card">
								<div class="card-body">
                                <div class="card-title">
                                      <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Document Received | 

                        
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
                                </div>
                                <table id="example" class="table table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Document Number</th>
                                            <th>Subject</th>
                                            <th>Office Created</th> 
                                            <th>Remarks</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        // Retrieve user data from the database
                                        $user_id = $_SESSION['user_id'];
                                        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                        $result = $conn->query($query);
                                    
                                        if ($result->num_rows == 1) {
                                            $user_data = $result->fetch_assoc();

                                            $accesstype =  $user_data['accesstype'];

                                            if($accesstype == 1){
                                                $sql = "SELECT * FROM documentdetails where status = 4";
                                                $result = mysqli_query($conn, $sql);
            
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
            
            
                                                        echo "<tr>";
                                                        echo "<td>" . $row['referenceNo'] . "</td>";
                                                        echo "<td>" . $row['documentSubject'] . "</td>";
                                                        // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                                        // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                                        echo "<td>" . GetUserCreated($row['userCreated']) ."</td>";
                                                        echo "<td>" . $row['remarks'] . "</td>";

                                                        echo '<td class="text-center">
                                                        
                                                        <a type="button" title="Show More Details" data-bs-toggle=
                                                        "modal" data-bs-target="#ModalDetails' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-ellipsis-h"></i></a>  
                                                        
                                                        </td>';

                                                    
            
                                                    //   VIEW
                                                        echo '<td class="text-center">     
                                    
                                                        <a type="button" title="Remove Users" data-bs-toggle=
                                                        "modal" data-bs-target="#exampleModalremove' . $row['user_id'] . '" class="btn button-s btn-sm"><i class="fa fa-trash"></i></a>  
                                    
                                                        <a type="button" title="Edit Users" data-bs-toggle=
                                                        "modal" data-bs-target="#exampleModaledit' . $row['user_id'] . '" class="btn button-s btn-sm"><i class="fa fa-paper-plane"></i></a>
            
            
                                                        </td>';
            
            
                                                        // Add more columns if needed
                                                        echo "</tr>";
            
                                                        include "modal/docuModalAuth.php";
            
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='12' class='text-center'>No data found</td></tr>";
                                                }
            

                                            } elseif($accesstype == 4){
                                                
                                                $office = $_SESSION['offices'];
                                                $checkQuery = "SELECT * FROM officesignatory WHERE office_id = '$office'";
                                                $resultt = $conn->query($checkQuery);
                                              
                                                $rs = $resultt->fetch_assoc();
                                                $os_id = $rs['os_id'];
                                                
                                                $sql = "SELECT * FROM documentdetails where (status = 4 or status = 5) and office_tag = '$os_id'";
                                                $result = mysqli_query($conn, $sql);
            
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
            
                                                        echo "<tr>";
                                                        echo "<td>" . $row['referenceNo'] . "</td>";
                                                        echo "<td>" . $row['documentSubject'] . "</td>";
                                                        // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                                        // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                                        echo "<td>" . GetUserCreated($row['userCreated']) ."</td>";
                                                        echo "<td>" . $row['remarks'] . "</td>";

                                                        echo '<td class="text-center">
                                                        
                                                        <a type="button" title="Show More Details" data-bs-toggle=
                                                        "modal" data-bs-target="#ModalDetails' . $row['dd_id'] . '" class="btn button-s btn-sm"><i class="fa fa-ellipsis-h"></i></a>  
                                                        
                                                        </td>';

                                                        
                                                        
                                                        echo '<td class="text-center">     
                                    
                                                        <a type="button" title="Remove Users" data-bs-toggle=
                                                        "modal" data-bs-target="#exampleModalremove' . $row['user_id'] . '" class="btn button-s btn-sm"><i class="fa fa-trash"></i></a>  
                                    
                                                        <a type="button" title="Send to Main Record" data-bs-toggle=
                                                        "modal" data-bs-target="#modalsigned' . $row['dd_id'] . '" class="btn button-s btn-sm"><i class="fa fa-edit"></i></a>
                                                        
                                                        ';

                                                        if($row['dateSigned'] != "0000-00-00"){
                                                            echo '
                                                             <a type="button" title="Released" data-bs-toggle=
                                                        "modal" data-bs-target="#modalreleased' . $row['dd_id'] . '" class="btn button-s btn-sm"><i class="fa fa-paper-plane"></i></a>
                                                            
                                                        <input type ="text" value= "'.$row['referenceNo'].'" hidden>
                                                        ';
                                                        }
            
                                                        echo '
                                                        </td>';
            
                                                        include "modal/docuModalAuth.php";
            
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>No data found</td></tr>";
                                                }
                                        }
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
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Management Information System</span>
                    </div>
                </div>
            </footer> -->
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
        document.getElementById('statusSelect').addEventListener('change', function() {
            var rejectField = document.querySelector('.rejectInput');
            if (this.value === '6') {
                rejectField.style.display = 'block';
            } else {
                rejectField.style.display = 'none';
            }
        });
    </script>
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
document.addEventListener('DOMContentLoaded', (event) => {
    const modals = document.querySelectorAll('[id^="modalsigned"]');
    modals.forEach(modal => {
        const ddId = modal.id.replace('modalsigned', '');
        const selectElement = document.getElementById(`statusSelect${ddId}`);
        
        fetch('../setting.json')
            .then(response => response.json())
            .then(data => {
                data.statuses.forEach(status => {
                    if (![1, 2, 4, 7, 3].includes(status.id)) {
                        const option = document.createElement('option');
                        option.value = status.id;
                        option.textContent = status.status;
                        selectElement.appendChild(option);
                    }
                });
            })
            .catch(error => console.error('Error fetching the JSON:', error));
    });
});

    </script>
    <script>
document.addEventListener('DOMContentLoaded', (event) => {
    const modals = document.querySelectorAll('[id^="modalreleased"]');
    modals.forEach(modal => {
        const ddId = modal.id.replace('modalreleased', '');
        const selectElement = document.getElementById(`statusSelec${ddId}`);
        
        fetch('../setting.json')
            .then(response => response.json())
            .then(data => {
                data.statuses.forEach(status => {
                    if (![1, 2, 4, 7, 5, 6].includes(status.id)) {
                        const option = document.createElement('option');
                        option.value = status.id;
                        option.textContent = status.status;
                        selectElement.appendChild(option);
                    }
                });
            })
            .catch(error => console.error('Error fetching the JSON:', error));
    });
});

    </script>


</body>

</html>