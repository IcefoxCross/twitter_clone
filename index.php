<?php
    /*
    * Login page
    */
    session_start();
    require_once('dbconnect.php');

    if (isset($_SESSION['user'])) {
        header('Location:home.php');
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = hash('sha256', $_POST['password']);
        $result = $db->users->findOne(array('username'=>$username, 'password'=>$password));
        if (!$result) {

        } else {
            $_SESSION['user'] = $result->_id;
            header('Location:home.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Clone</title>
</head>
<body>
    <form method="post" action="index.php">
    <fieldset>
        <label for="username">Username: </label><input type="text" name="username"><br>
        <label for="password">Pasword: </label><input type="password" name="password"><br>
        <input type="submit" value="Login">
    </fieldset>
    </form>
    <a href="register.php">No account? Register here.</a>
</body>
</html>