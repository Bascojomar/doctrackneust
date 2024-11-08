
<?php

if (file_exists('../backEnd/function.php')) {
    include_once('../backEnd/function.php');
} else {
    // Handle the case where the file does not exist
    echo "The file does not exist.";
}

?>


<table id="example" class="table table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Document Number</th>
                                            <th>Title</th>
                                            <!-- <th>Document Type</th>
                                            <th>Office Created</th> -->
                                            <th>Office Created</th>
                                            <th>Remarks</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Barcode</th>
                                            <th class="text-center"> File</th>
                                            <th class="text-center">New File</th>
                                           
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($_SESSION['user_id'])) {

                                        $q = "SELECT * FROM documentdetails";
                                        $r = $conn->query($q);

                                        $rs = $r->fetch_assoc();
                                        $_SESSION['status'] = $rs['status'];

                                        // Retrieve user data from the database
                                        $user_id = $_SESSION['user_id'];
                                        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                        $result = $conn->query($query);
                                    
                                        if ($result->num_rows == 1) {
                                            $user_data = $result->fetch_assoc();

                                            $accesstype =  $user_data['accesstype'];

                                            if($accesstype == 1 || $accesstype == 6  ){
                                                $sql = "SELECT * FROM documenttransac where is_mainRecord = 1 and is_mainStatus = 4 and dateDeleted is null";
                                                $result = mysqli_query($conn, $sql);
            
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
            
            
            
            
            
                                                        echo "<tr>";
                                                        echo "<td>" . $row['referenceNo'] . "</td>";
                                                        echo "<td>" . $row['documentSubject'] . "</td>";
                                                        // echo "<td>" . GetDocumentType($row['dt_id']) . "</td>";
                                                        // echo "<td>" . OfficeName($row['officeCreated']) . "-" . GetCampus($row['officeCreated']) . "</td>";
                                                        echo "<td>" . OfficeName($row['officeCreated']) ." - ".GetCampus($row['officeCreated'])."</td>";
                                                        echo "<td>" . $row['remarks'] . "</td>";

                                                        echo '<td class="text-center">
                                                        
                                                        <a type="button" title="Show More Details" data-bs-toggle=
                                                        "modal" data-bs-target="#ModalDetails' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-ellipsis-h"></i></a>  
                                                        
                                                        </td>';

                                                        echo'<td align="center"> <a title="OPEN PDF" type="button" >
                                                                <i class="fa fa-barcode" href="javascript:void();" 
                                                                onclick="openCustom(\'viewBarcode.php?docu_id='.$row['docu_id'].'&referenceNo='.$row['referenceNo'].'\',1000,1000);"></i> </a>
                                                            </td>';
                                                        $file_dir = '../pdf/'.$row['fileUpload'];
                                                        echo '<td class="text-center">
                                                        <button type="button" title="BARCODE" onclick="openCustom(\''.
                                                                                $file_dir.'?'.time().'\',1000,1000)" class="btn button-s btn-sm"><i class="fa fa-file" ></i></button>
                                                        </td>';
            
                                                      
            
            
                                                    //   VIEW
                                                    echo '<td class="text-center">   ';
                                                        
                                                    if($row['newUpload']==NULL){
                                                        echo '<a type="button" title="Recieved By" data-bs-toggle=
                                                        "modal" data-bs-target="#reupload' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-edit"></i></a>';
    
                                                    } else {
                                                        $file_dir = '../pdf/'.$row['newUpload'];
                                                        echo '<a type="button" title="Recieved By" data-bs-toggle=
                                                        "modal" data-bs-target="#reupload' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-edit"></i></a>';
    
                                                        echo '<a type="button" onclick="openCustom(\''.
                                                                                $file_dir.'?'.time().'\',1000,1000)"  title="View new upload file" data-bs-toggle=
                                                        "modal" class="btn button-s btn-sm"><i class="fa fa-eye"></i></a>';
    
                                                    }
                                                  
                                                  
                                                    echo '</td>';

                                                    
                                                        echo '<td class="text-center">   ';
                                                            //newUpload
                                                        if($row['newUpload']!=NULL){
                                                            echo '<a type="button" title="Recieved By" data-bs-toggle=
                                                            "modal" data-bs-target="#recieveby' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-paper-plane"></i></a>';
                                                            
                                                        } else {
                                                            echo'';
                                                        }
                                                       
                                                          
                                                        // Add more columns if needed
                                                        echo "</tr>";
            
                                                        include "modal/docuModalAuth.php";
            
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9' class='text-center'>No data found</td></tr>";
                                                }
            

                                            } elseif($accesstype == 2){
                                                $id = $_SESSION['offices'];
                                            
                                                $sql = "SELECT * FROM documenttransac where officeCreated ='$id' and is_mainRecord = 1 and is_mainStatus = 7 and dateDeleted is null ";
                                               
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

                                                        echo'<td align="center"> <a title="OPEN PDF" type="button" >
                                                                <i class="fa fa-barcode" href="javascript:void();" 
                                                                onclick="openCustom(\'viewBarcode.php?docu_id='.$row['docu_id'].'&referenceNo='.$row['referenceNo'].'\',1000,1000);"></i> </a>
                                                            </td>';
                                                        $file_dir = '../pdf/'.$row['fileUpload'];
                                                        echo '<td class="text-center">
                                                        <button type="button" title="BARCODE" onclick="openCustom(\''.
                                                                                $file_dir.'?'.time().'\',1000,1000)" class="btn button-s btn-sm"><i class="fa fa-file" ></i></button>
                                                        </td>';
            
                                                      
            
            
                                                    //   VIEW
                                                        echo '<td class="text-center">     
                                    
                                                        ';

                                                        if($row['is_mainRecord'] == 2){
                                                        echo '
                                                        <a type="button" title="Send to Main Record" data-bs-toggle=
                                                        "modal" data-bs-target="#sendTomain' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-paper-plane"></i></a>
            
                                                            <a type="button" title="Decline" data-bs-toggle=
                                                        "modal" data-bs-target="#sendTomain' . $row['docu_id'] . '" class="btn button-s btn-sm"><i class="fa fa-edit"></i></a> 
                                                        </td>';
                                                        }else{
                                                            echo "On Process";
                                                        }
            
                                                        // Add more columns if needed
                                                        echo "</tr>";
            
                                                        include "modal/docuModalAuth.php";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9' class='text-center'>No data found</td></tr>";
                                                }
            
                                            }
                                        }
                                    }

                                    ?>
                                </table>
