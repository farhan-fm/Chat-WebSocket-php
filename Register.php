<?php
$error = '';

$success_message='';

if (isset($_POST["Register"])){
    session_start();
    if (isset($_SESSION['user_data'])){
        header('location:chatroom.php');
    }
    require_once ('database/ChatUser.php');
    $user_object=new ChatUser;
    $user_object->setUserName($_POST['user_name']);
    $user_object->setUserEmail($_POST['user_email']);
    $user_object->setUserPassword($_POST['user_password']);
    https://www.youtube.com/watch?v=VpoOvYEB7Xs&list=PLxl69kCRkiI0U4rM9RA1VBah5tfU26-Fp&index=2
   // 19:30
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>

<body>

</body>

</html>