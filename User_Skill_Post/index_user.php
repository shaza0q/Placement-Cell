<?php

session_start();
// print_r($_SESSION);

$mysqli = require __DIR__ . "\..\database.php";

if (isset($_SESSION["user_id"])) {

    $sql = "SELECT * FROM user_info
        WHERE id= {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

if (isset($_SESSION["user_id"])) {
    $sql1 = "SELECT * FROM user_data
    WHERE id={$_SESSION["user_id"]}";

    $result1 = $mysqli->query($sql1);

    $userin = $result1->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql2 = "UPDATE user_data set skill1=?, skill2=?, skill3=? WHERE id={$_SESSION["user_id"]}";

    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql2)) {
        echo ("sql error: " . $mysqli->error);
    }

    $stmt->bind_param(
        "sss",
        $_POST["skill1"],
        $_POST["skill2"],
        $_POST["skill3"]
    );

    if ($stmt->execute()) {
        header("Location: ../Main_Pages/user_index.php");

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
    <title>Home</title>
    <link rel="stylesheet" href="../Main_Pages/styles2.css">
    <link rel="stylesheet" href="../Main_Pages/footer.css">
    <link rel="stylesheet" href="../Login_Signup/style-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #some1,#some2{
            color: #4f0447;
            font-size: 2em;
            padding: 0.5em;
            text-align: center;
        }
        #some1{
            font-size: 2.5em;
        }

        #some3{
            font: 12em;
        }

        .skill_update{
            padding: 1.5em;
            margin: 20px
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
                <li><a href="../Main_Pages/user_index.php" class='hover-link'>Home</a></li>
                <li><a href="../Login_Signup/logout.php" class='hover-link'>Logout</a></li>
                <li><a href="#" class='hover-link'>Contact us</a></li>
            </ul>
            </ul>
        </div>
    </nav> 

    <main>
        <h1 id="some1">Let's know better about you</h1>

        <?php if (isset($user)): ?>

            <p id="some3"> You are logged in <span class="fas fa-thumbs-up"></span></p>
            <p id="some3"> Hello
                <?= htmlspecialchars($user['uname']) ?>
            </p>

            <div class="skill_update">
                <?php if (isset($userin)): ?>

                    <p style="font-size: 20px ;">Your skills are as follows <br></p>
                        <?= htmlspecialchars($userin["skill1"]) ?>
                        <br>
                        <?= htmlspecialchars($userin["skill2"]) ?>
                        <br>
                        <?= htmlspecialchars($userin["skill3"]) ?>

                <?php endif; ?>

                <?php if(htmlspecialchars($userin["skill1"]) == ""): ?>
                    <h2 id="some2">Enter your medical conditions or allergies</h2>
                    <form action="index_process.php" method="POST" class='my-form'>
                        <div>
                            <label>medical condition/allergies 1</label>
                            <input name="skill1" type="text" required>
                        </div>
                        <div>
                            <label>medical condition/allergies 2</label>
                            <input name="skill2" type="text" required>
                        </div>
                        <div>
                            <label>medical condition/allergies 3</label>
                            <input name="skill3" type="text">
                        </div>
                        <div>
                            <input type="submit" value='Enter'>
                        </div>
                    </form>

                <?php else: ?>

                    <h2 id="some2" >Update You skills</h2>
                    <form method="POST" class='my-form'>
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
                        <input type="submit" value='Update'>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

        <?php else: ?>
            
            <p>Content will be available after Login is completed</p>
            <p>You can <a href="../Login_Signup/login.php"> log in</a> or <a href="../Login_Signup/signup.htm"> Sign Up</a></p>

        <?php endif; ?>

        <p>You can go to main page using this <a href="../Main_Pages/user_index.php">link</a></p>

    </main>

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