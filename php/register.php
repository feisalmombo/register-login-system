<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
  $name = mysqli_real_escape_string($mysqli, trim($request->name));
  $pwd = mysqli_real_escape_string($mysqli, (int)$request->pwd);
  $email = mysqli_real_escape_string($mysqli, trim($request->email));
  $sql = "INSERT INTO users(name,password,email) VALUES ('{$name}','{$pwd}','{$email}')";
 // echo $sql;
if ($mysqli->query($sql) === TRUE) {


    $authdata = [
    'name' => $name,
	  'pwd' => '',
	  'email' => $email,
    'Id'    => mysqli_insert_id($mysqli)
    ];
    echo json_encode($authdata);
  }
  }
?>
