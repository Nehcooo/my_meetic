<?php

session_start();

require_once "../models/Database.php";
require_once "../models/User.php";

$email = $_POST["email"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$dob = $_POST["dob"];
$city = $_POST["city"];
$hobbies = $_POST["hobbies"];

$user = new User($_SESSION["user_id"]);

if (isset($email) and strlen($email) > 0) {
    $user->updateInfo("email", $email);
}

if (isset($firstname) and strlen($firstname) > 0) {
    $user->updateInfo("firstname", $firstname);
}

if (isset($lastname) and strlen($lastname) > 0) {
    $user->updateInfo("lastname", $lastname);
}

if (isset($password) and strlen($password) > 0) {
    $user->updateInfo("password", $password);
}

if (isset($dob) and strlen($dob) > 0) {
    $user->updateInfo("dob", $dob);
}

if (isset($city) and strlen($city) > 0) {
    $user->updateInfo("city", $city);
}

if (isset($hobbies) and count($hobbies) > 0) {
    $user->updateHobbies($hobbies);
}

header("Location: /account");