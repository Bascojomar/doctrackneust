<div class="modal fade" id="docModal" tabindex="-1" aria-labelledby="campusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="campusModalLabel">New Documents</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
        </div>

    <div class="mx-4 px-2 pb-2">
        <div class="title">

        </div>
        <?php
        $isDisabled = true; 
        $date = date('Yms');
        $randomNumber = mt_rand(1, 99999); // Generates a random number between 1 and 999
        $result = $date . $randomNumber;
        $date1 = date('y/m/d');
        echo '
        <div class="table-container mt-2">
            <div class="row my-2 mx-2">
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
echo "<FORM action = '../backEnd/newdocuAuth.php' method = 'POST' enctype='multipart/form-data' autocomplete = 'off'>";
                // echo "<input type='hidden' id='docCode' name='docCode' class='form-control' value='NEUST$result'";
                // if ($isDisabled) {
                //   echo " readonly";
                // }
                // echo " oninput='this.value = this.value.toUpperCase()'>";

                // echo '<div class="col- 2 fw-bold col-form-label">Reference Number</div>';

                // echo "<input type='text' id='referenceNo' name='referenceNo' class='form-control' value='NEUST$result'";
                // if ($isDisabled) {
                //   echo " readonly";
                // }
                // echo " oninput='this.value = this.value.toUpperCase()'>";
                
                echo '
                </div>

                <div class="col- 2 fw-bold col-form-label">Files</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                echo "<INPUT type = 'file' name='uploadfile' class = 'form-control' accept='application/pdf'>";
                echo'</div>';
           

                if (isset($_SESSION['user_id'])) {
                    // Retrieve user data from the database
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                    $result = $conn->query($query);
                  
                    if ($result->num_rows == 1) {
                        $user_data = $result->fetch_assoc();
                
                        $accesstype =  $user_data['accesstype'];
                
                        if($accesstype == 1){
                            echo '
                            <div class="col- 2 fw-bold col-form-label">Office</div>
                            <div class="col- 10"> </div>
                            <div class="col-12 mb-2">';
                            echo '<select name="officecreated" id="officecreated" class="form-control" required onchange="loadOffices(this.value)">';
                
                $query = "SELECT * FROM offices ORDER BY office_id";
                $results = $conn->query($query);
                $numrows = $result->num_rows;
              
                while ($rows = $results->fetch_assoc()) 
                {
                  echo "<OPTION id = 'camp' disabled selected hidden>Office</OPTION>";
                  echo "<OPTION id = 'camp' value = '".$rows["office_id"]."'>".$rows["officeName"]."</OPTION>";
                }

                echo'</select>
                </div>';

                        }elseif($accesstype == 4){
                                echo '<input type="text" name="officecreated" value="'.$_SESSION['offices'].'" hidden>';
                    }
                }
            }


               
               
                echo'
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';
                
                echo'</div>';
echo'
                <div class="col- 2 fw-bold col-form-label">Title</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">'; 
               echo "<INPUT type = 'text' name = 'subject' class = 'form-control' placeholder = '  Title' oninput = 'this.value = this.value.toUpperCase()'>";
                echo'</div>

                <div class="col-12 mb-2">';
                echo '<input type="text" name="userCreated"  value="'.$_SESSION['user_id'].'" hidden> ';
                echo'</div>

                <div class="col- 2 fw-bold col-form-label">Document Type</div>
                <div class="col- 10"> </div>
                <div class="col-12 mb-2">';



                echo "<SELECT name='docutype' class='form-control' onchange='toggleVoucherType(this.value); DisableVoucherType(this.value);' required>";
                echo "<OPTION value = '' disabled selected hidden>Document Type</OPTION>";
              
                $query = "SELECT * FROM docktype ORDER BY doctypeName limit 1";
                $result = $conn->query($query);
                $numrows = $result->num_rows;
              
                while ($rows = $result->fetch_assoc()) 
                {
                  echo "<OPTION id = 'com' value = '".$rows["dt_id"]."'>".$rows["doctypeName"]."</OPTION>";
                }   
                echo "</SELECT>";
                
                echo'</div>

                <div id="voucherSection" style="display: none;">
    <div class="col-2 fw-bold col-form-label">VoucherType</div>
    <div class="col-10">';
        echo "<SELECT name='vouchertype' id='vouchertype' class='form-control'>";
        echo "<OPTION value='' disabled selected hidden>Voucher Type</OPTION>";

        $query = "SELECT * FROM vouchertype ORDER BY vtName";
        $result = $conn->query($query);

        while ($rows = $result->fetch_assoc()) {
            echo "<OPTION value='".$rows["vt_id"]."'>".$rows["vtName"]."</OPTION>";
        }

        echo '</SELECT>';
        echo'

    </div>
    <div class="col-2 fw-bold col-form-label">Voucher No.</div>
    <div class="col-10">
        <input type="text" name="voucherno" class="form-control" id="voucherno" oninput="this.value = this.value.toUpperCase()" placeholder="  Voucher No.">
    </div>
    <div class="col-2 fw-bold col-form-label">Voucher Amount</div>
    <div class="col-10">
        <input type="text" name="voucheramt" class="form-control" id="voucheramt" placeholder="  Voucher Amount" oninput="this.value = this.value.toUpperCase()">
    </div>
</div>
              

            <div class="text-center">
                <div class="btn btn-primary">';
                echo "<INPUT type = 'submit' value = 'SAVE' name='submit_x' class='btn btn-primary px-5' />";
                echo'</div>
                <div class="btn btn-danger">';
                echo "<INPUT type = 'reset' value = 'CANCEL' class='btn btn-danger px-5' />";
                echo '</div>
            </div>
        </div>
        </div>';
        echo "</form>";

        ?>
                </div>
            </div>
        </div>
    </div>

    <script>
  
	function DisableOffice(elementName) {

if (elementName != 'OTHERS'){
  document.getElementById("otheroffice").readOnly = true;
  document.getElementById("otheroffice").value = "-";
}
else {
        // If elementName is 'OTHERS', set the readOnly property to false
        document.getElementById("otheroffice").readOnly = false;
        // You can also set the value to an empty string or any default value if needed
        document.getElementById("otheroffice").value = "";
    }

}

function DisableVoucherType(elementName) {
    if (elementName === '1') {
        document.getElementById("vouchertype").readOnly = true;
        document.getElementById("vouchertype").value = "-";
        document.getElementById("voucherno").readOnly = true;
        document.getElementById("voucherno").value = "-";
        document.getElementById("voucheramt").readOnly = true;
        document.getElementById("voucheramt").value = "-";
    } else if (elementName === '3') {
        document.getElementById("vouchertype").readOnly = false;
        document.getElementById("vouchertype").value = "";
        document.getElementById("voucherno").readOnly = false;
        document.getElementById("voucherno").value = "";
        document.getElementById("voucheramt").readOnly = false;
        document.getElementById("voucheramt").value = "";
    }
}

function toggleVoucherType(selectedValue) {
    const voucherSection = document.getElementById('voucherSection');
    if (selectedValue === '1') {
        voucherSection.style.display = 'none';
    } else if (selectedValue === '-') {
        voucherSection.style.display = 'none';
    } else {
        voucherSection.style.display = 'block';
    }
}
</script>
