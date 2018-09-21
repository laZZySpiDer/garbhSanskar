<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'init.php';
  showData();
}

function showData(){
  global $connect;
  header('Content-Type:bitmap; charset=utf-8');
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $password = sha1($_POST["password"]);
  $mobile_number = $_POST["mobile_number"];
  $city_name = $_POST["city_name"];
  $state_name = $_POST["state_name"];
  $country_name = $_POST["country_name"];
  $gender = $_POST["gender"];
  $section_type = $_POST["section_type"];
  $profile_pic = $_POST["profile_pic"];

  $decoded_string = base64_decode($profile_pic);
  $imgName = $firstname.$lastname.".jpg";
  $path = 'upload_profile/'.$imgName;
  $file = fopen($path,'wb');
  $is_written = fwrite($file, $decoded_string);
  fclose($file);

  if($is_written > 0){

    $insertQuery = "insert into userData(email,password,firstname,lastname,mobile_number,
    city_name,state_name,country_name,gender,section_type,profile_pic) values ('$email','$password','$firstname',
    '$lastname','$mobile_number','$city_name','$state_name','$country_name','$gender','$section_type','$imgName')";
    $result = mysqli_query($connect,$insertQuery);
    
    // if writing of image to server is successful
    $key = array('status','message');
    $value = array('200','Registration successfull');
    

  }else{
    //if writing of image to server fails
    $key = array('status','message');
    $value = array('402','Cannot upload image to server');
    

  }
    $final_array = array_combine($key,$value);
    echo json_encode($final_array);
  
}


 ?>
