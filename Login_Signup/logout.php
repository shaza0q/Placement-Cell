<?php

session_start();
session_destroy();

header("Location: /Login_Signup/login.php");
exit;