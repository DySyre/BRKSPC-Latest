<?php 
session_start();
include('../connect.php'); 
include("../assets/libs/enc-dec/enc-dec.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('../assets/libs/email/PHPMailer/Exception.php');
require('../assets/libs/email/PHPMailer/SMTP.php');
require('../assets/libs/email/PHPMailer/PHPMailer.php');

$servicesId = $_POST['selectedValues'];
$custfName = $_POST['custfName'];
$custlName = $_POST['custlName'];
$custeName = $_POST['custeName'];
$petName = $_POST['petName'];
$petBreed = $_POST['petBreed'];
$petType = $_POST['petType'];
$petGender = $_POST['petGender'];
$petBday = $_POST['petBday'];
$staffIds = $_POST['staffIds'];
$startTimeSched = $_POST['startTimeSchedwalk'];
$dateTodayName = $_POST['dateTodayName'];
$SumConsume = 0;
 $fsmethod1="";
$petServices = $_POST['petServices'];
 $checkboxSerId=$_POST['selectedValues']; 

$openTime = strtotime('8:00am');
$closeTime = strtotime('5:00pm');

// count consume
foreach ($servicesId as $value) {
 
    $CheckcatId = "SELECT * FROM `services_tbl` WHERE services_id = '$value'";
  	$reCheckcatId = mysqli_query($con, $CheckcatId);
	$rowreCheckcatId = mysqli_fetch_assoc($reCheckcatId);
	$SumConsume += $rowreCheckcatId['services_tconsume'];
   
}

 $minutesToAdd = $SumConsume;
// end count consume

$notAvailableTimeSlots = array();
$query2 = "select * from staff_schedule_tbl where schedule_date_idfk = '$dateTodayName' AND staff_idfk = '$staffIds'";
$result2 = mysqli_query($con, $query2);

if(mysqli_num_rows($result2) > 0)
{ // if start


	while ($RowschedData = mysqli_fetch_assoc($result2)) 
	{
	    $startTime = strtotime($RowschedData['staff_schedule_time']);
	    $endTime = strtotime($RowschedData['staff_schedule_endtime']);

	    $formattedStartTime = date("H:i", $startTime);
	    $formattedEndTime = date("H:i", $endTime);

	    $notAvailableTimeSlots[] = $formattedStartTime . ' - ' . $formattedEndTime;
	}

	// Output the not available time slots
	foreach ($notAvailableTimeSlots as $timeSlot) 
	{

		$timeSlotParts = explode(' - ', $timeSlot);
		$startTimeSlot = $timeSlotParts[0];
		$endTimeSlot = $timeSlotParts[1];



		  if ($startTimeSched >= $startTimeSlot && $startTimeSched <= $endTimeSlot) 
		  {
		      

		        $occupied = 1;
		        $occ[] = $occupied;
		  }
		  else
		  {
		        $occupied = 2;
		        $occ[] = $occupied;

		  }

	  



	}
	sort($occ);
	foreach ($occ as $timeSlots)
		{
		    if (strpos($timeSlots, '1') !== false) 
		    {
		        $data = array(
		            'status'=>'occupied',    
		        );
		        echo json_encode($data);
		        break; // Stop the loop when encountering the first number containing the digit 1
		    }
		    else
		    {
		    	$startTimeSeconds = strtotime($startTimeSched);

    		  // Add the minutes in seconds to the start time
			      $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

			      // Convert the end time back to the time format
			      $endTime = date("H:i", $endTimeSeconds);

			       foreach ($notAvailableTimeSlots as $timeSlotd) 
			        {

			        $timeSlotParts = explode(' - ', $timeSlotd);
			        $startTimeSlot = $timeSlotParts[0];
			        $endTimeSlot = $timeSlotParts[1];
			      
			          if ($endTime >= $startTimeSlot && $endTime <= $endTimeSlot) 
			          {  

			                $occupieds = 1;
			                $occs[] = $occupieds;

			          }
			          else if($endTime > $closeTime)
			          {
			              $occupieds = 1;
			                $occs[] = $occupieds;
			          }
			          else
			          {
			            $occupieds = 2;
			            $occs[] = $occupieds;

			          }

			          



			        }
			        sort($occs);
			        foreach ($occs as $timeSlotf)
			        {
			          if (strpos($timeSlotf, '1') !== false) 
			            {
			                $data = array(
			                    'status'=>'occupieds',    
			                );
			                echo json_encode($data);
			                break; // Stop the loop when encountering the first number containing the digit 1
			            }
			            else
			            {
			            	//kung walang date appoint now edi gagawa mag iinsert nlng
			            	
			            	


			              //kung walang date appoint now edi gagawa mag iinsert nlng
			            }

			        }
			         break;
		    }
		}





} // if stop
else
{// else start

$startTimeSeconds = strtotime($startTimeSched);

						      // Add the minutes in seconds to the start time
						    $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

						      // Convert the end time back to the time format
						    $endTime = date("H:i:s", $endTimeSeconds);


						    //start insert

						   

							      $user_id = (rand(0000000000,9999999999));

							      $query2 = "select * from users_balagtas where user_id = '$user_id'";
								  $result2 = mysqli_query($con, $query2);
									if (mysqli_num_rows($result2) > 0) 
										{

											// code...

											$user_id = (rand(0000000000,9999999999));
										}
									$password = (rand(0000000000,9999999999));

									$query21 = "select * from users_balagtas where email = '$custeName'";
									$result21 = mysqli_query($con, $query21);
									if (mysqli_num_rows($result21) > 0) 
								  {

								  	// code...
								  	$rowId = mysqli_fetch_assoc($result21);

								  	$idAccount = $rowId['user_id'];
									$data = array(
					                    'status'=>'same',    
					                );
					                echo json_encode($data);
					             



								  	
								  }
								  else
								  {
									  	$sq1l = "INSERT INTO `users_balagtas`(`user_id`, `email`, `user_name`, `last_name`, `password`) VALUES ('$user_id','$custeName','$custfName','$custlName','$password')";

									    $query1= mysqli_query($con,$sq1l);
									    $lastIdquery1= mysqli_insert_id($con);



									     

									    $new_bday = $petBday;
									     $date2 = date("Y/m/d");
							            $ts1 = strtotime($new_bday);
							            $ts2 = strtotime($date2);

							            $year1 = date('Y', $ts1);
							            $year2 = date('Y', $ts2);
							            $month1 = date('m', $ts1);
							            $month2 = date('m', $ts2);
							            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
							            $monthold = $diff." Months";

									    $petInsert = "INSERT INTO `pets`(`pet_user_id`, `pet_name`, `pet_gender`, `pet_dob`, `pet_age`,`pet_type`,`pet_breed`) VALUES ('$lastIdquery1','$petName','$petGender','$petBday','$monthold','$petType','$petBreed')";

									    $querypetInsert= mysqli_query($con,$petInsert);
									    $pet_id= mysqli_insert_id($con);

									    $sameAppoint = $pet_id+1;

									    // find staff branch
									  	$findStaf21 = "select * from staff_tbl where staff_id = '$staffIds'";
									    $resultfindStaf21 = mysqli_query($con, $findStaf21);
									    $rowStaff = mysqli_fetch_assoc($resultfindStaf21);
									    $staffBranch = $rowStaff['staff_branch'];


									    

									    
       									$checkboxSerIdmethod="";

									    foreach ($checkboxSerId as $chk8) {
								            $checkboxSerIdmethod .= $chk8 . ",";

								            
								          }

									    foreach ($checkboxSerId as $chk9) {
            

								              $checkSerName = "select * from services_tbl where services_id = '$chk9'";
								              $rescheckSerName= mysqli_query($con, $checkSerName);
								              $rowcheckSerName = mysqli_fetch_assoc($rescheckSerName);
								              $SerName = $rowcheckSerName['services_name'];

								              $fsmethod1 .= $SerName . ",";
								         }



										
										$fsmethod1 = rtrim($fsmethod1, ',');

									     $insert_services = $con->query("INSERT INTO pet_services_tbl (pet_name_id,pet_service_cat,pet_services_name, pet_services_branchidfk,pet_service_idowner) VALUES ('$pet_id','$sameAppoint', '$fsmethod1','$staffBranch','$lastIdquery1')");
            							$services_id = mysqli_insert_id($con);

            							 $checkboxSerIdmethod = rtrim($checkboxSerIdmethod, ',');

            							$servicesIdArray = explode(",", $checkboxSerIdmethod);

            							// Insert each service separately into the database
							              foreach ($servicesIdArray as $service) 
							              {
							              $insert_service = $con->query("INSERT INTO pet_services_his_tbl (pet_services_his_servidfk, pet_services_his_name,pet_services_his_amount,pet_services_his_sameappoint,user_petownerid) VALUES ('$services_id', '$service', '0','$sameAppoint','$lastIdquery1')");
							          		}


							          		$insert_payment = $con->query("INSERT INTO appointment_tbl (appointment_payment_same,appointment_payment_proof,appointment_date,appointment_payment_status,pet_ownerid,appointment_branch) VALUES ('$sameAppoint','Walkin','$dateTodayName','approved','$lastIdquery1','$staffBranch')");
                      					$sinsert_paymentId = mysqli_insert_id($con);


                      					$sqlStaffSched = "INSERT INTO `staff_schedule_tbl`(`staff_idfk`, `appointment_idfk`, `schedule_date_idfk`, `staff_schedule_time`, `staff_schedule_dura`, `staff_schedule_endtime`) VALUES ('$staffIds','$sinsert_paymentId','$dateTodayName','$startTimeSched','$minutesToAdd','$endTime')";

								      $querysqlStaffSched= mysqli_query($con,$sqlStaffSched);
								      $lastIdsqlStaffSched = mysqli_insert_id($con);


									    if ($insert_payment === TRUE)
								    	{

									    	$mail = new PHPMailer(true);
											$email = $custeName;
									        try 
									        {
									            //Server settings
									            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
									            $mail->isSMTP();
									            $mail->Host       = 'smtp.gmail.com';
									            $mail->SMTPAuth   = true;
									            $mail->Username   = 'barkspace2020@gmail.com';
									            $mail->Password   = 'gwarcvkvajmhrdwx';
									            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
									            $mail->Port       = 465;
									        
									            //Recipients
									            $mail->setFrom('barkspace2020@gmail.com', 'barkspace Account');
									            $mail->addAddress($email);
									            //Content
									            $mail->isHTML(true);
									            $mail->Subject = 'Account has been create';
									            $message = '<html>
									            <head>
									              <style>
									                .pymntRow{
									                  border-radius: 10px;
									                  border: 1px solid lightgray;
									                  padding-top: 20px;
									                  padding-left: 10px;
									                  padding-right: 10px;
									                  padding-bottom: 20px;
									                }.pymntLabel{
									                  color:gray;
									                  font-size: 12px;
									                  text-align: center;
									                  font-weight: bold;
									                  padding-top: 3px;
									                  padding-bottom: 3px;
									                  padding-left:10px;
									                }
									                .pymntVal{
									                  color:black;
									                  font-size: 14px;
									                  text-align: left;
									                  font-weight: bold;
									                  padding-top: 3px;
									                  padding-bottom: 3px;
									                }
									                .pymntSchedRow{
									                  border-top: 1px solid lightgray;
									                  padding-top: 10px;
									                }
									                .pymntLabelFee{
									                  color:gray;
									                  font-size: 20px;
									                  text-align: center;
									                  font-weight: bold;
									                }
									                .pymntValFee{
									                  color:black;
									                  font-size: 20px;
									                  text-align: left;
									                  font-weight: bold;
									                }
									                .pymntImg{
									                  width: 100px;
									                  height: 100px;
									                }
									              </style>
									            </head>
									            <body>';
									            $message .= '<div class="row pymntRow">';
									         

									         
									            $message .= '<label class="pymntLabel">EMAIL: </label>';
									            $message .= '<label class="pymntVal">'.$email.'</label><br/>';
									             $message .= '<label class="pymntLabel">PASSWORD: </label>';
									            $message .= '<label class="pymntVal">'.$password.'</label><br/>';
									            $message .= '<br/><br/>';
									            $message .= '<div class="row" align="center">';
									            $message .= '</div>';
									            $message .= '</div>';
									            $message .= '</div>';
									            $message .= "</body></html>";
									                      
									            $mail->Body = $message;

									          

									            $mail->send();



									            
									                $data = array(
									            'status'=>'true',    
									        );
									        echo json_encode($data);
									          
									        } 
									        catch (Exception $e) 
									        {
									          $enc2 = encrypt($random,"");
									          header("location: index.php?error=$enc2");
									        }

								        
										}
									    else
									    {
									    	 $data = array(
									                  'status'=>'false',    
									              );
									              echo json_encode($data);
									    }
									}


						    //end insert


						    foreach ($servicesId as $value)
						     {
							    // Prepare and execute the SQL query to insert the selected value
							    $sql = "INSERT INTO `sample_tbl`(`sample_services`, `fname`, `lname`, `email`, `petname`, `breed`, `petype`, `gender`, `bday`, `dateToday`, `staff`, `time`,`duration`,`endtime`) VALUES ('$value','$custfName','$custlName','$custeName','$petName','$petBreed','$petType','$petGender','$petBday','$dateTodayName','$staffIds','$startTimeSched','$minutesToAdd','$endTime')";

							     $query= mysqli_query($con,$sql);

								  

								  
									// end if same email


 
							}


							 


			              



}// else stop

// Loop through the selected values and insert them into the database



?>