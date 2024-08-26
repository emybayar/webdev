

<?php
    //obtain incoming variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    //print "Hello, $username!"

    //check if username is empty
    if(empty($username)) {
        //redirect back to micro06.php page
        header('Location: micro06.php?message=USERNAME_MISSING');
        exit();
    }
    //check if pw is empty
    if(empty($password)) {
        header('Location: micro06.php?message=PASSWORD_MISSING');
        exit();
    }

    //check if username and password are matched
    if($username !== 'pikachu' || $password !== 'pokemon') {
        //redirect back to micro06.php page
        header("Location: micro06.php?message=WRONG_USERNAME/PASSWORD");
        exit();
    } else {
        //successful login
        header('Location: micro06.php?message=You_are_logged_in!');
        exit();
    }
?>