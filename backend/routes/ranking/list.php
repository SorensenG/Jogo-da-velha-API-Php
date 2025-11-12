  <?php
require_once __DIR__ . './../../controllers/RankingController.php';

header('Content-Type: application/json');

$RankingController = new RankingController();
$response = $RankingController->getTopPlayers();

http_response_code($response['status']);
echo json_encode($response);