<?php
include 'database.php';
session_start();

if (isset($_POST['submit'])) {
  // Sanitize input to prevent SQL injection
  $reference = mysqli_real_escape_string($conn, $_POST['reference']);


  $date1 = date('y-m-d');

  $office = $_SESSION['offices'];
  $checkQuery = "SELECT * FROM officesignatory WHERE office_id = '$office'";
  $resultt = $conn->query($checkQuery);

  $rs = $resultt->fetch_assoc();
  $os_id = $rs['os_id'];


  $master_reference = GetData('select referenceNo  from documenttransac where documentCode=\''.$reference.'\' ');

  // Check if the reference exists in the database
  $checkQuery = "SELECT * FROM documentdetails WHERE  is_send = 0 and status = 2 and referenceNo = '$master_reference' and office_tag = '$os_id'";
  $result = $conn->query($checkQuery);
  $row1 = $result->fetch_assoc();
  $index = $row1['indexing'];

  if($index != 1){
    $checkQuery = "SELECT * FROM documentdetails WHERE indexing < '$index'  and dateRelease is null and referenceNo = '$master_reference' ORDER BY indexing ASC LIMIT 1";
    $check = $conn->query($checkQuery);
    $count = $check->num_rows;
    $rows = $check->fetch_assoc();
    $office = $rows['office_tag'];

    $checkQuery = "SELECT o.officeName FROM officesignatory os JOIN offices o ON os.office_id = o.office_id WHERE os.os_id = '$office'";
    
    $checkoffice = $conn->query($checkQuery);
    $rowoffice = $checkoffice->fetch_assoc();
    $officeName = $rowoffice['officeName'];
    
  }else{
    $count = 0;
  }
  
  $checkQuery = "SELECT * FROM documenttransac WHERE referenceNo = '$master_reference'";
  $results = $conn->query($checkQuery);

  while ($rows = $results->fetch_assoc()) {
    $subject = $rows['documentSubject'];
}


if($count == 0){

  if ($result->num_rows > 0) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      var sweetAlertScript = document.createElement("script");
      sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
      document.head.appendChild(sweetAlertScript);
    
      sweetAlertScript.onload = function() {
        swal({
          title: "Details",
          text: "ReferenceNo. '.$master_reference.' \\nSubject : '.$subject.'",
           buttons: {
          cancel: "No",
          confirm: "Yes",
        
  }
        }).then((willUpdate) => {
          if (willUpdate) {
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "'.$_SERVER['PHP_SELF'].'";
            var hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.name = "confirmed";
            hiddenField.value = "yes";
            form.appendChild(hiddenField);
            var referenceField = document.createElement("input");
            referenceField.type = "";
            referenceField.name = "reference";
            referenceField.value = "'.$master_reference.'";
            form.appendChild(referenceField);
            document.body.appendChild(form);
            form.submit();
          } else {
            window.location.href = "../frontEnd/receivedDoc";
          }
        });
      };
    });
    </script>';
  }  else {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      var sweetAlertScript = document.createElement("script");
      sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
      document.head.appendChild(sweetAlertScript);
    
      sweetAlertScript.onload = function() {
        swal({
          title: "No Reference",
          text: "No Reference",
          icon: "warning",
          buttons: false,
          timer: 1200
        });
        
        setTimeout(function() {
          window.location.href = "../frontEnd/receivedDoc";
        }, 1200); // Redirect after 1.2 seconds
      };
    });
    </script>';
  }
}
else {
  echo '<script>
document.addEventListener("DOMContentLoaded", function() {
  var sweetAlertScript = document.createElement("script");
  sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
  document.head.appendChild(sweetAlertScript);

  sweetAlertScript.onload = function() {
    swal({
      title: "Return",
      text: "to ' . $officeName . '",
      icon: "warning",
      buttons: {
        cancel: "Return",
        confirm: {
          text: "Bypass",
          value: "bypass",
        }
      }
    }).then((willUpdate) => {
      if (willUpdate) {
        // Nested confirmation dialog for "Bypass"
        swal({
          title: "Are you sure?",
          text: "Do you really want to bypass?",
          icon: "warning",
          buttons: {
            cancel: "Return",
            confirm: {
              text: "Yes, Bypass",
              value: "confirmBypass",
            }
          }
        }).then((confirmedBypass) => {
          if (confirmedBypass) {
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "' . $_SERVER['PHP_SELF'] . '";
            var hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.name = "confirmed";
            hiddenField.value = "yes";
            form.appendChild(hiddenField);
            var referenceField = document.createElement("input");
            referenceField.type = "hidden";  // Changed to "hidden"
            referenceField.name = "reference";
            referenceField.value = "' . $master_reference . '";
            form.appendChild(referenceField);
            document.body.appendChild(form);
            form.submit();
          } else {
            swal("Bypass cancelled", "Returning into ' . $officeName . '");
          }
        });
      } else {
        window.location.href = "../frontEnd/receivedDoc";
      }
    });
  };
});
</script>';

}
}

if (isset($_POST['confirmed']) && $_POST['confirmed'] === 'yes') {

  $reference = mysqli_real_escape_string($conn, $_POST['reference']);
  $ref = $reference;

  $office = $_SESSION['offices'];
  $checkQuery = "SELECT * FROM officesignatory WHERE office_id = '$office'";
  $resultt = $conn->query($checkQuery);

  $rs = $resultt->fetch_assoc();
  $os_id = $rs['os_id'];
  
  $date1 = date('y-m-d');

  include '../email/recieveddoc.php';
  
  $updateQuery = "UPDATE documentdetails SET status = 4, is_send = 1, dateRecieved = '$date1' WHERE dateRelease is null and status = 2 and referenceNo = '$reference' and office_tag = '$os_id'";

  
  if ($conn->query($updateQuery) === TRUE) {
      echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
        var sweetAlertScript = document.createElement("script");
        sweetAlertScript.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
        document.head.appendChild(sweetAlertScript);
      
        sweetAlertScript.onload = function() {
          swal({
            title: "Update Successful",
            text: "Successful",
            icon: "success",
            buttons: false,
            timer: 1200
          });
          
          setTimeout(function() {
            window.location.href = "../frontEnd/receivedDoc";
          }, 1200); // Redirect after 50.2 seconds
        };
      });
      </script>';
  } else {
      echo "<script>alert('Error updating the database');</script>";
  }
}

?>
