<?php

require_once "../models/Database.php";

session_start();

$args = json_decode(file_get_contents("php://input"), true);
$db = new Database();
$db->connect_to_db();
$data = $db->get_users($_SESSION["user_id"], $args["filters"]);

echo json_encode($data);