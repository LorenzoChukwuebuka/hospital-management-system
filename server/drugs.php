<?php 

$par = $_REQUEST["par"];
if(!empty($par)) {
    require_once("../../HMSconfig.php");
    if($par === 'All')
    {
        $res = $db->query("SELECT * FROM drug ORDER BY drugName");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif ($par === 'Add') {
        $drugName = $_REQUEST["drugName"];
        $amt = $_REQUEST["amt"];

        $res1 = $db->query("INSERT INTO drug (drugName, price) VALUES ('$drugName', $amt)");
        echo $res1;
    }
	 
} else {
	$data['state'] = 'Error';
	$data['statusMsg'] = 'Invalid Inputs';
	echo json_encode( $data );

}

exit;
?>