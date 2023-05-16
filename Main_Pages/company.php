<?php

if(isset($_GET['id'])){
    $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
}else{
    $id=null;
}

session_start();
$_SESSION['companyId']=$id;

header("Location: comp_index.php");
exit;