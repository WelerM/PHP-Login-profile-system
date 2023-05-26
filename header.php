<?php
session_start();
require_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fruity</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/script.js" defer></script>
</head>

<body>
    <nav>
        <a class="logo-container" href="index.php">
            <h2>fruity</h2>
            <img src="assets/site_images/logo.png" alt="">
        </a>
        <ul>
            <?php

            if (isset($_SESSION['userid'])) {
                $userName = $_SESSION['useruid'];
                $userId = $_SESSION['userid'];
                //"SQL here"
                echo '<div class="header-user-info">  
                        <img class="header-img-profile"  src="uploads/profile' . $userId . '.png?'. mt_rand(). ' "/>
                        <h3>' . $userName . '</h3>
                    </div>';

                echo '<li><a href="profile.php">profile</a></li>';
                echo  '<li><a href="includes/logout.inc.php">logout</a></li>';
            } else {
                echo '<li><a href="signup.php">sign up</a></li>
                        <li><a href="login.php">login</a></li>';
            }
            ?>
        </ul>
    </nav>

    <div class="wrapper">