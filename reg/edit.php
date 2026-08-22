<?php
session_start();
require_once 'connect.php';

// Если не авторизован нечего тут делать
if (!isset($_SESSION['user'])) {
    header('Location:../index.php');
    exit;
}

$id = $_SESSION['user']['id'];

$full_name = mysqli_real_escape_string($connect, $_POST['full_name']);
$login     = mysqli_real_escape_string($connect, $_POST['login']);
$phone     = mysqli_real_escape_string($connect, $_POST['phone']);
$email     = mysqli_real_escape_string($connect, $_POST['email']);
$password  = isset($_POST['password']) ? $_POST['password'] : '';

$avatar_sql = '';
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $patch = 'uploads/' . time() . $_FILES['avatar']['name'];

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $patch)) {
        if (!empty($_SESSION['user']['avatar']) && file_exists('../' . $_SESSION['user']['avatar'])) {
            @unlink('../' . $_SESSION['user']['avatar']);
        }
        $avatar_sql = ", `avatar`='" . mysqli_real_escape_string($connect, $patch) . "'";
        $_SESSION['user']['avatar'] = $patch;
    } else {
        $_SESSION['message'] = 'Ошибка при загрузке нового аватара.';
    }
}

$password_sql = '';
if (!empty($password)) {
    $password_sql = ", `password`='" . mysqli_real_escape_string($connect, $password) . "'";
}

$sql = "UPDATE `users` SET
            `full_name`='$full_name',
            `login`='$login',
            `phone`='$phone',
            `email`='$email'
            $avatar_sql
            $password_sql
        WHERE `id`='" . mysqli_real_escape_string($connect, $id) . "'";

$result = mysqli_query($connect, $sql);

if ($result) {
    $_SESSION['user']['full_name'] = $full_name;
    $_SESSION['user']['email']     = $email;
    $_SESSION['message'] = 'Данные успешно обновлены.';
} else {
    $_SESSION['message'] = 'Ошибка при обновлении данных: ' . mysqli_error($connect);
}

$_SESSION['_just_edited'] = true;
header('Location:../profile.php');
exit;
