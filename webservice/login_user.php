<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'init.php';
    showData();
}

function showData()
{
    global $connect;

    $email = $_POST["email"];
    $password = sha1($_POST["password"]);
        $device_type = $_POST["device_type"];
    $device_id = $_POST["device_id"];
    $fcm_id = "";
    $ios_id = "";
    if ($device_type == "Android") {
        $fcm_id = $_POST["fcm_id"];
    } else {
        $ios_id = $_POST["ios_id"];
    }

    $login_status = $_POST["login_status"];

    $query = "select user_id,login_status,firstname,lastname,profile_pic from userData where email='$email' AND password='$password'";
    $queryResult = mysqli_query($connect, $query);
    $temprow = mysqli_fetch_assoc($queryResult);

    if ($queryResult) {
        if ($queryResult->num_rows === 0) {
            //where no record is found
            $key = array('status','message');
            $value = array('404','User not Found');
                  
        } else {
            //record found
            $login_status_DB = $temprow['login_status'];
            if($login_status_DB == "No"){
                
                //login allowed
                $user_id = $temprow['user_id'];
                $firstname = $temprow['firstname'];
                $lastname = $temprow['lastname'];
                $profile_pic = "http://localhost/gs/webservice/upload_profile/".$temprow['profile_pic'];
                $key = array('user_id','firstname','lastname','profile_pic','status','message');
                $value = array($user_id,$firstname,$lastname,$profile_pic,'200','User Found');
                $query = "update userData SET login_status='Yes' WHERE user_id = $user_id";
                $updateQueryResult = mysqli_query($connect,$query);

            }else{
                
                //login not allowed coz of logged in from other devices
                $key = array('status','message');
                $value = array('403','Log Out from other devices');
            
            }
            
        }
    }else{
        //connection to database is failed
        $key = array('status','message');
        $value = array('400','Access Denied');
    }
  
    $final_array = array_combine($key,$value);
    // header('Content-Type:Application/json');
    echo json_encode($final_array);

}
