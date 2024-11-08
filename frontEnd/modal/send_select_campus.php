<?php
$campus_id = $_GET['campus_id'];
$campusName = $_GET['campusName'];



  echo"<SELECT name='fromoffice' id='fromoffice' onchange='toggleOther(this.value);' class='form-control'>";
  echo "<OPTION value = '' disabled selected hidden>Select Office</OPTION>";
    $rs = mysqli_query($conn,'SELECT office_id, officeName, campus 
                              from offices WHERE campus='.$campus_id.'');
    while($rw = mysqli_fetch_array($rs)){
        echo'<option value="'.$rw['officeName'].'">'.$rw['officeName'].'</option>';
    }
    
  echo "</SELECT>";
?>


