<?php 

$par = $_REQUEST["par"];
if(!empty($par)) {
    require_once("../../HMSconfig.php");
    if($par === 'Pos')
    {
        $res = $db->query("SELECT * FROM position ORDER BY position");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'All') {
        $res = $db->query("SELECT staff.*, position.position FROM staff, position WHERE staff.positionId = position.id ORDER BY staff.positionId, staff.firstname, staff.lastname");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'Ward') {
        $res = $db->query("SELECT * FROM ward");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif ($par === 'New') {
        //function for reg num
        function generateRandomNum($length = 8) {
			$characters = '0123456789';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		function generateRandomString($length = 2) {
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
        $num = generateRandomNum($length = 8);
        $str = generateRandomString($length = 2);


        $pos = $_REQUEST["pos"];
        $fName = $_REQUEST["fName"];
        $sName = $_REQUEST["sName"];
        $oName = $_REQUEST["oName"];
        $phone = $_REQUEST["phone"];
        $dob = $_REQUEST["dob"];
        $add = $_REQUEST["add"];
        $stateR = $_REQUEST["state"];
        $code = $num.$str;

        $res = $db->query("SELECT * FROM staff WHERE phone =".$phone);
        $num = $res->num_rows;
        $row = $res->fetch_assoc();
        if($num > 0 && $row['firstname'] == $fName && $row['lastname'] == $sName)
        {
            echo 2;
        } else {
            $res1 = $db->query("INSERT INTO staff (firstname, lastname, othername, phone, positionId, superUser, code, address, stateId, dob) VALUES ('$fName', '$sName', '$oName', '$phone', $pos, 'N', '$code', '$add', $stateR, '$dob')");
            $lastId = $db->insert_id;
            $res2 = $db->query("SELECT CONCAT(firstname, ' ',lastname) as name, code FROM staff WHERE id =".$lastId);
            $num = $res2->num_rows;
            if($num > 0) {
                while($rw = $res2->fetch_assoc())
                {
                    $data[] = $rw;
                }                
                echo json_encode( $data );
            }
        }
    }
	 
} else {
	$data['state'] = 'Error';
	$data['statusMsg'] = 'Invalid Inputs';
	echo json_encode( $data );

}

exit;
?>