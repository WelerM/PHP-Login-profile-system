<?php

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    // EMPTY
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("Location: ../signup.php?error=emptyinput");
        exit();
    }
    //PROPER USERNAME
    if (invalidUid($username) !== false) {
        header("Location: ../signup.php?error=invaliduid");
        exit();
    }
    //PROPER EMAIL
    if (invalidEmail($email) !== false) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }
    //PWD MATCH
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("Location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    //User already exists
    if (uidExists($conn, $username, $email) !== false) {
        header("Location: ../signup.php?error=useernametaken");
        exit();
    }



    createUser($conn, $name, $email, $username, $pwd);

} else {
    header("Location: ../signup.php");
    exit();
}
