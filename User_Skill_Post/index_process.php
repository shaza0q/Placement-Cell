<?php

$mysqli=require __DIR__."/database.php";

session_start();


$_SESSION["user_id"];

$sql1="INSERT INTO user_data (id,skill1,skill2,skill3)
    values (?,?,?,?)";


$stmt= $mysqli->prepare($sql1);


if(! $stmt->prepare($sql1)){
        die("SQL error: ". $mysqli->error);
    }

$stmt->bind_param("isss",
                $_SESSION["user_id"],
                $_POST["skill1"],
                $_POST["skill2"],
                $_POST["skill3"]);

                
if(mysqli_stmt_execute($stmt)){
    echo("Updated Successfully");
    header("Location: index.php");
}



