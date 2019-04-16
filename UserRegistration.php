<?php
require "connection.php";

$name=null;
$user_id=null;
$address=null;
$city=null;
$contact_no=null;
$email_id=null; 
$gender=null; 



if($_SERVER['REQUEST_METHOD']=='POST'){
     

 
   	$name= $_POST['name'];   
	$user_id= $_POST['user_id'];
	$address= $_POST['address'];
	$city= $_POST['city'];
	$gender= $_POST['gender'];
	$contact_no= $_POST['contact_no'];
	$email_id= $_POST['email_id'];
}


if($_SERVER['REQUEST_METHOD']=='GET'){
    

	
   	$name= $_GET['name'];   
    $user_id= $_GET['user_id'];
	$address= $_GET['address'];
	$city= $_GET['city'];
	$gender= $_GET['gender'];
	$contact_no= $_GET['contact_no'];
	$email_id= $_GET['email_id'];
}


$todays_date= date('Y-m-d');


         
    $sql = "UPDATE `fh_user` SET `name`='$name',`address`='$address',`city`='$city', `email_id`='$email_id',`gender`='$gender' WHERE `contact_no`='$contact_no' AND `user_id`='$user_id'";
 	$result = $conn->query($sql);


if ($result) {
    
    $sql1 ="SELECT user_id,membership_no,name,address,city,email_id,profile_image,gender FROM fh_user WHERE `user_id`='$user_id' ORDER BY user_id DESC LIMIT 0,1";  
    

$result1 = $conn->query($sql1);
if($result1->num_rows > 0)
{
    
    while($row = $result1->fetch_assoc()) 
   {
	   $user_id=$row['user_id'];
	   $membership_no=$row['membership_no'];
	   $name=$row['name'];
	   $address=$row['address'];
	   $city=$row['city'];
	   $gender=$row['gender'];
	   $email_id=$row['email_id'];
	   $profile_image=$row['profile_image'];
	   
	   
	   
	   
	   	$userDetails=array(
						       "name"=> $name,
						       "membership_no"=> $membership_no,
                               "address"=> $address,
                               "city"=> $city,
                               "gender"=> $gender,
                               "profile_image"=> $profile_image,
                               "email_id"=> $email_id
                                 
								);
			
		
	   
   }
   
   	$response = array("response" =>$userDetails);
		echo json_encode($response);
   
}else
	{
		$response = array("response" => "failure");
		echo json_encode($response);
	}
	  
    
	 	} 
    else {
		$response = array("response" => "failure");
		echo json_encode($response);
	}

     
?>