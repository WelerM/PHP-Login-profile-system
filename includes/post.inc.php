<?php

session_start();
require_once 'dbh.inc.php';

if (isset($_POST['submit'])) {
    $text = $_POST['text'];
    if ($text != '') {
        $id = $_SESSION['userid'];
        $username = $_SESSION['useruid'];
    
        $sql_update = "UPDATE users SET posts = 1 WHERE usersId = '$id';";
        mysqli_query($conn, $sql_update);
    
        $sql_insert = "INSERT INTO posts (post_owner, post_owner_name, postsContent) VALUES ('$id', '$username','$text')";
        mysqli_query($conn, $sql_insert);
        header("location: ../index.php?postsubmited");
        exit();
    }else{
        header("location: ../index.php?postemptyfield");
        exit();
    }
} else {
    header("location: ../index.php?invalidpost");
    exit();
}
