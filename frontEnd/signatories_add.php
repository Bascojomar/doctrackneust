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

if(isset($_POST['add_'])){
    //$count=1;
    $referenceNo = GetData('select referenceNo from documenttransac where docu_id='.$_POST['docu_id']);
    $rs = mysqli_query($conn,'SELECT * FROM '.$_SESSION['z_tmp_signatory']);
    while ($rw = mysqli_fetch_array($rs)) {
        $q = 'insert into documentdetails set referenceNo=\''.$referenceNo.'\',office_tag='.$rw['os_id'].',
                    indexing='.$rw['indexing'].' ';
        mysqli_query($conn,$q);
    }
    mysqli_query($conn,'delete from '.$_SESSION['z_tmp_signatory'].' ');
}


if(isset($_POST['edit_'])){
    //$count=1;
    $referenceNo = GetData('select referenceNo from documenttransac where docu_id='.$_POST['docu_id']);
    mysqli_query($conn,'delete from documentdetails where referenceNo=\''.$referenceNo.'\' ');
    $rs = mysqli_query($conn,'SELECT * FROM '.$_SESSION['z_tmp_signatory']);
    while ($rw = mysqli_fetch_array($rs)) {
        $q = 'insert into documentdetails set referenceNo=\''.$referenceNo.'\',office_tag='.$rw['os_id'].',
        indexing='.$rw['indexing'].' ';
        mysqli_query($conn,$q);
    }
    mysqli_query($conn,'delete from '.$_SESSION['z_tmp_signatory'].' ');
}


?>
<div class="container card mb-3" style="margin-top:-50px;">
    <div class="card-body">

        <div class="card-title">
            <!-- Page Heading -->
            
            <div align="right">
                <?php
                if($is_exist_in_documentdetails){
                    echo' <a id="process_sig" href="javascript:void();" onclick="update_signatory('.$docu_id.');" class="btn btn-sm btn-primary">Update</a>';
                } else {
                    echo' <a id="process_sig" href="javascript:void();" onclick="process_signatory('.$docu_id.');" class="btn btn-sm btn-primary">Process</a>';
                }
                ?>
                <a href="document" class="btn btn-sm btn-secondary">Back</a>
            </div>
            <br>
            <div class="row">
                <div class="col-6 mb-3">
                    <input onkeyup="str_search();" type="text" id="str" class="form-control form-control-sm" placeholder="Search signatory here..." />
                </div>
                <div class="col-6 mb-3">
                    <input type="hidden" value="<?=$officeCreated?>" id="officeCreated"/>
                    <select onchange="str_search();" class="form-control form-control-sm" id="office_id">
                        <option value="0">-- All Offices --</option>
                        <?php $rs = mysqli_query($conn,'SELECT office_id, officeName, officeCode, campus from offices');
                        while ($rw = mysqli_fetch_array($rs)) { $sel = '';
                            if ($office_id==$rw['office_id']) { $sel = 'selected="selected"'; }
                            echo '<option value="'.$rw['office_id'].'" '.$sel.'>'.$rw['officeName'].'</option>';
                        } ?>
                    </select>
                </div>
            </div>            

            <div id="tmp"><?php include('signatories_add_search.php'); ?></div>

            <div id="tmp_select">
                <input type="hidden" value="0" id="is_valid"/>
                <?php include('signatories_add_select.php'); ?>
            </div>

        </div>
    </div>
</div>