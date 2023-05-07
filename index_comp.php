<?php

session_start();

$mysqli=require __DIR__."/database.php";

if(isset($_SESSION["user_id"])){

    $sql="SELECT * FROM user_info
    WHERE id={$_SESSION["user_id"]}";

    $result= $mysqli->query($sql);
    $user=$result->fetch_assoc();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company data Updates</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<body>

    <h1> Post which Job you want to give</h1>
    
    <?php if(isset($user)): ?>
        <p> Hello <?= htmlspecialchars($user['uname'])?></p> 
        <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>You can <a href="login.php"> log in</a> or <a href="signup.htm"> Sign Up</a></p> 
    <?php endif; ?>

    <form action="upload.php" method="POST" enctype="multipart/form-data">

        <label>Logo</label>
        <input type="file" name="comp_logo">

        <label>Company Name:</label>
        <input type="text" name="comp_name">

        <label>Post required:</label>
        <input type="text" name="comp_post">

        <label>Job description:</label>

        <textarea rows="3" 
        cols="50" name="comp_desc" 
        onclick="if(this.value=='Enter description here...') this.value='';">Enter description here...</textarea>

        <input type='submit' name='comp-form-submit'>
    </form>


    
</body>
</html>