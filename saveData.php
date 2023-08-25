<?php
session_start();

  include("connect.php");
  $sameAppoint  = (rand(000000,999999));
  $eventid =$_POST['event-id'];
  $staffIds = $_POST['staffIds'];
  $startTimeSched = $_POST['startTimeSched'];
  $CheckServId = "SELECT * FROM `schedule_tbl` WHERE schedule_id = '$eventid'";
  $reCheckServId = mysqli_query($con, $CheckServId);
  $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
  $countSched = $rowreCheckServId['scheduledate_count'];
 $sumConsume = 0;

  if($countSched == '6')
  {

    
    $data = array(
    'status'=>'already',
      );
    echo json_encode($data);
  }
  else
  {
    if(isset($_POST['nchild_name2']))
    {      
      $petid1 = $_POST['petid1'];
        $breed1 =$_POST['breed1'];
        $petType1 =$_POST['petType1'];


        $cat1 =$_POST['cat1'];
         $checkBranch  = $_SESSION['branch_idd'];
        $userid =$_POST['userid'];
        $servicesName=$_POST['servicesName1'];  
        $checkbox7=$_POST['servicesName1'];  
        $fsmethod="";
         $fsmethod1="";

         $checkboxSerId=$_POST['cat1'];  
        $checkboxSerIdmethod="";

        $vchild_name = $_POST['nchild_name1'];
        $vchild_kasarian= $_POST['nchild_kasarian1'];
        $vchild_birthday = $_POST['nchild_birthday1'];
         foreach ($vchild_name as $indexs => $vchild_name) 
        {
          
            $new_name = $vchild_name;
            $new_kasarian = $vchild_kasarian[$indexs];
            $petid1 = $petid1[$indexs];
            $new_bday = $vchild_birthday[$indexs];
            $new_servicesName = $servicesName[$indexs];
            $breed1 = $breed1[$indexs];
            $petType1 = $petType1[$indexs];
            $date2 = date("Y/m/d");
            $ts1 = strtotime($new_bday);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            $monthold = $diff." Months";


            // select pet if exist

            $checkPet= "select * from pets where id = '$petid1'";
              $rescheckPet = mysqli_query($con, $checkPet);

            if(mysqli_num_rows($rescheckPet) > 0)
            {
              $pet_id = $petid1;


            }
            else
            {
               $insert_child = $con->query("insert into pets(pet_user_id,pet_name,pet_gender,pet_dob,pet_age,pet_type,pet_breed) values ('$userid','$new_name','$new_kasarian','$new_bday','$monthold','$petType1','$breed1')");
                $pet_id = mysqli_insert_id($con);

            
            }

              


            // end select pet if exist

           

         


          foreach ($checkbox7 as $chk7) {
              $fsmethod .= $chk7 . ",";
          }

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
          


          // Remove the trailing comma
          $fsmethod = rtrim($fsmethod, ',');
           $fsmethod1 = rtrim($fsmethod1, ',');

           $checkboxSerIdmethod = rtrim($checkboxSerIdmethod, ',');

          $insert_services = $con->query("INSERT INTO pet_services_tbl (pet_name_id,pet_service_cat,pet_services_name, pet_services_branchidfk,pet_service_idowner) VALUES ('$pet_id','$sameAppoint', '$fsmethod1','$checkBranch','$userid')");
            $services_id = mysqli_insert_id($con);

          // Explode the $fsmethod string to get an array of services
          $servicesArray = explode(",", $fsmethod);
          $servicesIdArray = explode(",", $checkboxSerIdmethod);

          // Insert each service separately into the database
          foreach ($servicesIdArray as $service) {

            $checkSerName1 = "select * from services_tbl where services_id = '$service'";
              $rescheckSerName1= mysqli_query($con, $checkSerName1);
              $rowcheckSerName1 = mysqli_fetch_assoc($rescheckSerName1);

               $conSume = $rowcheckSerName1['services_tconsume'];
               $sumConsume += $conSume;


     


              $insert_service = $con->query("INSERT INTO pet_services_his_tbl (pet_services_his_servidfk, pet_services_his_name,pet_services_his_amount,pet_services_his_sameappoint,user_petownerid) VALUES ('$services_id', '$service', '0','$sameAppoint','$userid')");
          }



            

        }
        $petid2 = $_POST['petid2'];
        $cat2 =$_POST['cat2'];
         $breed2 =$_POST['breed2'];
        $petType2 =$_POST['petType2'];
         $userid =$_POST['userid'];
        $servicesName=$_POST['servicesName2'];  
        $checkbox7=$_POST['servicesName2'];  
        $fsmethod="";
            $checkboxSerId=$_POST['cat2'];  
        $checkboxSerIdmethod="";

        $fsmethod1="";
        $vchild_name = $_POST['nchild_name2'];
        $vchild_kasarian= $_POST['nchild_kasarian2'];
        $vchild_birthday = $_POST['nchild_birthday2'];
         foreach ($vchild_name as $indexs => $vchild_name) 
        {
         
            $new_name = $vchild_name;
            $petid2 = $petid2[$indexs];

            $new_kasarian = $vchild_kasarian[$indexs];
            $new_bday = $vchild_birthday[$indexs];
            $new_servicesName = $servicesName[$indexs];
            $breed2 = $breed2[$indexs];
            $petType2 = $petType2[$indexs];
            $date2 = date("Y/m/d");
            $ts1 = strtotime($new_bday);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            $monthold = $diff." Months";


            $checkPet= "select * from pets where id = '$petid2'";
              $rescheckPet = mysqli_query($con, $checkPet);

            if(mysqli_num_rows($rescheckPet) > 0)
            {
              $pet_id = $petid2;


            }
            else
            {
                $insert_child = $con->query("insert into pets(pet_user_id,pet_name,pet_gender,pet_dob,pet_age,pet_type,pet_breed) values ('$userid','$new_name','$new_kasarian','$new_bday','$monthold','$petType2','$breed2')");
            $pet_id = mysqli_insert_id($con);


            
            }


            
            foreach ($checkbox7 as $chk7) {
                $fsmethod .= $chk7 . ",";
            }
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
          

            // Remove the trailing comma
            $fsmethod = rtrim($fsmethod, ',');
            $fsmethod1 = rtrim($fsmethod1, ',');


             $checkboxSerIdmethod = rtrim($checkboxSerIdmethod, ',');

           $insert_services = $con->query("INSERT INTO pet_services_tbl (pet_name_id,pet_service_cat,pet_services_name, pet_services_branchidfk,pet_service_idowner) VALUES ('$pet_id','$sameAppoint', '$fsmethod1','$checkBranch','$userid')");
            $services_id = mysqli_insert_id($con);

            // Explode the $fsmethod string to get an array of services
            $servicesArray = explode(",", $fsmethod);
            $servicesIdArray = explode(",", $checkboxSerIdmethod);

            // Insert each service separately into the database
              foreach ($servicesIdArray as $service) {

                $checkSerName1 = "select * from services_tbl where services_id = '$service'";
              $rescheckSerName1= mysqli_query($con, $checkSerName1);
              $rowcheckSerName1 = mysqli_fetch_assoc($rescheckSerName1);

               $conSume = $rowcheckSerName1['services_tconsume'];
               $sumConsume += $conSume;


              $insert_service = $con->query("INSERT INTO pet_services_his_tbl (pet_services_his_servidfk, pet_services_his_name,pet_services_his_amount,pet_services_his_sameappoint,user_petownerid) VALUES ('$services_id', '$service', '0','$sameAppoint','$userid')");
          }
          $minutesToAdd = $sumConsume;

          // insert proof

          $imageName = $_FILES["qrpic"]["name"];
          $tmpName = $_FILES["qrpic"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
             $imageExtension = explode('.', $imageName);

             $name = $imageExtension[0];
              $imageExtension = strtolower(end($imageExtension));

                if (!in_array($imageExtension, $validImageExtension))
                {

                    $data = array(
                    'status'=>'qrnotvalid',
                  
                    );
                     echo json_encode($data);
                
                 }
                 else
                {

                      $newImageName = $name . "-" . uniqid(); // Generate new image name
                      $newImageName .= '.' . $imageExtension;
                      $status ="Not Active";
                      move_uploaded_file($tmpName, 'images/' . $newImageName);
                          $insert_payment = $con->query("INSERT INTO appointment_tbl (appointment_payment_same,appointment_payment_proof,appointment_date,pet_ownerid,appointment_branch) VALUES ('$sameAppoint','$newImageName','$eventid','$userid','$checkBranch')");
                      $sinsert_paymentId = mysqli_insert_id($con);

                     

                      $CheckServId = "SELECT * FROM `schedule_tbl` WHERE schedule_id = '$eventid'";
                      $reCheckServId = mysqli_query($con, $CheckServId);
                      $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
                      $countSched = $rowreCheckServId['scheduledate_count'];

                      $schedCount = $countSched + 1;
                      $startTimeSeconds = strtotime($startTimeSched);

                      $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

            // Convert the end time back to the time format
                    $endTime = date("H:i", $endTimeSeconds);



                      $sqlStaffSched = "INSERT INTO `staff_schedule_tbl`(`staff_idfk`, `appointment_idfk`, `schedule_date_idfk`, `staff_schedule_time`, `staff_schedule_dura`, `staff_schedule_endtime`) VALUES ('$staffIds','$sinsert_paymentId','$eventid','$startTimeSched','$minutesToAdd','$endTime')";

                      $querysqlStaffSched= mysqli_query($con,$sqlStaffSched);
                      $lastIdsqlStaffSched = mysqli_insert_id($con);                     
                      if($insert_payment ==true)
                          {
                 
                          $data = array(
                          'status'=>'true',
                     
                          );

                           echo json_encode($data);
                          }
                      else
                          {
                          $data = array(
                          'status'=>'false',
                    
                          );

                          echo json_encode($data);
                          }    
                      
                     
                 
                  
                  }//end if
            

        }

     



  } // end if dawlang pet
else
{
  // isa lng ang pet
        $breed1 =$_POST['breed1'];
        $petType1 =$_POST['petType1'];


        $cat1 =$_POST['cat1'];
         $checkBranch  = $_SESSION['branch_idd'];
        $userid =$_POST['userid'];
        $servicesName=$_POST['servicesName1'];  
        $checkbox7=$_POST['servicesName1'];  
        $fsmethod="";
         $fsmethod1="";

         $checkboxSerId=$_POST['cat1'];  
        $checkboxSerIdmethod="";

        $vchild_name = $_POST['nchild_name1'];
        $petid1 = $_POST['petid1'];
        $vchild_kasarian= $_POST['nchild_kasarian1'];
        $vchild_birthday = $_POST['nchild_birthday1'];
         foreach ($vchild_name as $indexs => $vchild_name) 
        {
          
            $new_name = $vchild_name;
            $petid1 = $petid1[$indexs];

            $new_kasarian = $vchild_kasarian[$indexs];
            $new_bday = $vchild_birthday[$indexs];
            $new_servicesName = $servicesName[$indexs];
            $breed1 = $breed1[$indexs];
            $petType1 = $petType1[$indexs];
            $date2 = date("Y/m/d");
            $ts1 = strtotime($new_bday);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            $monthold = $diff." Months";


            // select pet if exist

            $checkPet= "select * from pets where id = '$petid1'";
              $rescheckPet = mysqli_query($con, $checkPet);

            if(mysqli_num_rows($rescheckPet) > 0)
            {
              $pet_id = $petid1;


            }
            else
            {
              $insert_child = $con->query("insert into pets(pet_user_id,pet_name,pet_gender,pet_dob,pet_age,pet_type,pet_breed) values ('$userid','$new_name','$new_kasarian','$new_bday','$monthold','$petType1','$breed1')");
              $pet_id = mysqli_insert_id($con);

            
            }

              


            // end select pet if exist

            


          foreach ($checkbox7 as $chk7) {
              $fsmethod .= $chk7 . ",";
          }

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
          


          // Remove the trailing comma
          $fsmethod = rtrim($fsmethod, ',');
           $fsmethod1 = rtrim($fsmethod1, ',');

           $checkboxSerIdmethod = rtrim($checkboxSerIdmethod, ',');

          $insert_services = $con->query("INSERT INTO pet_services_tbl (pet_name_id,pet_service_cat,pet_services_name, pet_services_branchidfk,pet_service_idowner) VALUES ('$pet_id','$sameAppoint', '$fsmethod1','$checkBranch','$userid')");
            $services_id = mysqli_insert_id($con);

          // Explode the $fsmethod string to get an array of services
          $servicesArray = explode(",", $fsmethod);
          $servicesIdArray = explode(",", $checkboxSerIdmethod);

          // Insert each service separately into the database
          foreach ($servicesIdArray as $service) {


          $checkSerName1 = "select * from services_tbl where services_id = '$service'";
              $rescheckSerName1= mysqli_query($con, $checkSerName1);
              $rowcheckSerName1 = mysqli_fetch_assoc($rescheckSerName1);

               $conSume = $rowcheckSerName1['services_tconsume'];
               $sumConsume += $conSume;
     


              $insert_service = $con->query("INSERT INTO pet_services_his_tbl (pet_services_his_servidfk, pet_services_his_name,pet_services_his_amount,pet_services_his_sameappoint,user_petownerid) VALUES ('$services_id', '$service', '0','$sameAppoint','$userid')");
          }
          $minutesToAdd = $sumConsume;

            

        }
     $imageName = $_FILES["qrpic"]["name"];
          $tmpName = $_FILES["qrpic"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
             $imageExtension = explode('.', $imageName);

             $name = $imageExtension[0];
              $imageExtension = strtolower(end($imageExtension));

                if (!in_array($imageExtension, $validImageExtension))
                {

                    $data = array(
                    'status'=>'qrnotvalid',
                  
                    );
                     echo json_encode($data);
                
                 }
                 else
                {

                      $newImageName = $name . "-" . uniqid(); // Generate new image name
                      $newImageName .= '.' . $imageExtension;
                      $status ="Not Active";
                      move_uploaded_file($tmpName, 'images/' . $newImageName);
                      $insert_payment = $con->query("INSERT INTO appointment_tbl (appointment_payment_same,appointment_payment_proof,appointment_date,pet_ownerid,appointment_branch) VALUES ('$sameAppoint','$newImageName','$eventid','$userid','$checkBranch')");
                      $sinsert_paymentId = mysqli_insert_id($con);





                        $CheckServId = "SELECT * FROM `schedule_tbl` WHERE schedule_id = '$eventid'";
                      $reCheckServId = mysqli_query($con, $CheckServId);
                      $rowreCheckServId = mysqli_fetch_assoc($reCheckServId);
                      $countSched = $rowreCheckServId['scheduledate_count'];

                      $schedCount = $countSched + 1;

                      $startTimeSeconds = strtotime($startTimeSched);

                      $endTimeSeconds = $startTimeSeconds + ($minutesToAdd * 60);

            // Convert the end time back to the time format
                    $endTime = date("H:i", $endTimeSeconds);

                       $sqlStaffSched = "INSERT INTO `staff_schedule_tbl`(`staff_idfk`, `appointment_idfk`, `schedule_date_idfk`, `staff_schedule_time`, `staff_schedule_dura`, `staff_schedule_endtime`) VALUES ('$staffIds','$sinsert_paymentId','$eventid','$startTimeSched','$minutesToAdd','$endTime')";

                      $querysqlStaffSched= mysqli_query($con,$sqlStaffSched);
                      $lastIdsqlStaffSched = mysqli_insert_id($con);
                     
                      if($insert_payment ==true)
                          {
                 
                          $data = array(
                          'status'=>'true',
                     
                          );

                           echo json_encode($data);
                          }
                      else
                          {
                          $data = array(
                          'status'=>'false',
                    
                          );

                          echo json_encode($data);
                          }    
                      
                     
                 
                  
                  }//end if


      // end isa lng ang pet

}
  }
       

?>