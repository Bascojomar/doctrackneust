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
<?php
//$officeCreated = GetData('select officeCreated from documenttransac where docu_id='.$docu_id) + 0;

?>

<table class="table table-sm table-bordered">
    <tr>
        <th>Signatory</th>
        <th>Position</th>
        <th>Office</th>
        <th>Action</th>
    </tr>
    <?php
    $count = 1;
    $q = 'select os_id,signatory,position_id,office_id,dateCreated from officesignatory WHERE is_active=1 ';
    if(isset($_POST['str'])){
        if($_POST['str']==''){
            $q .= ' ';
        } else {
            $q .= ' AND signatory LIKE \'%'.mysqli_real_escape_string($conn,$_POST['str']).'%\' ';
        }
    }

    if(isset($_POST['office_id'])){
        if($_POST['office_id']==0){
            $q .= ' ';
        } else {
            $q .= ' AND office_id='.mysqli_real_escape_string($conn,$_POST['office_id']).' ';
        }
    }

    if(isset($_POST['officeCreated'])){
        if($_POST['officeCreated']){
            $q .= ' AND office_id!='.$_POST['officeCreated'];
        } else {
            $q .= ' ';
        }
    }


    $q .= ' order by signatory LIMIT 0,10';
    $rs = mysqli_query($conn,$q);
    while($rw = mysqli_fetch_array($rs)){
        $posi = GetData('select positionTitle from position where positionID='.$rw['position_id']);
        echo'<tr>
            <td>'.htmlspecialchars($rw['signatory']).'</td>
            <td>'.htmlspecialchars($posi).'</td>
            <td>'.htmlspecialchars(OfficeName($rw['office_id'])).'</td>
            <input type="hidden" id="os_id'.$rw['os_id'].'" value="'.$rw['os_id'].'"/>
            <td align="center"><a onclick="add_signatory('.$rw['os_id'].');" href="javascript:void();"><i style="color:black;"class="fa fa-check" aria-hidden="true"></i></a></td>
        </tr>';
    }
    ?>
</table>







