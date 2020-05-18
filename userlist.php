<?php
    /*
    * User list page
    */
    session_start();
    require_once('dbconnect.php');

    if (!isset($_SESSION['user'])) {
        header('Location:index.php');
    }

    $userData = $db->users->findOne(array('_id'=>$_SESSION['user']));

    function get_user_list($db, $userData) {
        $result = $db->users->find(array('username'=> array('$ne'=>$userData['username'])));
        $users = iterator_to_array($result);
        return $users;
    }

    function get_following_users($db, $userData) {
        $result = $db->following->find(array('follower'=> $userData['_id']));
        $result = iterator_to_array($result);
        $users_following = array();
        foreach ($result as $entry) {
            $users_following[] = $entry['user'];
        }
        return $users_following;
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
    <?php include('header.php'); ?>

    <div>
        <p><b>List of users:</b></p>
        <?php
            $user_list = get_user_list($db, $userData);
            $users_following = get_following_users($db, $userData);
            foreach ($user_list as $user) {
                echo '<span>' . $user['username'] . '</span>';
                echo ' [<a href="profile.php?id=' . $user['_id'] . '">Visit Profile</a>]';
                if (!in_array($user['_id'], $users_following)) {
                    echo ' [<a href="follow.php?id=' . $user['_id'] . '">Follow</a>]';
                }
                echo '<hr>';
            }
        ?>
    </div>
</body>
</html>