<?php
session_start();
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$conn = mysqli_connect("localhost", "root", "", "logindetails");

login();

$result = array("status"=>"", "message"=>"", "data"=>"");

function login(){
  global $conn, $redis;

  $username = $_POST["username"];
  $password = $_POST["password"];

  $stmt = mysqli_prepare($conn, "SELECT * FROM tb_user WHERE username = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $user = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($user) > 0){
    $row = mysqli_fetch_assoc($user);
    if($password == $row['password']){
      $result["status"] = "success";
      $result["message"] = "Login Successfull";
      $result["data"] = $row;
      echo json_encode($result);

      $_SESSION["login"] = true;

      $sessionId = session_id();
      $redis->set($sessionId, json_encode($_SESSION));
      $redis->expire($sessionId, 3600);

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

    $result["status"] = "error";
    $result["message"] = "User not registered";
    echo json_encode($result);
    exit;
  }
}
?> 

