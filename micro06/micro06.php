<!DOCTYPE html>
<html>
    <head>
        <title>Micro Assignment #06</title>
    </head>

    <body>
        <!-- FORM -->
        <form action="micro06_process.php" method="POST">
            Username: <input type="text" name="username">
            <br><br>
            Password: <input type="password" name="password">
            <br><br>
            <input type="submit" value="Login">
        </form>
    </body>

    <?php
        //display error msg if redirected from process oage
        if(isset($_GET['message'])) {
            $message = $_GET['message'];
            if($message == "USERNAME_MISSING") {
                echo "<p style='color: red;'> USERNAME IS MISSING! </p>";
            }
            else if($message == "PASSWORD_MISSING") {
                echo "<p style='color: red;'> PASSWORD IS MISSING! </p>";
            }
            else if($message == "WRONG_USERNAME/PASSWORD")  {
                echo "<p style='color:red;'>Wrong username/password! </p>";
            }
            else if($message == "You_are_logged_in!") {
                echo "<p style='color:red;'>You Are Logged In! </p>";
            }
        }
    ?>
</html>