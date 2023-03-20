<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "logindetails");
// print_r($conn);
// exit;
// echo $_POST["action"];
// if(isset($_POST["action"])){
//    if($_POST["action"] == "login"){
//     // return "sas"
//     echo "login";
//     login();
//   }
// }
login();

$result = array("status"=>"", "message"=>"", "data"=>"");

// $result["status"]
function login(){
  global $conn;

  $username = $_POST["username"];
  $password = $_POST["password"];

  $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
  //print_r($user);
  if(mysqli_num_rows($user) > 0){

    $row = mysqli_fetch_assoc($user);
   // print_r($row);
    if($password == $row['password']){
      $result["status"] = "success";
      $result["message"] = "Login Successfull";
      $result["data"] = $row;
      echo json_encode($result);


      // echo json_encode($user);
      $_SESSION["login"] = true;
      exit;
    }
    else{
      $result["status"] = "error";
      $result["message"] = "Wrong password";
      echo json_encode($result);
      exit;
    }
  }
  else{
    // echo "User Not Registered";
    $result["status"] = "error";
    $result["message"] = "User not registered";
    echo json_encode($result);
    exit;
  }
}
?> 