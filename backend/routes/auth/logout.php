<?php
require_once __DIR__ . '/../../controllers/AuthController.php';
header('Content-Type: application/json');

$controller = new AuthController();
$response = $controller->logout();

http_response_code($response['status']);
echo json_encode($response);
