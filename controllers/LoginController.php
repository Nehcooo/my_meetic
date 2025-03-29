<?php

session_start();

require_once "../models/Database.php";

$email = $_POST["email"];
$password = $_POST["password"];
$remember_me = isset($_POST["remember_me"]) ? $_POST["remember_me"] : false;

$db = new Database();
$db->connect_to_db();

$user = $db->get_user_from_db_by_email($email);

if (isset($user) and $user != false) {
    if (password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        
        header("Location: /home");

        return;
    }
}

$_SESSION["login_error"] = "true";

header("Location: /login");