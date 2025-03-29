<?php

session_start();

require_once "../models/User.php";

$extension = strtolower(pathinfo(basename($_FILES["profile_pic"]["name"]), PATHINFO_EXTENSION));
$uploaded = move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../uploads/" . $_SESSION["user_id"] . "." . $extension);

if ($uploaded) {
    $user = new User($_SESSION["user_id"]);
    $user->updateInfo("profile_pic", "/uploads/" . $_SESSION["user_id"] . "." . $extension);
}

header("Location: /account");