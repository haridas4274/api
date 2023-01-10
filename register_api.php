<?php
// get throw json formate:
// json_decode(file_get_contents("php://input"));

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$db=new mysqli("localhost","root","","users");
// print_r($_POST);

$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['password'];

$data[]=array();
$validate="SELECT * FROM `users_list` WHERE `email`='$email'";
$result=$db->query($validate);

if($result->num_rows==0){
    $sql="INSERT INTO `users_list` (`name`,`email`,`phone`,`password`) VALUES ('$name',$email','$phone','$password')";
    $insert=$db->query($sql);
    $data[]=array("email"=>$email,"name"=>$name);
    $resposnse=array("status"=>true,"msg"=>"succesfully registered","data"=>$data);
    echo json_encode($resposnse);
}else{
    $resposnse=array("status"=>false,"msg"=>"This email is already registered","data"=>$data);
    echo json_encode($resposnse);
}


?>