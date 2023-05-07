<?php


if($_SERVER["REQUEST_METHOD"]=== "POST"){
    $mysqli = require __DIR__ . "/database.php";

    $sql=sprintf("SELECT * FROM user_info
                WHERE uname = '%s'",
                $mysqli->real_escape_string($_POST["uname"]));

    $result=$mysqli->query($sql);

    $user=$result->fetch_assoc();

    if($user){
        if(password_verify($_POST["upassword"], $user["pass"])){
            // // var_dump($user);
            // echo ("Welcome ".$_POST['uname']." user_type: ".$user['user_type']);
            // die ("Login Successfull");

            session_start();
            session_regenerate_id();


            $_SESSION["user_id"]=$user["id"];
            if($user["user_type"]=="user"){
                header("Location: User_Skill_Post/index_user.php");
                exit;
            }else{
                header("Location: Comp_info/index_comp.php");
                exit;
            }

            

        }
        else{
            echo ("Password incorrect");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Placement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Login</h1>

    <form method="POST">
        <div>
            <label>Username: </label>
            <input type="text" name="uname" required>
        </div>
        <div>
            <label>PAssword: </label>
            <input type="password" name="upassword" required>
        </div>
        <div>
            <button>Login</button>
        </div>

    </form>

</body>
</html>