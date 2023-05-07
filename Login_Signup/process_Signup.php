<?php

// if(strlen($_POST['password'])<8){
//     die("Password must be atleast 8 characters long");
// }

// if($_POST["password"]!=$_POST["con_pass"]){
//     die("Passwords does not match");
// }

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$mysqli = require __DIR__."/database.php";

$sql = "INSERT INTO user_info (uname,pass,email,user_type)
        VALUES (?,?,?,?)";

$stmt=$mysqli->stmt_init();
echo($_POST["utype"]);

if(! $stmt->prepare($sql)){
    echo("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["uname"],
                  $password_hash,
                  $_POST["email"],
                $_POST["utype"]);


                   
if($stmt->execute()){
    header("Location: signup_success.html");
    exit;
}else{
    die($mysqli->error." ". $mysqli->errno);
}

// $result=$stmt->get_result();

