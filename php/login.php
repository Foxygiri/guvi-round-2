<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "login");

// print_r($conn);
// exit;
if(isset($_POST["action"])){
   if($_POST["action"] == "login"){
    login();
  }
}

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
      echo "Login Successful";
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      exit;
    }
    else{
      echo "Wrong Password";
      exit;
    }
  }
  else{
    echo "User Not Registered";
    exit;
  }
}
?> 