<?php

session_start();

$mysqli = require __DIR__ . "\..\database.php";

if (isset($_SESSION["companyId"])) {

    $sql = "SELECT * FROM comp_data
        WHERE id= {$_SESSION["companyId"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

}

$sql1 =  "SELECT * FROM job_post
WHERE id= {$_SESSION["companyId"]}";

$result1 = $mysqli->query($sql1);
$user1 = $result1->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Index</title>
    <style>
        .logo{
            margin:20px;
        }

        #logo_card{
            border-radius: 50%;
        }

        .content{
            display: flex;
            flex-direction: column;
        }

    </style>
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="styles2.css">
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
    <h2>Profile: <?php echo ($user["cname"])?></h2>

    <div class='container'>
        <div class="card">
            <div class="logo">
                <img src="../Comp_Logo_Uploads/<?= htmlspecialchars($user['comp_logo'])?>" id="logo_card">
            </div>

            <div class="content">
                <p><b>Main field of work: </b><?php echo $user['cwork']?></p>

                <p><b>Company description: </b><?php echo $user['cdesc']?></p>
                
                <p><b>Job Post: </b><?php echo $user1['jpost']?></p>

                <p><b>Current Job vacancies:</b>
                <?php echo $user1['nvacan']?>
                </p>

                <a href="#" class="button">Click Me</a>
            </div>

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