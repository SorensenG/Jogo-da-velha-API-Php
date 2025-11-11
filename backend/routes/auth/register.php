<?php
require_once __DIR__ . '/../../controllers/AuthController.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$controller = new AuthController();

$response = $controller->registerUser($data);
echo json_encode($response);
