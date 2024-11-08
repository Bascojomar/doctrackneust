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


$os_id = GetData('select os_id from '.$_SESSION['z_tmp_signatory'].' where id='.$_POST['get_this_id']);

?>

<select id="swaps">
    <?php
    $rs = mysqli_query($conn,'select * from '.$_SESSION['z_tmp_signatory'].' where id!='.$_POST['get_this_id'].' order by id');
    while($rw = mysqli_fetch_array($rs)){
        echo'<option value="'.$rw['id'].':::'.$_POST['get_this_id'].'">Swap with '.GetSignatory($rw['os_id']).'</option>';
    }
    ?>
</select>
<div align="center"><button onclick="swap_it();">Swap</button><br>
<button onclick="ajax_new('signatories_add_select.php','tmp_select');">Cancel</button></div>

