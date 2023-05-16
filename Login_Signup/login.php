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
                header("Location: ../User_Skill_Post/index_user.php");
                exit;
            }else{
                header("Location: ../Comp_info/index_comp.php");
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
    <link rel="stylesheet" href="../Main_Pages/styles2.css">
    <link rel="stylesheet" href="../Main_Pages/footer.css">
    <link rel="stylesheet" href="style-form.css">

</head>
<body>
    
    <nav>
        <div id='logo'>
            <a href="#">LOGO</a>
        </div>
        <div id='links'>
            <ul>
                <!-- <li><a href="../Login_Signup/login.php" class='hover-link'>Login</a></li> -->
                <li><a href="#" class='hover-link'>Contact us</a></li>
            </ul>
        </div>
    </nav>   
    <main>
        <h1>Login</h1>

        <form method="POST" class=my-form>
            <div>
                <label>Username: </label>
                <input type="text" name="uname" required>
            </div>
            <div>
                <label>Password: </label>
                <input type="password" name="upassword" required>
            </div>
            <div>
                <input type="submit" value='Login'>
            </div>

        </form>

        <p id="some">New User? <a href="signup.htm">Signup Now</a></p>
    </main>

    <footer class="footer1">
        <div class="container2">
            <div class="footer-content">
                <p>&copy; 2023 Placement Cell Company. All rights reserved</p>
                <a href="../contact.html">Contact Us</a>
                <a href="../about.html">About Us</a>
                <span id="last-l">Made with &#x2665;</span>
            </div>
        </div>
    </footer>
    

</body>
</html>
