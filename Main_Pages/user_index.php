<?php

session_start();

$mysqli = require __DIR__ . "\..\database.php";

// echo $_SESSION["user_id"];
// echo '<script type="text/JavaScript">';
// echo 'alert("Your Skills have been taken into consideration")';
// echo '</script>';


if (isset($_SESSION["user_id"])) {

    $sql = "SELECT * FROM user_info
        WHERE id= {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

// Selecting the user data
if($sql1= "SELECT * FROM user_data WHERE id={$_SESSION["user_id"]}"){
    $result1=$mysqli->query($sql1);
    $user1 = $result1->fetch_assoc();
}
else{
    header("Location: ../Login_Signup/login.php");
}

// Selecting company job post data
$sql2="SELECT * FROM job_post";
$result2=$mysqli->query($sql2);

$array=[];

if($result2->num_rows >0){
    $result2->data_seek(0);
    while($row=$result2->fetch_assoc()){

        if($row['jskills']==$user1['skill1'] || $row['jskills']==$user1['skill2'] || $row['jskills']==$user1['skill3']){   
            $array[] = $row['id']; 
        }
    }
}

// echo implode($array);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Index Page</title>
    <link rel="stylesheet" type="text/css" href="styles1.css" />
    <link rel="stylesheet" href="footer.css">
</head>
<body>
    <nav>
        <div id='logo'>
            <a href="#">LOGO</a>
        </div>
        <div id='links'>
            <ul>
                <span>|</span>
                <li><a href="../Login_Signup/logout.php" class='hover-link'>Logout</a></li><span>|</span>
                <li><a href="../User_Skill_Post/index_user.php" class='hover-link'>Update skills</a></li>
            </ul>
        </div>
    </nav>
    
    <p id=greetings>Hello <?= htmlspecialchars($user["uname"])?>&#x1F44B;</p>
    <p id=greetings-s>Hope you are doing great</p>
    <h2>Company Recomendations for you</h2>

    <div class="container">
        <?php
            if($result2->num_rows >0){
                $result2->data_seek(0);
                while($row=$result2->fetch_assoc()){

                    if($row['jskills']==$user1['skill1'] || $row['jskills']==$user1['skill2'] || $row['jskills']==$user1['skill3']){   
              
                    
        ?>
        <div class='card'>
            <div id="lola_align">
                <?php 
                    $sql3="SELECT * FROM comp_data
                    WHERE id={$row['id']}";
                    $result3=$mysqli->query($sql3);
                    $comp=$result3->fetch_assoc();

                ?>

                <img src="../Comp_Logo_Uploads/<?= htmlspecialchars($comp['comp_logo'])?>" width=100px id="logo_card">

                <p class="comp_name"><?php echo $row["name"]?></p>

            </div>
            <div class="desc_job">
                <p>
                <b>Post: </b><?php echo $row["jpost"] ?>
                </p>
                <p>
                <b>Vacancies: </b><?php echo $row["nvacan"]?>
                </p>
                <p><b>Prerequiste: </b><?php echo $row["jskills"]?>
                </p>
                <p>
                <b>Description: </b><?php echo $row["jdesc"]?>
                </p>
                <a href="company.php?id=<?php echo $row['id'];?>" class="zoom">Click here to apply</a>
                
            </div>
                    
        </div>
        <?php
                              
                    }
                }
            }
        ?>
    </div>

    <div class="search_bar">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search..." />
            <input type="submit" value="Search" />
        </form>
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
