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


//jeito do meu gepeto


// <?php
// require_once __DIR__ . '/../../utils/session.php';
// require_once __DIR__ . '/../../controllers/GameController.php';

// header('Content-Type: application/json; charset=utf-8');

// // Verifica se o usuário está logado
// checkSession();

// // O ID do jogador vem da sessão (não da URL)
// $userId = $_SESSION['user_id'];

// $controller = new GameMatchController();
// $response = $controller->getUserMatchs($userId);

// echo json_encode($response);
