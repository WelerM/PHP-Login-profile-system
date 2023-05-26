<?php

include_once 'header.php';

if (isset($_SESSION['userid'])) {
    echo '    <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                 <button type="submit" name="submit">UPLOAD</button>
              </form>';
} else {
    echo ' <h1>Please login as user to upload a profile image</h1>';
}

include_once 'footer.php';