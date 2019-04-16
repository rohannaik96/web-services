<?php
require "connection.php";
$userDetails = array();


$contact_no = null;  //as a username
$otp_number = null; // as a password
$fcm_id = null;
$device_type = null;
$version_code=null;
$version_name=null;


if($_SERVER['REQUEST_METHOD']=='POST'){
	
	
	$contact_no = $_POST['contact_no'];
	$otp_number = $_POST['otp_number'];
	$fcm_id = $_POST['fcm_id'];
	$device_type = $_POST['device_type'];
	$version_code= $_POST['version_code'];
	$version_name= $_POST['version_name'];
}


if($_SERVER['REQUEST_METHOD']=='GET')
{
	    $contact_no = $_GET['contact_no'];
	    $otp_number = $_GET['otp_number'];
        $fcm_id = $_GET['fcm_id'];
        $device_type = $_GET['device_type'];
        $version_code= $_GET['version_code'];
        $version_name= $_GET['version_name'];

}

	
//To Get Todays date
	$Todays_date= date('Y-m-d');
	
	//update fcm id
	$sql = "UPDATE `fh_user` SET `fcm_id`='$fcm_id',`device_type`='$device_type',`version_code`='$version_code', `version_name`='$version_name' WHERE `contact_no`='$contact_no' AND `otp_number`='$otp_number'";
	
	$result = $conn->query($sql);
	
	 
	 	$sql12 = "SELECT `user_id`,`membership_no`,`contact_no`, `fcm_id`,`regi_date`, `disable_flag`,`name`,`address`,`city`,`email_id`,`profile_image` FROM `fh_user` WHERE contact_no='$contact_no' AND otp_number='$otp_number' AND disable_flag ='0'";
	 
	$result12 = $conn->query($sql12);
	if ($result12->num_rows > 0) 
	{
	
				// output data of each row
				while($row = $result12->fetch_assoc()) 
				{
				        $user_id= $row['user_id'];
				        $membership_no= $row['membership_no'];
				        $contact_no1 = $row['contact_no'];
				        $regi_date1 = $row['regi_date'];
				        $fcm_id1 = $row['fcm_id'];
				        $disable_flag = $row['disable_flag'];
				        $name = $row['name'];
				        $address = $row['address'];
				        $city = $row['city'];
				        $email_id = $row['email_id'];
				        $profile_image = $row['profile_image'];
				        $gender = $row['gender'];
				        
				        
				      
				       
				        
				         if($contact_no1==NULL || $contact_no1==null)
				        {
				            $contact_no="-";
				        } else
				        {
				             $contact_no=$contact_no1;
				        }
						
					
					
				          if($regi_date1==NULL || $regi_date1==null)
				        {
				            $regi_date="-";
				        } else
				        {
				             $regi_date=$regi_date1;
				        }
						
				        
				        if($fcm_id1==NULL || $fcm_id1==null)
				        {
				            $fcm_id="-";
				        } else
				        {
				            $fcm_id=$fcm_id1;
				        }
				        
				        
				          
				        
			                     $userDetails=array(
								 "user_id"=> $user_id,
								 "membership_no"=> $membership_no,
							     "contact_no"=> $contact_no,
                               "regi_date"=> $regi_date,
                               "fcm_id"=> $fcm_id,
                               "name"=> $name,
                               "address"=> $address,
                               "city"=> $city,
                               "gender"=> $gender,
                               "email_id"=> $email_id,
                               "profile_image"=> $profile_image,
                                 "disable_flag"=> $disable_flag
								);
	
		        }
		
		$response = array("response" => $userDetails);
		echo json_encode($response);
		
	}
	else
	{
		$response = array("response" => "failure");
		echo json_encode($response);
	}
	
	
	
?>