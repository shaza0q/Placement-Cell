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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="style_index.css">
</head>

<body>

    <h1>Home</h1>

    <?php if (isset($user)): ?>

        <p> You are logged in </p>
        <p> Hello
            <?= htmlspecialchars($user['uname']) ?>
        </p>

        <div class="skill_update">
            <?php if (isset($userin)): ?>

                <p>Your skills are as follows <br>
                    <?= htmlspecialchars($userin["skill1"]) ?>
                    <br>
                    <?= htmlspecialchars($userin["skill2"]) ?>
                    <br>
                    <?= htmlspecialchars($userin["skill3"]) ?>
                </p>

            <?php endif; ?>

            <?php if(htmlspecialchars($userin["skill1"]) == ""): ?>
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

            <?php else: ?>

                <h2>Update You skills</h2>
                <form method="POST">
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
            <?php endif; ?>
        </div>

    <?php else: ?>
        
        <p>Content will be available after Login is completed</p>
        <p>You can <a href="../Login_Signup/login.php"> log in</a> or <a href="../Login_Signup/signup.htm"> Sign Up</a></p>

    <?php endif; ?>

    <p>You can go to main page using this <a href="../Main_Pages/user_index.php">link</a></p>

    <p><a href="../Login_Signup/logout.php">Logout</a></p>

</body>

</html>