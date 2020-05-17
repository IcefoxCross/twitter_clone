<?php
    /*
    * Home page
    */

    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['user'])) {
        header("Location:index.php");
    }

    $userData = $db->users->findOne(array('_id'=>$_SESSION['user']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Clone</title>
</head>
<body>
    <?php include('header.php'); ?>
    <form method="post" action="create_tweet.php">
        <fieldset>
            <label for="tweet">What's happening?</label><br>
            <textarea name="body" cols="50" rows="4"></textarea><br>
            <input type="submit" value="Tweet">
        </fieldset>
    </form>
</body>
</html>