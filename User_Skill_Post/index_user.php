<?php

session_start();
// print_r($_SESSION);

$mysqli = require __DIR__ . "/database.php";

if(isset($_SESSION["user_id"])){

    $sql="SELECT * FROM user_info
        WHERE id= {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user=$result->fetch_assoc();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="style_index.css">
</head>
<body>
    
    <h1>Home</h1>

    <?php if(isset($user)): ?>
        <p> You are logged in </p>
        <p> Hello <?= htmlspecialchars($user['uname'])?></p> 
        <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>You can <a href="login.php"> log in</a> or <a href="signup.htm"> Sign Up</a></p> 
    <?php endif; ?>

    <div class="skill_update">
        <h2>Enter You skills</h2>
        <form action="index_process.php" method="POST">
            <div>
                <label>Skill 1</label>
                <input name="skill1" type="text" required>
            </div>
            <div>
                <label>Skill 2</label>
                <input name="skill2" type="text" required>
            </div>
            <div>
                <label>Skill 3</label>
                <input name="skill3" type="text">
            </div>
            <div>
                <button>Update</button>
            </div>
        </form>
    </div>

    <div class="company_search">
        <input type="text" name="company_search" value="Enter Company Name" onclick="if(this.value=='Enter Company Name') this.value='';">
        <button>Search</button>

        <?php
            $mysqli=require __DIR__."/database.php";

            $sql="SELECT EXISTS(SELECT uname from user_info WHERE uname='company_search'";
        
        ?>
    </div>

    
    <div class="comp_des">
        <div id="comp_des_upper">
            <img src="overlord.png" id='comp_logo'>
            <h3>Company Name</h3>
        </div>
        <div id="comp_des_lower">
            <h4>Job Description</h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque maxime nobis, debitis ex iusto illum repellendus natus iure quibusdam? Laborum excepturi culpa quasi. Dolore eius iusto sint molestias alias aliquam sunt perferendis nihil ab iure cum ipsa perspiciatis</p>
            <h4>Language Required:</h4><span>lang 1, lang 2</span>
            <br>
            <button id=comp_but>Apply Here</button>
        </div>
    </div>


</body>
</html>