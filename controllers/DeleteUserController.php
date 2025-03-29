<?php

session_start();

require_once "../models/User.php";

$user = new User($_SESSION["user_id"]);

$user->delete();

session_unset();

header("Location: /");