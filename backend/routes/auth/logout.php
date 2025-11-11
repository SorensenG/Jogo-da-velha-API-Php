 <?php
require_once __DIR__ . '/../../utils/session.php';
header('Content-Type: application/json');

destroySession();

echo json_encode([
    'status' => 'success',
    'message' => 'User logged out successfully.'
]);
