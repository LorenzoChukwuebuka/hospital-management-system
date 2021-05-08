<?php 
require_once("../../HMSconfig.php");
$par = $_REQUEST["par"];
if(!empty($par)) {
    if($par === 'Ethnic')
    {
        $res = $db->query("SELECT * FROM ethnic ORDER BY ethnic");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif ($par === 'Religion'){
        $res = $db->query("SELECT * FROM religion ORDER BY religion");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'BloodG') {
        $res = $db->query("SELECT * FROM bloodgroup ORDER BY bloodGroup");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'GenoT') {
        $res = $db->query("SELECT * FROM genotype ORDER BY genotype");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'State'){
        $res = $db->query("SELECT * FROM state ORDER BY state");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'new') {
        $fName = $_REQUEST["fName"];
        $sName = $_REQUEST["sName"];
        $oName = $_REQUEST["oName"];
        $phone = $_REQUEST["phone"];
        $state = $_REQUEST["state"];
        $dob = $_REQUEST["dob"];
        $occupation = $_REQUEST["occupation"];
        $rel = $_REQUEST["religion"];
        $ethnic = $_REQUEST["ethnic"];
        $bloodG = $_REQUEST["bloodG"];
        $geno = $_REQUEST["geno"];

        $add = $_REQUEST["add"];
        $stateR = $_REQUEST["stateR"];

        $nokFname = $_REQUEST["nokFname"];
        $nokSname = $_REQUEST["nokSname"];
        $nokPhone = $_REQUEST["nokPhone"];
        $nokAdd = $_REQUEST["nokAdd"];
        $nokState = $_REQUEST["nokState"];

        $res = $db->query("SELECT * FROM patient WHERE phone =".$phone);
        $num = $res->num_rows;
        $row = $res->fetch_assoc();
        if($num > 0 && $row['firstname'] == $fName && $row['surname'] == $sName)
        {
            echo 2;
        } else {
            $res1 = $db->query("INSERT INTO patient (surname, firstname, othername, phone, ethnicId, bloodGroupId, genotypeId, dob, stateId, occupation, religionId, dateReg) VALUES ('$sName', '$fName', '$oName', '$phone', $ethnic, $bloodG, $geno, '$dob', $state, '$occupation', $rel, NOW())");
            //echo $res1;
            $pId = $db->insert_id;//get id of just inserted patient

            if($pId)
            {
                //insert address
                $res2 = $db->query("INSERT INTO  address (address, stateId, patientId) VALUES ('$add', $stateR, $pId)");
                if($res2)
                {
                    //insert NoK
                    $res3 = $db->query("INSERT INTO nok (firstname, surname, address, stateId, phone, patientId) VALUES ('$nokFname', '$nokSname', '$nokAdd', $nokState, '$nokPhone', $pId)");
                    echo $res3;
                }
            }
            
            //echo $pId;
        }
        
    } elseif($par === 'Consult') {
        $fees = $_REQUEST["fees"];
        $visitId = $_REQUEST["visitId"];
        $notes = addslashes($_REQUEST["notes"]);
        $phyId = $_REQUEST["phyId"];
        $ward = $_REQUEST["ward"];
        $surgTitle = $_REQUEST["surg"];
        $surgeon = $_REQUEST["surgeon"];
        $surgNotes = $_REQUEST["surgNotes"];
        
        if($ward > 0)
        {
            $res2 = $db->query("INSERT INTO  admitted (dateAdmitted, physicianId, wardId, visitId) VALUES (NOW(), $phyId, $ward, $visitId)");
        }

        if($surgTitle != "")
        {
            $res3 = $db->query("INSERT INTO surgery (visitId, surgery, notesProg, surgDate, physicianId) VALUES ($visitId, '$surgTitle', '$surgNotes', NOW(), $phyId)");
        }
      
        //insert consultation data and return vistId
        $res = $db->query("UPDATE patientvisit SET diagnosis = '$notes', fee = $fees, consultancyFee = $fees, physicianId = $phyId WHERE id =".$visitId);
        $lastId = mysqli_affected_rows($db);
        
        if($lastId > 0)
        {
            //update patientvisitcycle tb
            $res1 = $db->query("UPDATE patientvisitcycle SET seen = 'Y' WHERE patientVisitId =".$visitId);
            $lastId1 = mysqli_affected_rows($db);
            echo $res1;
        }
        
    } elseif($par === 'consultDrug'){
        $drugId = $_REQUEST["drugId"];
        $visitId = $_REQUEST["visitId"];

        //get drug price
        $res1 = $db->query("SELECT price FROM drug WHERE id = ".$drugId);
        $rw = $res1->fetch_assoc();
        $price = $rw['price'];

        $res2 = $db->query("SELECT fee FROM patientvisit WHERE id = ".$visitId);
        $rw1 = $res2->fetch_assoc();
        $fee = $rw1['fee'];
        $fee = $fee + $price;

        $res3 = $db->query("UPDATE patientvisit SET fee = $fee WHERE id = ".$visitId);
        $which = $db->affected_rows;

        if($which > 0)
        {
            $res = $db->query("INSERT INTO patientvisitdrug (patientVisitId, drugId) VALUES ($visitId, $drugId)");
            echo $res;
        }
    }
    
	 
} else {
	$data['state'] = 'Error';
	$data['statusMsg'] = 'Invalid Inputs';
	echo json_encode( $data );

}

exit;
?>