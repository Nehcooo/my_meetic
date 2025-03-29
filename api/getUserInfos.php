<?php

require_once "../models/User.php";

session_start();

$user = new User($_SESSION["user_id"]);
$infos = [
    "email" => $user->getEmail(),
    "firstname" => $user->getFirstname(),
    "lastname" => $user->getLastname(),
    "dob" => $user->getDob(),
    "gender" => $user->getGender(),
    "city" => $user->getCity(),
    "hobbies" => $user->getHobbies(),
    "profile_pic" => $user->getProfilePic(),
];

echo json_encode($infos);