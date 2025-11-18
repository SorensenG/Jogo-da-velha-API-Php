<?php
require_once __DIR__ . '/../../controllers/GameController.php';
require_once __DIR__ . '/../../utils/session.php';

header('Content-Type: application/json; charset=utf-8');

$userId = checkSession();

if ($userId == -1) {
    http_response_code(400);
    echo json_encode(['error' => 'userId missing or invalid']);
    exit;
}

$GameController = new GameMatchController(); // ou GameMatchController se for essa a classe certa

$data = $GameController->getUserMatchs($userId);

http_response_code(200);
echo json_encode($data);
