<?php
 include "database.php";

function GetData($sql_query) {
    global $conn;
    $result = $conn->query($sql_query);
    if (!$result || $result->num_rows === 0) {
        return false;
    }
    $row = $result->fetch_array(MYSQLI_NUM);
    // Applying htmlspecialchars to the fetched value
    return $row[0];
}

function OfficeName($id){
    global $conn;
    $query = 'SELECT officeName FROM offices WHERE office_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

function Signatory($id){
    global $conn;
    $query = 'SELECT CONCAT(signatory,\' - \',Position) as xxx FROM officesignatory WHERE os_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

function GetSignatory($id){
    global $conn;
    $query = 'SELECT signatory FROM officesignatory WHERE os_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

function GetOfficeID($id){
    global $conn;
    $query = 'SELECT office_id FROM officesignatory WHERE os_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}


function Position($id){
    global $conn;
    $query = 'SELECT position_id FROM officesignatory WHERE os_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

function GetCampusname($id){
    global $conn;
    $query = 'SELECT campusName FROM campus WHERE campus_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($campusName);
    $stmt->fetch();
    $stmt->close();
    return $campusName;
}
function GetUserCreated($id){
    global $conn;
    $query = 'SELECT fullname FROM users WHERE user_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($fullname);
    $stmt->fetch();
    $stmt->close();
    return $fullname;
}
function GetDocumentType($id){
    global $conn;
    $query = 'SELECT doctypeName FROM docktype WHERE dt_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($doctypeName);
    $stmt->fetch();
    $stmt->close();
    return $doctypeName;
}
function GetAccessname($id){
    global $conn;
    $query = 'SELECT accessName FROM accesstype WHERE acc_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($accessName);
    $stmt->fetch();
    $stmt->close();
    return $accessName;
}
function getVoucherType($id){
    global $conn;
    $query = 'SELECT vtName FROM vouchertype WHERE vt_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($vtName);
    $stmt->fetch();
    $stmt->close();
    return $vtName;
}
function getPositionName($id){
    global $conn;
    $query = 'SELECT positionTitle FROM position WHERE positionId=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($positionTitle);
    $stmt->fetch();
    $stmt->close();
    return $positionTitle;
}

function Generatepassword($length = 8) {
	//$characters = '2345679ACDEFGHJKLMNPQRSTUVWXYZ';
	$characters = '0123456789ABCDE';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function GetCampus($id){
    global $conn;
    $query = 'SELECT 
    campus.campusName 
FROM 
    campus 
INNER JOIN 
    offices 
ON 
    campus.campus_id = offices.campus
WHERE 
    offices.office_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($campusName);
    $stmt->fetch();
    $stmt->close();
    return $campusName;
}

function GetCampusid($id){
    global $conn;
    $query = 'SELECT 
    campus.campus_id 
FROM 
    campus 
INNER JOIN 
    offices 
ON 
    campus.campus_id = offices.campus
WHERE 
    offices.office_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($campusNameid);
    $stmt->fetch();
    $stmt->close();
    return $campusNameid;
}
function GetOfficeId1($id){
    global $conn;
    $query = 'SELECT 
    offices.office_id 
FROM 
    offices 
INNER JOIN 
    officesignatory 
ON 
    offices.office_id = officesignatory.os_id
WHERE 
    officesignatory.office_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($GetOfficeId);
    $stmt->fetch();
    $stmt->close();
    return $GetOfficeId;
}
function GenerateOtp($length = 6) {
	//$characters = '2345679ACDEFGHJKLMNPQRSTUVWXYZ';
	$characters = '0123456789ABCDE';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


function GenerateRandomString($length = 5) {
	//$characters = '2345679ACDEFGHJKLMNPQRSTUVWXYZ';
	$characters = '0123456789ABCDE';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
function GenerateRandomStringRef($length = 8) {
	//$characters = '2345679ACDEFGHJKLMNPQRSTUVWXYZ';
	$characters = '0123456789ABCDE';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
 


 function secureData( $string, $action = 'e' ) {
        $secret_key = 'monkey.d.luffy';
        $secret_iv = 'monkey.d.garp';
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;
    }


function GetOffice_ID($office_tag){
    $office_id = GetData('select office_id from officesignatory where os_id='.$office_tag);
    return GetData('select officeName from offices where office_id='.$office_id);
}

function getStat($choose) {
    // Read the JSON file
    $json_data = file_get_contents('./../setting.json');

    // Decode the JSON data into an associative array
    $data = json_decode($json_data, true);

    // Initialize the status variable
    $status = "";

    if ($choose !== null) {
        foreach ($data['statuses'] as $status_info) {
            if ($status_info['id'] == $choose) {
                $status = $status_info['status'];
                break;
            }
        }
    }

    return $status;
}

?>