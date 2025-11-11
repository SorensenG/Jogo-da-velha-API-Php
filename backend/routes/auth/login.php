<?php
require_once __DIR__ . '/../../controllers/AuthController.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$controller = new AuthController();
$response = $controller->login($username, $password);

echo json_encode($response);
