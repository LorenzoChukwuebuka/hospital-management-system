<?php 
require_once("../../HMSconfig.php");
$reg = $_REQUEST["reg"];
if(!empty($reg)) {
	$res = $db->query("SELECT staff.*, hospital.* FROM staff, hospital WHERE staff.code ='".$reg."'");
	$num = $res->num_rows;
	if($num < 1) {
		$data['state'] = 'Error';
		$data['statusMsg'] = 'User Not Found';
		//$resp = array("error" => "1" ,"errorMsg" => "");
		echo json_encode( $data);
	} else {
	
		$list = $res->fetch_assoc();

		$data['staff'] = array('id'=> $list['id'],'firstname'=> $list['firstname'], 'lastname'=> $list['lastname'], 'mail'=> $list['email'], 'phone'=> $list['phone'], 'position' => $list['positionId'], 'superUser' => $list['superUser'], 'name' => $list['name']);
		$data['state'] = 'Success';
		//$resp = array("success" => "1" , "rowCount"=> $num, "staff" => $data);
		echo json_encode( $data );
	}
} else {
	$data['state'] = 'Error';
	$data['statusMsg'] = 'Invalid Inputs';
	//$resp = array("error" => "1" ,"errorMsg" => "Invalid Inputs");
	echo json_encode( $data );

}

exit;
?>