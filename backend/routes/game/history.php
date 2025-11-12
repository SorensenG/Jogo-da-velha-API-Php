<?php
require_once __DIR__ . './../../controllers/GameController.php';
require_once __DIR__ .'./../../utils/session.php';

header('Content-Type: application/json');

$userId = checkSession();

if ($userId == -1) {
    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'userId missing or invalid']);
    exit;
}

$GameController = new GameMatchController();
$data = $GameController->getUserMatchs($userId);

header('Content-Type: application/json; charset=utf-8');

echo json_encode($data);