<?php
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../utils/session.php';

header('Content-Type: application/json');

$controller = new AuthController();
$response = $controller->getProfile();

http_response_code($response['status']);
echo json_encode($response);






?>
