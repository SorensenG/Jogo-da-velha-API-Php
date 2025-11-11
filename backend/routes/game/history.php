<?php
session_start();
require_once __DIR__ . '/../controllers/GameController.php';

// pega userId da URL: /history.php?userId=123
$userId = filter_input(INPUT_GET, 'userId', FILTER_VALIDATE_INT);

if (!$userId && $userId !== 0) {
    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'userId missing or invalid']);
    exit;
}

$GameController = new GameMatchController();
$data = $GameController->getUserMatchs($userId);

header('Content-Type: application/json; charset=utf-8');

echo json_encode($data);