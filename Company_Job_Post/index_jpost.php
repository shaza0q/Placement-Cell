<?php

session_start();

// echo date("d/m/Y")."<br>";

$mysqli=require __DIR__."\..\database.php";

if(isset($_SESSION["user_id"])){

    $sql="SELECT * FROM comp_data
    WHERE id={$_SESSION["user_id"]}";

    $result= $mysqli->query($sql);
    $user=$result->fetch_assoc();

    
    $sql1="SELECT * FROM job_post
    WHERE id={$_SESSION["user_id"]}";

    $result1= $mysqli->query($sql1);
    $user1=$result1->fetch_assoc();

}

if($_SERVER["REQUEST_METHOD"]==="POST"){

    $sql="INSERT INTO job_post (id, name, jpost, nvacan, jskills, jdesc, jtime) VALUES (?,?,?,?,?,?,?)";

    $stmt=$mysqli->stmt_init();

    if(! $stmt->prepare($sql)){
        echo("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("ississi",
    $user["id"], $user["cname"], $_POST["jpost"], $_POST["nvacan"], $_POST["jskills"], $_POST["jdesc"], $_POST["jtime"]);

    if ($stmt->execute()) {
        header("Location: ../Main_Pages/comp_index1.php");

    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company data Updates</title>
    <link rel="stylesheet" href="../Main_Pages/styles2.css">
    <link rel="stylesheet" href="../Main_Pages/footer.css">
    <link rel="stylesheet" href="../Login_Signup/style-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #heading{
            display: flex;
            flex-direction: row;
            padding:20px
        }

        #logo1{
            width:200px;
            height:200px;
            border-radius: 48%;
        }

    </style>
</head>
<body>

    <nav>
        <div id='logo'>
            <img src='../Website photos/pcell-logo.png'>
        </div>
        <div id='links'>
            <ul>
                <li><a href="../Main_Pages/comp_index.php" class='hover-link'>Home</a></li>
                <li><a href="../Login_Signup/logout.php" class='hover-link'>Logout</a></li>
                <li><a href="#" class='hover-link'>Contact us</a></li>
            </ul>
            </ul>
        </div>
    </nav>

    <div id="heading">
        <?php if(isset($user)): ?>
            <img id="logo1" src="../Comp_Logo_Uploads/<?php echo $user['comp_logo']?>">
            <h2><?= htmlspecialchars($user["cname"])?></h2>
        <?php else: ?>
            <p>Image error..</p> 
        <?php endif; ?>
        
    </div>

    <?php if(htmlspecialchars($user1["name"])!=""): ?>
        <p>You have already posted a job offer, wait for <?= htmlspecialchars(($user1["jtime"])) ?> days before posting new job...</p>
        <p>Thank you for your patience</p>

    <?php else: ?>

        <form method="POST" class="my-form">
            <h1>Enter the job details</h1>

            <label>Enter job Post:</label>
            <input type="text" name="jpost">

            <label>Enter vacancies</label>
            <input type="number" name="nvacan">

            <label>Enter skills required:</label>
            <input type="text" name="jskills">

            <label>Enter job description:</label>
            <input type="text" name="jdesc">

            <label>Enter time:</label>
            <input type="number" name="jtime">

            <input type="submit" name="job-post-submit">
        </form>

    <?php endif; ?>

    <p>You can return to the Home Page using this <a href="../Main_Pages/comp_index.php">link</a></p>
        
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