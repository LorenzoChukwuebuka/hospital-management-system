<?php 

$par = $_REQUEST["par"];
if(!empty($par)) {
    require_once("../../HMSconfig.php");
    if($par === 'All')
    {
        $res = $db->query("SELECT patient.*, patientvisit.dateVisited FROM patient, patientvisit WHERE patient.id = patientvisit.patientId ORDER BY patientvisit.dateVisited DESC, patient.dateReg DESC, patient.firstname, patient.surname, patient.othername LIMIT 1");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
    } elseif($par === 'Single') {
        $id = $_REQUEST["id"];
        $res = $db->query("SELECT patient.id, patient.firstname, patient.surname, patient.othername, patient.occupation, patient.phone, patient.dob, patient.firstname, genotype.genotype, bloodgroup.bloodGroup, address.address, state.state FROM patient, genotype, bloodgroup, address, state WHERE patient.id = ".$id." AND patient.genotypeId = genotype.id AND patient.bloodGroupId = bloodgroup.id AND address.patientId = patient.id AND address.stateId = state.id ");
        $rw = $res->fetch_assoc();

        $res2 = $db->query("SELECT nok.firstname, nok.surname, nok.address, nok.phone, state.state FROM nok, state WHERE nok.patientId = ".$id." AND nok.stateId = state.id");
        $rw2 = $res2->fetch_assoc();

        $res1 = $db->query("SELECT * FROM allergy WHERE patientId = ".$rw['id']);
        $num = $res1->num_rows;
        $tmp = [];
        if($num > 0) {
            while($rw1 = $res1->fetch_assoc())
            {
                $tmp[] = $rw1;
            }
            $data[] = array('basicData' => $rw, 'allergy' => $tmp, 'nok' => $rw2);
            echo json_encode( $data );
        } else {
            $data[] = array('basicData' => $rw, 'allergy' => $tmp, 'nok' => $rw2);
            echo json_encode( $data );
        }
    } elseif($par === 'Edit') {
        $id = $_REQUEST["id"];
        $res = $db->query("SELECT patient.*, address.address, address.stateId as Rstate FROM patient, address WHERE patient.id = ".$id." AND address.patientId = patient.id");
        $rw = $res->fetch_assoc();

        $res2 = $db->query("SELECT nok.* FROM nok WHERE nok.patientId = ".$rw['id']);
        $rw2 = $res2->fetch_assoc();

        $res1 = $db->query("SELECT * FROM allergy WHERE patientId = ".$rw['id']);
        $num = $res1->num_rows;
        if($num > 0) {
            while($rw1 = $res1->fetch_assoc())
            {
                $tmp[] = $rw1;
            }
            $data[] = array('basicData' => $rw, 'allergy' => $tmp, 'nok' => $rw2);
            echo json_encode( $data );
        }
    } elseif($par === 'Update') {
        $id = $_REQUEST["id"];
        $tab = $_REQUEST["table"];
        $col = $_REQUEST["col"];
        $rec = $_REQUEST["rec"];
        $rec1 = $_REQUEST["rec1"];
        
            if($tab === '1')//editing patient table
            {
                if($col === '1')//editing firstname
                {                    
                    $res = $db->query("UPDATE patient SET firstname = '$rec' WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '2'){//editing surname
                    $res = $db->query("UPDATE patient SET surname = '$rec' WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '3'){//editing othername
                    $res = $db->query("UPDATE patient SET othername = '$rec' WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '4'){//editing phonee
                    $res = $db->query("UPDATE patient SET phone = '$rec' WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '7'){//editing ethnic
                    $res = $db->query("UPDATE patient SET ethnicId = $rec WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '5'){//editing bloodG
                    $res = $db->query("UPDATE patient SET bloodGroupId = $rec WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '6'){//editing genotypeId
                    $res = $db->query("UPDATE patient SET genotypeId = $rec WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '8'){//editing dob
                    $res = $db->query("UPDATE patient SET dob = '$rec' WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '9'){//editing stateId
                    $res = $db->query("UPDATE patient SET stateId = $rec WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '10'){//editing occupation
                    $res = $db->query("UPDATE patient SET occupation = '$rec' WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } else {//editing religionId
                    $res = $db->query("UPDATE patient SET religionId = $rec WHERE id = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } 
            } elseif($tab === '2') {//address table
                $res = $db->query("UPDATE address SET address = '$rec', stateId = $rec1 WHERE patientId = ".$id);
                $affect = $db->affected_rows;
                echo $affect;
            } elseif($tab === '3') {//address nok
                //echo $col;
                if($col === '1')//editing nok firstname
                {                    
                    $res = $db->query("UPDATE nok SET firstname = '$rec' WHERE patientId = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '2'){//editing nok surname
                    $res = $db->query("UPDATE nok SET surname = '$rec' WHERE patientId = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '3'){//editing adress
                    $res = $db->query("UPDATE nok SET address = '$rec', stateId = $rec1 WHERE patientId = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } elseif($col === '4'){//editing phone
                    $res = $db->query("UPDATE nok SET phone = '$rec' WHERE patientId = ".$id);
                    $affect = $db->affected_rows;
                    echo $affect;
                } 
            }
        
        
    } elseif($par === 'pRec') {
        $id = $_REQUEST["id"];
        
        $a = 0;
        $res = $db->query("SELECT patientvisit.id as pvId, patientvisit.dateVisited, CONCAT(staff.firstname, ' ',staff.lastname) as staffName, patientvisit.diagnosis, patientvisit.fee, patientvisit.paid, patientvisit.consultancyFee, patientvisit.consultancyFeePaid FROM patientvisit, staff WHERE patientvisit.patientId = ".$id." AND patientvisit.physicianId = staff.id ORDER BY patientvisit.dateVisited DESC");
        $num = $res->num_rows;
        if($num > 0)
        {
            while($rw = $res->fetch_assoc())
            {
                $res2 = $db->query("SELECT surgery.surgery, surgery.surgDate, surgery.notesProg, CONCAT(staff.firstname, ' ',staff.lastname) as surgeon FROM staff, surgery WHERE visitId = ".$rw['pvId']." AND surgery.physicianId = staff.id");
                $num2 = $res2->num_rows;

                if($num2 > 0)//if surgery
                {
                    while($rw2 = $res2->fetch_assoc())
                    {
                        $rw21 = $rw2;
                        $res3 = $db->query("SELECT admitted.dateAdmitted, admitted.dateDischarged, admitted.status, ward.ward FROM admitted, ward WHERE admitted.visitId = ".$rw['pvId']." AND ward.id = admitted.wardId");
                        $num3 = $res3->num_rows;

                        if($num3 > 0)
                        {
                            while($rw3 = $res3->fetch_assoc())
                            {
                                $rw31 = $rw3;
                                $tmp = [];
                                $res1 = $db->query("SELECT drug.drugName, drug.price, patientvisitdrug.paid, patientvisitdrug.issued, patientvisitdrug.id FROM patientvisitdrug, drug WHERE patientvisitdrug.patientVisitId = ".$rw['pvId']." AND patientvisitdrug.drugId = drug.id");
                                $num = $res1->num_rows;
                                if($num > 0) {
                                    while($rw1 = $res1->fetch_assoc())
                                    {
                                        $tmp[] = $rw1;
                                    }
                                    
                                } else {//end of get Drugs
                                    $tmp = NULL;
                                }
                            }//end of get admission
                        } else {
                            $rw31 = NULL;
                            $tmp = [];
                            $res1 = $db->query("SELECT drug.drugName, drug.price, patientvisitdrug.paid, patientvisitdrug.issued, patientvisitdrug.id FROM patientvisitdrug, drug WHERE patientvisitdrug.patientVisitId = ".$rw['pvId']." AND patientvisitdrug.drugId = drug.id");
                            $num = $res1->num_rows;
                            if($num > 0) {
                                while($rw1 = $res1->fetch_assoc())
                                {
                                    $tmp[] = $rw1;
                                }
                                
                            } else {//end of get Drugs
                                $tmp = NULL;
                            }
                        }
                    }//end of get surgeries
                } else {//if no surgery
                    $rw21 = NULL;
                    $res3 = $db->query("SELECT admitted.dateAdmitted, admitted.dateDischarged, admitted.status, ward.ward FROM admitted, ward WHERE admitted.visitId = ".$rw['pvId']." AND ward.id = admitted.wardId");
                    $num3 = $res3->num_rows;

                    if($num3 > 0)//if admission
                    {
                        while($rw3 = $res3->fetch_assoc())
                        {
                            $rw31 = $rw3;
                            $tmp = [];
                            $res1 = $db->query("SELECT drug.drugName, drug.price, patientvisitdrug.paid, patientvisitdrug.issued, patientvisitdrug.id FROM patientvisitdrug, drug WHERE patientvisitdrug.patientVisitId = ".$rw['pvId']." AND patientvisitdrug.drugId = drug.id");
                            $num = $res1->num_rows;
                            if($num > 0) {
                                while($rw1 = $res1->fetch_assoc())
                                {
                                    $tmp[] = $rw1;
                                }
                                
                            } else {//end of get Drugs
                                $tmp = NULL;
                            }
                        }//end of get admission
                    } else {//if no admission
                        $rw31 = NULL;
                        $tmp = [];
                        $res1 = $db->query("SELECT drug.drugName, drug.price, patientvisitdrug.paid, patientvisitdrug.issued, patientvisitdrug.id FROM patientvisitdrug, drug WHERE patientvisitdrug.patientVisitId = ".$rw['pvId']." AND patientvisitdrug.drugId = drug.id");
                        $num = $res1->num_rows;
                        if($num > 0) {
                            while($rw1 = $res1->fetch_assoc())
                            {
                                $tmp[] = $rw1;
                            }
                            
                        } else {//end of get Drugs
                            $tmp = NULL;
                        }
                    }
                }
                $data[$a] = array('visit' => $rw, 'visitNum' => $num, 'drug' => $tmp, 'surgery' => $rw21, 'surgNum' => $num2, 'admitted' => $rw31, 'admitNum' => $num3);
                

                $a++;
            }//end of get visits
            echo json_encode( $data );
        } else {
            $rw = []; $tmp = []; $rw21 = []; $rw31 = [];
            $num = 0; $num2 = 0; $num3 = 0;
            $data[$a] = array('visit' => $rw, 'visitNum' => $num, 'drug' => $tmp, 'surgery' => $rw21, 'surgNum' => $num2, 'admitted' => $rw31, 'admitNum' => $num3);
            echo json_encode( $data );
        }
        
    
    } elseif($par === 'Allergy') {
        $id = $_REQUEST["id"]; 
        $rec = $_REQUEST["rec"];
       
        $res = $db->query("INSERT INTO allergy (allergy, patientId) VALUES ('$rec', $id)");
        echo $res;
    } elseif($par === 'Del') {
        $id = $_REQUEST["id"]; 
        $res = $db->query("DELETE FROM allergy WHERE id =".$id);
        echo $res;
    } elseif($par === 'delPat') {
        $id = $_REQUEST["id"]; 

        //del 4rm patients
        $res = $db->query("DELETE FROM patient WHERE id =".$id);

        //del 4rm admitted
        $res2 = $db->query("DELETE FROM admitted WHERE patientId =".$id);

        //del 4rm nok
        $res2 = $db->query("DELETE FROM nok WHERE patientId =".$id);

        //del 4rm surgery
        $res2 = $db->query("DELETE FROM surgery WHERE patientId =".$id);

        //del 4rm patientVisit
        $res3 = $db->query("SELECT FROM patientvisit WHERE patientId =".$id);
        $num1 = $res3->num_rows;

        if($num1 > 0)
        {
            while($rw = $res3->fetch_assoc())//while(del 4rm patientVisit)
            {
                $visitId = $rw['id'];
                //del 4rm patientVisitCycle
                $res4 = $db->query("DELETE FROM patientvisitcycle WHERE patientVisitId =".$visitId);
                $num4 = $db->affected_rows;
                //del 4rm patientVisitDrug
                $res5 = $db->query("DELETE FROM patientvisitdrug WHERE patientVisitId =".$visitId);
                $num5 = $db->affected_rows;
            }
        } else {
            $res4 = $db->query("DELETE FROM patientvisit WHERE id =".$id);
            $num6 = $db->affected_rows;
        }           
        
    } elseif($par === 'Surg') {
        $id = $_REQUEST["id"];
        $surg = $_REQUEST["surg"]; 
        $note = $_REQUEST["note"];
        $phyId = $_REQUEST["phyId"];

        $res = $db->query("INSERT INTO surgery (visitId, surgery, notesProg, surgDate, physicianId) VALUES ($id, '$surg', '$note', NOW(), $phyId)");
        echo $res;
    } elseif($par === 'Admit') {
        $visitId = $_REQUEST["visitId"];
        $wardId = $_REQUEST["wardId"]; 
        $patId = $_REQUEST["patId"]; 
        $phyId = $_REQUEST["phyId"];

        $res = $db->query("INSERT INTO admitted (patientId, dateAdmitted, physicianId, wardId, visitId) VALUES ($patId, NOW(), $phyId, $wardId, $visitId)");
        echo $res;
    } elseif($par === 'toDoc') {
        $patId = $_REQUEST["patId"];    
        
        $res = $db->query("SELECT * FROM patientvisit WHERE patientvisit.dateVisited =  CURDATE() AND patientId =".$patId);
        $num = $res->num_rows;
        
        if($num > 0)
        {
            $rw = $res->fetch_assoc();
            $id = $rw['id'];

            $res1 = $db->query("SELECT * FROM patientvisitcycle WHERE patientVisitId = ".$id);
            $num1 = $res1->num_rows;

            if($num1 > 0)
            {
                //update
                $res2 = $db->query("UPDATE  patientvisitcycle SET see = 1");
                echo $res2;
            } else {
                $res2 = $db->query("INSERT INTO patientvisitcycle (patientVisitId, see) VALUES ($id, 1)");
                echo $res2;
            }            
            
        } else {
            $res = $db->query("INSERT INTO patientvisit (patientId, dateVisited) VALUES ($patId, NOW())");
            $lastId = $db->insert_id;
            $res2 = $db->query("INSERT INTO patientvisitcycle (patientVisitId, see) VALUES ($lastId, 1)");
            echo $res2;
        }
        
    } elseif($par === 'toPharm') {
        $patId = $_REQUEST["patId"];    
        
        $res = $db->query("SELECT * FROM patientvisit WHERE patientvisit.dateVisited =  CURDATE() AND patientId =".$patId);
        $num = $res->num_rows;
        
        if($num > 0)
        {
            $rw = $res->fetch_assoc();
            $id = $rw['id'];

            $res1 = $db->query("SELECT * FROM patientvisitcycle WHERE patientVisitId = ".$id);
            $num1 = $res1->num_rows;

            if($num1 > 0)
            {
                //update
                $res2 = $db->query("UPDATE  patientvisitcycle SET seePharm = 'Y'");
                echo $res2;
            } else {
                $res2 = $db->query("INSERT INTO patientvisitcycle (patientVisitId, seePharm) VALUES ($id, 'Y')");
                echo $res2;
            }            
            
        } else {
            $res = $db->query("INSERT INTO patientvisit (patientId, dateVisited) VALUES ($patId, NOW())");
            $lastId = $db->insert_id;
            $res2 = $db->query("INSERT INTO patientvisitcycle (patientVisitId, seePharm) VALUES ($lastId, 'Y')");
            echo $res2;
        }
        
    } elseif($par === 'toLab') {
        $patId = $_REQUEST["patId"];    
        
        $res = $db->query("SELECT * FROM patientvisit WHERE patientvisit.dateVisited =  CURDATE() AND patientId =".$patId);
        $num = $res->num_rows;
        
        if($num > 0)
        {
            $rw = $res->fetch_assoc();
            $id = $rw['id'];

            $res1 = $db->query("SELECT * FROM patientvisitcycle WHERE patientVisitId = ".$id);
            $num1 = $res1->num_rows;

            if($num1 > 0)
            {
                //update
                $res2 = $db->query("UPDATE  patientvisitcycle SET seeLab = 'Y'");
                echo $res2;
            } else {
                $res2 = $db->query("INSERT INTO patientvisitcycle (patientVisitId, seeLab) VALUES ($id, 'Y')");
                echo $res2;
            }            
            
        } else {
            $res = $db->query("INSERT INTO patientvisit (patientId, dateVisited) VALUES ($patId, NOW())");
            $lastId = $db->insert_id;
            $res2 = $db->query("INSERT INTO patientvisitcycle (patientVisitId, seeLab) VALUES ($lastId, 'Y')");
            echo $res2;
        }
        
    } elseif($par === 'See') {
        $patId = $_REQUEST["patId"];        
        
        $res = $db->query("SELECT * FROM patientvisit WHERE patientvisit.dateVisited =  CURDATE() AND patientId =".$patId);
        $num = $res->num_rows; 
        if($num > 0) {
            $rw = $res->fetch_assoc();
            $patVistId = $rw['id'];            
            $res1 = $db->query("SELECT * FROM patientvisitcycle WHERE patientVisitId = ".$patVistId);
            $num1 = $res1->num_rows;
            
            if($num1 > 0)
            {
                while($rw1 = $res1->fetch_assoc())
                {
                    $tmp[] = $rw1;
                }
                $data[] = array('nxt' => $tmp, 'seeNum' => $num1);
            } else {
                $data[] = array('seeNum' => $num1);
            }
            
            echo json_encode( $data );
        } else {
            $data[] = array('seeNum' => 0);
            echo json_encode( $data );
        }
    } elseif($par === 'toSee') {
        $res = $db->query("SELECT patient.firstname, patient.surname, patient.othername, patient.phone, patientvisit.id, patientvisitcycle.sentIn FROM patientvisitcycle, patientvisit, patient WHERE patientvisitcycle.patientVisitId = patientvisit.id AND patientvisit.patientId = patient.id AND patientvisitcycle.see = 1 AND patientvisitcycle.seen = 'N'");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        }
        
    } elseif($par === 'receptSendIn') {
        $res = $db->query("SELECT patient.firstname, patient.surname, patient.othername, patient.phone, patientvisit.id, patientvisitcycle.sentToDr FROM patientvisitcycle, patientvisit, patient WHERE patientvisitcycle.patientVisitId = patientvisit.id AND patientvisit.patientId = patient.id AND patientvisitcycle.sentIn = 'Y' AND patientvisitcycle.seen = 'N' AND patientvisitcycle.sentToDr = 'N'");
        $num = $res->num_rows;
        if($num > 0) {
            while($rw = $res->fetch_assoc())
            {
                $data[] = $rw;
            }
            
            echo json_encode( $data );
        } else {
            $data = 2;
            echo json_encode( $data );
        }
        
    } elseif($par === 'receptSentIn') {
        $id = $_REQUEST["id"];
        $res = $db->query("UPDATE patientvisitcycle SET sentToDr = 'Y' WHERE patientVisitId = ".$id);
        $affect = $db->affected_rows;
        echo $affect;
        
    } elseif($par === 'sndIn') {
        $visitId = $_REQUEST["visitId"];
        $res = $db->query("UPDATE patientvisitcycle SET sentIn = 'Y' WHERE patientVisitId = ".$visitId);
        $affect = $db->affected_rows;
        echo $affect;
    } elseif($par === 'payDrug') {
        $patVisitDrugId = $_REQUEST["patVisitDrugId"];
        //$visitId = $_REQUEST["visitId"];
        $price = $_REQUEST["price"];

        $res = $db->query("UPDATE patientvisitdrug SET paid = 'Y' WHERE id = ".$patVisitDrugId);
        $affect = $db->affected_rows;
        if($affect > 0)
        {
            $res1 = $db->query("SELECT patientVisitId FROM patientvisitdrug WHERE id = ".$patVisitDrugId);
            $rw1 = $res1->fetch_assoc();
            $visitId = $rw1['patientVisitId'];
            $res2 = $db->query("SELECT paid FROM patientvisit WHERE id = ".$visitId);
            $rw2 = $res2->fetch_assoc();
            $paid = $rw2['paid'];
            $paid = $paid + $price;

            $res3 = $db->query("UPDATE patientvisit SET  paid = $paid WHERE id = ".$visitId);
            $affect1 = $db->affected_rows;
            echo $affect1;

        }
    } elseif($par === 'delPayDrug') {
        $patVisitDrugId = $_REQUEST["patVisitDrugId"];
        //$visitId = $_REQUEST["visitId"];
        $price = $_REQUEST["price"];

        $res = $db->query("UPDATE patientvisitdrug SET paid = 'N' WHERE id = ".$patVisitDrugId);
        $affect = $db->affected_rows;
        if($affect > 0)
        {
            $res1 = $db->query("SELECT patientVisitId FROM patientvisitdrug WHERE id = ".$patVisitDrugId);
            $rw1 = $res1->fetch_assoc();
            $visitId = $rw1['patientVisitId'];
            $res2 = $db->query("SELECT paid FROM patientvisit WHERE id = ".$visitId);
            $rw2 = $res2->fetch_assoc();
            $paid = $rw2['paid'];
            $paid = $paid - $price;

            $res3 = $db->query("UPDATE patientvisit SET  paid = $paid WHERE id = ".$visitId);
            $affect1 = $db->affected_rows;
            echo $affect1;
        }
    }  elseif($par === 'pat4Drug') {
        $res = $db->query("SELECT patientvisit.id as visitId, patient.firstname, patient.surname, patient.phone FROM patientvisitdrug, patientvisit, patient WHERE patientvisitdrug.paid = 'Y' AND patientvisitdrug.patientVisitId = patientvisit.id AND patientvisit.patientId = patient.id GROUP BY visitId");
        $rw = $res->fetch_assoc();
        $num = $res->num_rows;
        $data = array('pharm' => $rw, 'pharmNum' => $num);
        echo json_encode( $data );
    } elseif($par === 'paidDrug') {
        $visitId = $_REQUEST["visitId"];
        
        $res = $db->query("SELECT patientvisitdrug.*, drug.drugName FROM patientvisitdrug, drug WHERE patientvisitdrug.paid = 'Y' AND patientvisitdrug.issued = 'N' AND patientvisitdrug.patientVisitId = $visitId AND patientvisitdrug.drugId = drug.id");
        $num = $res->num_rows;
        if($num > 0)
        {
            while($rw = $res->fetch_assoc())
            {
                $isDrug[] = $rw;
            }
            $data = array('isDrug' => $isDrug, 'num' => $num);
            echo json_encode( $data );
        } else {
            $data = array('num' => 0);
            echo json_encode( $data );
        }
    } elseif($par === 'issueDrug') {
        $id = $_REQUEST["id"];
        
        $res = $db->query("UPDATE patientvisitdrug SET  issued = 'Y' WHERE id = ".$id);
        $affect = $db->affected_rows;
        echo $affect;
    } elseif($par === 'noIssueDrug') {
        $id = $_REQUEST["id"];
        
        $res = $db->query("UPDATE patientvisitdrug SET  issued = 'N' WHERE id = ".$id);
        $affect = $db->affected_rows;
        echo $affect;
    } elseif($par === 'payConsult') {
        $id = $_REQUEST["id"];
        $price = $_REQUEST["price"];

        $res2 = $db->query("SELECT fee, paid FROM patientvisit WHERE id = ".$id);
        $rw2 = $res2->fetch_assoc();
        $paid = $rw2['paid'];
        $paid = $paid + $price;
        
        //if($paid <= $rw2['fee'])
        //{
            $res = $db->query("UPDATE patientvisit SET  paid = $paid, consultancyFeePaid = 'Y' WHERE id = ".$id);
            $affect = $db->affected_rows;
            echo $affect;
        //}
    } elseif($par === 'delPayConsult') {
        $id = $_REQUEST["id"];
        $price = $_REQUEST["price"];

        $res2 = $db->query("SELECT paid FROM patientvisit WHERE id = ".$id);
        $rw2 = $res2->fetch_assoc();
        $paid = $rw2['paid'];
        $paid = $paid - $price;
        
        $res = $db->query("UPDATE patientvisit SET  paid = $paid, consultancyFeePaid = 'N' WHERE id = ".$id);
        $affect = $db->affected_rows;
        echo $affect;
    }
    
} else {
	$data['state'] = 'Error';
	$data['statusMsg'] = 'Invalid Inputs';
	echo json_encode( $data );

}

exit;
?>