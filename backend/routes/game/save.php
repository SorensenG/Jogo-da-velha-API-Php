 <?php
require_once __DIR__ . './../../controllers/GameController.php';
require_once __DIR__ .'./../../utils/session.php';

header('Content-Type: application/json');

$userId = checkSession();

if ($userId == -1) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'userId missing or invalid']);
    exit;
}

$matchData = json_decode(file_get_contents("php://input"), true);

$GameController = new GameMatchController();
$response = $GameController->saveGame($matchData, $userId);

http_response_code($response['status']);
echo json_encode($response);
