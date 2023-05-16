<?php

session_start();

$mysqli = require __DIR__ . "\..\database.php";

if (isset($_SESSION["companyId"])) {

    $sql = "SELECT * FROM comp_data
        WHERE id= {$_SESSION["companyId"]}";

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

    <div class="container">
        <p><b>Main field of work: </b><?php echo $user['cwork']?></p>
        <p><b>Company description: </b><?php echo $user['cdesc']?></p>
        <p><b>Main field of work: </b><?php echo $user['cwork']?></p>
        <img src=
    </div>


</body>
</html>