<?php

session_start();

$mysqli=require __DIR__."/database.php";

if(isset($_SESSION["user_id"])){

    $sql="SELECT * FROM user_info
    WHERE id={$_SESSION["user_id"]}";

    $result= $mysqli->query($sql);
    $user=$result->fetch_assoc();

    // $sql1="SELECT * comp_data 
    // WHERE id={$_SESSION["user_id"]}";

    // $resut1= $mysqli->query($sql1);
    // $comp_dt=$result1->fetch_assoc();

}

// echo $comp_dt["comp_logo"];

if ($_SERVER["REQUEST_METHOD"]==="POST"){

    $img_name=$_FILES['comp_logo']['name'];
    $tmp_img_name=$_FILES['comp_logo']['tmp_name'];
    $folder='../Comp_Logo_Uploads/';
    move_uploaded_file($tmp_img_name,$folder.$img_name);
    
    // header("Location: ../Company_Job_Post/index_jpost.php");

    $sql = "INSERT INTO comp_data (id, cname, cwork, cdesc, comp_logo) VALUES (?,?,?,?,?)";

    $stmt=$mysqli->stmt_init();

    if(! $stmt->prepare($sql)){
        echo("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("issss",
    $user["id"],
    $user["uname"],
    $_POST["comp_work"],
    $_POST["comp_desc"],
    $img_name);

    if($stmt->execute()){
        header("Location: ../Company_Job_Post/index_jpost.php");
    }else{
        die($mysqli->error." ". $mysqli->errno);
    }

}else{
    echo("Not Uploaded");
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

</head>
<body>

    <nav>
        <div id='logo'>
            <a href="#">LOGO</a>
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

    <h1> We want to know you better</h1>
    
    <?php if(isset($user)): ?>
        <p> Hello <?= htmlspecialchars($user['uname'])?></p> 
        <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p>You can <a href="login.php"> log in</a> or <a href="signup.htm"> Sign Up</a></p> 
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="my-form">

        <label>Logo</label>
        
        <input type="file" name="comp_logo">

        <label>Main field of work:</label>
        <input type="text" name="comp_work">

        <label>Description about your Company:</label>
        <textarea rows="3" 
        cols="50" name="comp_desc" 
        onclick="if(this.value=='Enter description here...') this.value='';">Enter description here...</textarea>

        <input type='submit' name='comp-form-submit'>
    </form>

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