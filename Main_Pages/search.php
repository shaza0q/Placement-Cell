<?php

$mysqli = require __DIR__ . "\..\database.php";

if(isset($_GET['query'])){
    $searchQuery = $_GET['query'];
    echo $searchQuery;
}

?>