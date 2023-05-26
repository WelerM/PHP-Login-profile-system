<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result = null;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidUid($username){
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result = null;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email){
    $result = null;
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../singup.php?error=usernametaken");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn,$name, $email,  $username, $pwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
    
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../singup.php?error=usernametaken");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email,  $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql_userInfo = "SELECT * FROM users WHERE usersUid='$username' AND usersName='$name'";
    $results = mysqli_query($conn, $sql_userInfo);

    if (mysqli_num_rows($results) > 0 ) {
        while($row = mysqli_fetch_assoc($results)){
            $userid = $row['usersId'];
            $sqlImg = "INSERT INTO profileimg (userid, status) VALUES ('$userid', 0) ";
            mysqli_query($conn, $sqlImg);

        };
    }else{
        echo "You have an error";
    };


    header("Location: ../login.php?error=none");
    exit();
}



//========    LOGIN     ===========
function emptyInputLogin($username, $pwd){
    $result = null;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] =  $uidExists["usersId"];
        $_SESSION["useruid"] =  $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}
