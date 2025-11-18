<?php
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../utils/session.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$controller = new AuthController();
$response = $controller->updateProfile($data);

http_response_code($response['status']);
echo json_encode($response);

?>
