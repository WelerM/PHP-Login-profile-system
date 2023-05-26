<?php
include_once "header.php";
?>
<div class="user-list-container">
    <h4>registered users</h4>
    <?php
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['usersId'];

            $sqlImg = "SELECT * FROM profileimg WHERE userid= '$id'";
            $resultImg = mysqli_query($conn, $sqlImg);
            while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                echo "<div class='user-container'>";
                if ($rowImg['status'] == 0) {
                    echo '<img class="img-profile" src="uploads/profiledefault.png"/>';
                } else {
                    echo '<img class="img-profile" src="uploads/profile' . $id . '.png?' . mt_rand() . '"/>';
                }
                echo "<p class='user-list-name'> " . $row['usersName'] . "";
                echo "</div>";
            }
        }
    } else {
        echo "there are no users in the database";
    }
    ?>
</div>


<div class="posts">
    <?php
    if (isset($_SESSION['userid'])) {

        echo  '<form class="post-form" action="includes/post.inc.php" method="post">
                    <textarea name="text" id="" cols="30" rows="10"></textarea>
                    <button type="submit" name="submit">post</button>
              </form>
              <div class="btn-open-post-form">
                  <img class="img-open-post-form" src="./assets/site_images/write.png" alt="">
                    <p class="btn-open-post-form-text">post</p>
              </div>';
    }

    ?>


    <div class="posts-container">
        <?php

        //POSTS
        $sqlPosts = "SELECT * from posts WHERE postsContent IS NOT NULL ORDER BY post_id DESC;"; //DESC
        $resultPost = mysqli_query($conn, $sqlPosts);
        while ($rowPost = mysqli_fetch_assoc($resultPost)) {
            echo "<div class='post'>";

            //GETS ALL USER'S ID
            $sql = "SELECT * FROM users WHERE posts IS NOT NULL AND usersId = " . $rowPost['post_owner'] . ";";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($users = mysqli_fetch_assoc($result)) {
                    $id = $users['usersId'];

                    //SHOW PROFILE IMAGES
                    $sqlImg = "SELECT * FROM profileimg WHERE userId = " . $rowPost['post_owner'] . ";";
                    $resultImg = mysqli_query($conn, $sqlImg);
                    while ($rowImg = mysqli_fetch_assoc($resultImg)) {

                        //PROFILE IMAGE

                        if ($rowImg['status'] == 0) {
                            echo '<img class="img-profile" src="uploads/profiledefault.png"/>';
                        } else {
                            echo '<img class="img-profile" src="uploads/profile' . $rowPost['post_owner'] . '.png?' . mt_rand() . '"/>';
                        }



                        echo "<div class='posts-content'>";
                            //USER NAME
                            echo "<p class='post-owner-name''>" . $rowPost['post_owner_name'] . " </p> ";
                            echo "<p class='post-text'>" . $rowPost['postsContent'] . "</p>";
                        echo "</div>";

                        echo "<p class='post-date'>". $rowPost['postsDate'] . "</p>";
                    }
                }
            } else {
                echo "there are no users in the database";
            }
            echo "</div>";
        }
        ?>
    </div>

</div>



<?php
include_once "footer.php";
?>