<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkSession() {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized: user not logged in']);
        return -1;
    }
    return $_SESSION['user_id'];
}

function destroySession() {
    if (session_status() !== PHP_SESSION_NONE) {
        session_unset();
        session_destroy();
    }
}
