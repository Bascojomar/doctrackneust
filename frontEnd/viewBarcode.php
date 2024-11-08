<?php

include "../backEnd/database.php";
include "../backEnd/function.php";


session_start();
if(!isset($_SESSION['user_id'])){header("Location: ../index");}
$dt_id = $_GET['docu_id'];
$rs = mysqli_query($conn,'SELECT * FROM documenttransac WHERE docu_id='.$dt_id);
$rw = mysqli_fetch_array($rs);



?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
        <!--
        p {margin: 0; padding: 0;}

        .ft10{font-size:15px;font-family:Times;color:#000000;}
        .ft11{font-size:14px;font-family:Times;color:#ffffff;}
        .ft12{font-size:14px;font-family:Times;color:#000000;}
        .ft13{font-size:13px;font-family:Times;color:#000000;}
        .ft14{font-size:14px;font-family:Times;color:#001f5f;}
        .ft15{font-size:14px;font-family:Times;color:#001f5f;}
        .ft16{font-size:14px;font-family:Times;color:#001f5f;}
        .ft17{font-size:23px;font-family:Times;color:#001f5f;}
        .ft18{font-size:15px;font-family:Times;color:#000000;}
        .ft19{font-size:13px;font-family:Times;color:#ffffff;}
        .ft110{font-size:13px;font-family:Times;color:#ffffff;}
        .ft111{font-size:13px;font-family:Times;color:#000000;}
        .ft112{font-size:11px;font-family:Times;color:#000000;}
        .ft113{font-size:14px;line-height:23px;font-family:Times;color:#000000;}
        .ft114{font-size:14px;line-height:20px;font-family:Times;color:#000000;}
        .ft115{font-size:13px;line-height:19px;font-family:Times;color:#000000;}
        .ft116{font-size:14px;line-height:18px;font-family:Times;color:#001f5f;}
        .ft117{font-size:14px;line-height:20px;font-family:Times;color:#001f5f;}
        .ft118{font-size:14px;line-height:18px;font-family:Times;color:#001f5f;}
        .ft119{font-size:14px;line-height:19px;font-family:Times;color:#001f5f;}
        .ft120{font-size:14px;line-height:20px;font-family:Times;color:#001f5f;}
        .ft121{font-size:14px;line-height:19px;font-family:Times;color:#000000;}
        .ft122{font-size:13px;line-height:20px;font-family:Times;color:#000000;}
        .ft123{font-size:14px;line-height:22px;font-family:Times;color:#000000;}

        #page1-div {
            position: relative;
            width: 210mm; /* Width of A4 paper */
            height: 153.5mm; /* Height of A4 paper */
            margin: 0 auto; /* Center the element horizontally */
        }

        @media print {
            #page1-div {
                margin-left: 0; /* Remove left margin when printing */
                height: auto 0 !important; /* Adjust height to match content */
                margin-top: 50px;
            }
        }
        -->
    </style>
</head>
<body bgcolor="#A0A0A0" vlink="blue" link="blue">
<div id="page1-div">
    <img width="918" height="615" src="bg.png" alt="background image"/>
<p style="position:absolute;top:57px;left:108px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:57px;left:162px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:57px;left:216px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:57px;left:270px;white-space:nowrap" class="ft10">&#160;&#160;</p>
<p style="position:absolute;top:54px;left:278px;white-space:nowrap" class="ft11">&#160;</p>
<p style="position:absolute;top:74px;left:459px;white-space:nowrap" class="ft10">&#160;</p>
<p style="position:absolute;top:96px;left:108px;white-space:nowrap" class="ft113">&#160;<br/>&#160;</p>
<p style="position:absolute;top:1077px;left:108px;white-space:nowrap" class="ft114">&#160;<br/>&#160;</p>
<p style="position:absolute;top:47px;left:155px;white-space:nowrap; font-size:15px;" class="ft120"><i>&#160;<br/></i><b>Cabanatuan&#160;City, Nueva&#160;Ecija, Philippines&#160;<br/>ISO 9001:2015&#160;CERTIFIED&#160;<br/>&#160;<br/></b><i>&#160;</i></p>
<p style="position:absolute;top:26px;left:155px;white-space:nowrap; font-size:15px;" class="ft16"><b>Republic&#160;of&#160;the&#160;Philippines&#160;</b></p>
<p style="position:absolute;top:46px;left:155px;white-space:nowrap; font-size:20px;" class="ft17"><b>NUEVA&#160;ECIJA&#160;UNIVERSITY&#160;OF&#160;SCIENCE&#160;AND&#160;TECHNOLOGY&#160;</b></p>
<p style="position:absolute;top:78px;left:155px;white-space:nowrap" class="ft16"><b>&#160;</b></p>
<p style="position:absolute;top:123px;left:320px;white-space:nowrap" class="ft18"><b>DTS&#160;–&#160;DOCUMENT&#160;TRACKING&#160;SYSTEM</b>&#160;</p>
<p style="position:absolute;top:146px;left:460px;white-space:nowrap" class="ft19"><i>&#160;</i></p>
<p style="position:absolute;top:178px;left:460px;white-space:nowrap" class="ft19"><i>&#160;</i></p>
<p style="position:absolute;top:210px;left:460px;white-space:nowrap" class="ft110">&#160;</p>
<p style="position:absolute;top:241px;left:460px;white-space:nowrap" class="ft111">&#160;</p>
<p style="position:absolute;top:139px;left:108px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:139px;left:162px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:139px;left:216px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:139px;left:270px;white-space:nowrap" class="ft12">&#160;&#160;&#160;</p>
<p style="position:absolute;top:173px;left:108px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:207px;left:108px;white-space:nowrap" class="ft12">&#160;</p>
<p style="position:absolute;top:241px;left:108px;white-space:nowrap" class="ft121">&#160;<br/>&#160;<br/>&#160;</p>

<p style="position:absolute;top:514px;left:689px;white-space:nowrap" class="ft122"><b>&#160;<br/>Contact&#160;No.&#160;(0&#160;44)&#160;940-9980&#160;<br/>Email:&#160;sanisidro@neust.edu.ph&#160;<br/>www.neust.edu.ph&#160;</b></p>
<p style="position:absolute;top:606px;left:689px;white-space:nowrap" class="ft112"><b>&#160;</b></p>
<p style="position:absolute;top:536px;left:45px;white-space:nowrap" class="ft117"><i><b>&#160;<br/></b>Transforming&#160;Communities through&#160;Science&#160;and&#160;Technology&#160;&#160;<br/><b>&#160;</b></i></p>

<p style="font-weight: bold; font-size: 30px; position:absolute;text-align:center;top:160px;left:260px;white-space:nowrap" class="ft18"">RECORDS OFFICE RECEIPT <br> <br> <br></p>
<p style="position:absolute;text-align:center;top:220px;left:340px;white-space:nowrap" class="ft18">

<?php 

// $campus = "SAN ISIDRO";
// $fromoffice ="CICT";
// $subjec ="CICT";
// $cdate ="02/05/2024";
// $reference ="NEUST12365812838123";

// Extracting values from the row and functions
$campus = GetCampus($rw['officeCreated']);
$fromoffice = OfficeName($rw['officeCreated']);
$subject = $rw['documentSubject'];
$cdate = date('Y-m-d'); // Replace with appropriate date if available

// Printing in the new format
echo "CAMPUS: $campus<br>";
echo "OFFICE: $fromoffice<br>";
echo "SUBJECT: $subject<br>";
echo "DATE: $cdate<br>";
		echo'<img  style="margin-left:200px; position:absolute;top:80px;right:-140px;" src="../barcode/'.$rw['referenceNo'].'.png" height="100"/> ';
?>

</p>

<p style="position:absolute;top:440px;right:-20px;white-space:nowrap" class="ft123">________________________________&#160;</p>
<p style="position:absolute;top:460px;right:10px;white-space:nowrap" class="ft18">

Signature over printed name

</p>


</div>
</body>
</html>