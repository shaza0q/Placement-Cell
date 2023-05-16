<?php


session_start();

$mysqli = require __DIR__ . "\..\database.php";


if (isset($_SESSION["user_id"])) {

    $sql = "SELECT * FROM user_info
        WHERE id= {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Index</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="stylesheet" href="footer.css">
    <style>
        h3{
            margin: 20px;
            color:white;
            font-size: 7rem;
        }

        .Notice {
            width: 300px;
            background: rgba(255,255,255,0.5);
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            margin-left: 20px;
        }

        p {
            color: rgb(120, 24, 104);
            font-size: 18px;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <nav>
        <div id='logo'>
            <a href="#">LOGO</a>
        </div>
        <div id='links'>
            <ul>
                <li><a href="../Login_Signup/logout.php" class='hover-link'>Logout</a></li>
                <li><a href="#" class='hover-link'>Contact us</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h3>Thank you, <br><?php echo ($user['uname'])?></h3>
        <div class="card">
            <p>Thank you for Posting your job vacanices on our Website, It would help a lot of students that are looking for a job right now through us.</p>
            <p>The candidates will be able to apply through the email you have provided us</p>
            <p>Regards, Placement Team &#x2665;</p>
        </div>
    </div>

    <footer class="footer">
        <div class="container2">
            <div class="footer-content">
                <p>&copy; 2023 Placement Cell Company. All rights reserved</p>
                <a href="../contact.html">Contact</a>
                <a href="../about.html">About Us</a>
                <span id="last-l">Made with &#x2665;</span>
            </div>
        </div>
    </footer>

</body>
</html>