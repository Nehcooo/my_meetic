<?php

require_once "../models/Database.php";
require_once "../models/User.php";

$email = $_POST["email"];
$gender = $_POST["gender"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$dob = $_POST["dob"];
$city = $_POST["city"];
$hobbies = $_POST["hobbies"];

$db = new Database();
$db->connect_to_db();
$user_id = $db->add_user_to_db($email, $password, $firstname, $lastname, $dob, $gender, $city);
$user = new User($user_id);

foreach($hobbies as $element) {
    $user->add_hobbie($element);
}

header("Location: /login");