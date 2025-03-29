<?php

require_once "../models/Database.php";

$args = json_decode(file_get_contents("php://input"), true);
$db = new Database();
$db->connect_to_db();

if ($db->do_user_exist($args["email"])) {
    echo json_encode(["existed" => true]);
} else {
    echo json_encode(["existed" => false]);
}
