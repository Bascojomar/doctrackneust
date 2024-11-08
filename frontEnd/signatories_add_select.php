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


if(isset($_POST['allow_transaction'])){
    $swaps = $_POST['swaps'];
    $data = explode(':::',$swaps);
            $id = $data[0];
            $get_this_id = $data[1];

    $id_index = GetData('select indexing from '.$_SESSION['z_tmp_signatory'].' where id='.$id);
    $get_this_id_index = GetData('select indexing from '.$_SESSION['z_tmp_signatory'].' where id='.$get_this_id);
   
    mysqli_query($conn,'update '.$_SESSION['z_tmp_signatory'].' set indexing='.$get_this_id_index.' where id='.$id);
    mysqli_query($conn,'update '.$_SESSION['z_tmp_signatory'].' set indexing='.$id_index.' where id='.$get_this_id);
}


if(isset($_POST['os_id'])){
    $index = GetData('select max(indexing) from '.$_SESSION['z_tmp_signatory'].' ') + 1;
    $is_exist = GetData('select os_id from '.$_SESSION['z_tmp_signatory'].' where os_id='.$_POST['os_id']) + 0;
    if($is_exist==0){
        mysqli_query($conn,'insert into '.$_SESSION['z_tmp_signatory'].'
            SET os_id='.$_POST['os_id'].',indexing='.$index.'    ');
    } else {
        $m = '<span style="color:blue;">Already selected.</span>';
    }
       
}


if(isset($_POST['delete_id'])){
    mysqli_query($conn,'delete from '.$_SESSION['z_tmp_signatory'].' where id='.$_POST['delete_id']);
     
    $result = mysqli_query($conn, 'SELECT id FROM '.$_SESSION['z_tmp_signatory'].' ORDER BY indexing');
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        mysqli_query($conn, 'UPDATE '.$_SESSION['z_tmp_signatory'].' SET indexing = '.$index.' WHERE id='.$row['id']);
        $index++;
    }
}

$is_have = GetData('select os_id from '.$_SESSION['z_tmp_signatory'].' ') + 0;
?>
<input type="hidden" id="is_valid_" value="<?php echo $is_have; ?>"/>
<input type="hidden" value="1" id="is_valid"/>
<?php if($m){echo $m;} ?>
<h6>Signatory List</h6>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Signatory</th>
            <th>Position</th>
            <th>Office</th>
            <th>Action</th>
            <th>Swap</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $count = 1;
    

    $q = 'select id,os_id,indexing from '.$_SESSION['z_tmp_signatory'].' order by indexing ';
    
    $rs = mysqli_query($conn,$q);
    while($rw = mysqli_fetch_array($rs)){
        $position_id = GetData('select position_id from officesignatory where os_id='.$rw['os_id']);
        $posi = GetData('select positionTitle from position where positionID='.$position_id);

        $office_id = GetData('select office_id from officesignatory where os_id='.$rw['os_id']);
        $office = GetData('select officeName from offices where office_id='.$office_id);
        echo'<tr>
            <td>Signatory&nbsp;'.$rw['indexing'].'</td>
            <td>'.htmlspecialchars(GetSignatory($rw['os_id'])).'</td>
            <td>'.htmlspecialchars($posi).'</td>
            <td>'.htmlspecialchars($office).'</td>
            <td align="center"><a href="javascript:void();" onclick="ajax_post(\'delete_id\','.$rw['id'].',\'signatories_add_select.php\',\'tmp_select\')"><i style="color:black;" class="fa fa-trash" aria-hidden="true"></i></a></td>';


        echo'<td align="center"><span id="tmp_s'.$rw['id'].'"><a href="javascript:void();" 
        onclick="change_signatory('.$rw['id'].');"><i style="color:black;" class="fa fa-edit"></i></a></span></td>';
        echo'</tr>';
    }
    ?>
    </tbody>
</table>