<?php

session_start();

$uri = $_SERVER["REQUEST_URI"];

if (isset($_SESSION["user_id"])) {
    require_once "models/Database.php";

    $db = new Database();
    $db->connect_to_db();

    if ($db->get_user_from_db($_SESSION["user_id"]) == false) {
        session_unset();

        $uri = "/";
    }
} else {
    if ($uri != "/login" and $uri != "/register") {
        $uri = "/";
    }
}

switch ($uri) {
    case "/":
        if (isset($_SESSION["user_id"])) {
            header("Location: /home");
        } else {
            header("Location: /login");
        }

        break;
    case "/login":
        require_once __DIR__ . "/views/login.php";
        break;
    case "/register":
        require_once __DIR__ . "/views/register.php";
        break;
    case "/home":
        require_once __DIR__ . "/views/home.php";
        break;
    case "/account":
        require_once __DIR__ . "/views/account.php";
        break;
    default:
        require_once __DIR__ . "/views/default.php";
        break;
}