<?php

if (isset($_POST['comp-form-submit'])){
    $img_name=$_FILES['comp_logo']['name'];
    $tmp_img_name=$_FILES['comp_logo']['tmp_name'];
    $folder='Comp_Logo_Uploads/';
    move_uploaded_file($tmp_img_name,$folder.$img_name);
    echo "Uploaded";
}else{
    echo("Not Uploaded");
}