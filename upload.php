<?php
session_start();
include_once "includes/dbh.inc.php";
$id = $_SESSION['userid'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 100000) {
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "UPDATE profileimg SET status=1 WHERE userId='$id';";
                mysqli_query($conn, $sql);
                header("location: index.php?upload=success");
                exit();
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannont upload files of this type!";
    }
} else {
    header("location: index.php");
    exit();
}
