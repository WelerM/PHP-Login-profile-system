<?php
include_once "header.php";
?>
<div class="signup-page">
    <section class="signup-form">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="name" placeholder="Full name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Repeat passworld">
            <button type="submit" name="submit">Sign Up</button>
        </form>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyinput') {
                echo "<p>Fill in all fields!</p>";
            } else if ($_GET['error'] == 'invaliduid') {
                echo "<p>Invalid username!!</p>";
            } else if ($_GET['error'] == 'invalidemail') {
                echo "<p>Invalid email!!</p>";
            } else if ($_GET['error'] == 'passwordsdontmatch') {
                echo "<p>Passwords don't match!!</p>";
            } else if ($_GET['error'] == 'stmtfailed') {
                echo "<p>There was an error!!</p>";
            } else if ($_GET['error'] == 'usernametaken') {
                echo "<p>This user name already exists!!</p>";
            } else if ($_GET['error'] == 'none') {
                echo "<p>You have signed up!!</p>";
            }
        }
        ?>
    </section>
</div>

<?php
include_once "footer.php";
?>