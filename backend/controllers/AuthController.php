<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../utils/session.php';

class AuthController
{
    public function registerUser($registerData)
    {
       $user = new User();
        $createdUser = $user->registerUser($registerData);

        if ($createdUser) {
            // Inicia a sessão automaticamente após o cadastro
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $createdUser['id'];
            $_SESSION['username'] = $createdUser['username'];

            return [
                'status' => 201,
                'message' => 'User registered successfully and logged in.',
                'user' => [
                    'id' => $createdUser['id'],
                    'username' => $createdUser['username']
                ]
            ];
        } else {
            return [
                'status' => 400,
                'message' => 'Failed to register user. Username or email may already exist.'
            ];
        }
    }

    public function login($username, $password)
    {
        $user = new User();
        $userExists = $user->findUserByUsername($username);

        if ($userExists && password_verify($password, $userExists['senha'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $userExists['id'];
            $_SESSION['username'] = $userExists['username'];

            return [
                'status' => 200,
                'message' => 'Login successful.',
                'user' => [
                    'id' => $userExists['id'],
                    'username' => $userExists['username']
                ]
            ];
        } else {
            return [
                'status' => 401,
                'message' => 'Invalid username or password.'
            ];
        }
    }

    public function logout()
    {
        destroySession();
        return [
            'status' => 200,
            'message' => 'User logged out successfully.'
        ];
    }

    public function getProfile()
    {
        $userId = checkSession();
        if ($userId === -1) {
            return [
                'status' => 401,
                'message' => 'Unauthorized'
            ];
        }

        $user = new User();
        $userData = $user->findUserById($userId);

        if ($userData) {
            // Remove sensitive info
            unset($userData['senha']);
            return [
                'status' => 200,
                'user' => $userData
            ];
        }

        return [
            'status' => 404,
            'message' => 'User not found'
        ];
    }

    public function updateProfile($updateData)
    {
        $userId = checkSession();
        if ($userId === -1) {
            return [
                'status' => 401,
                'message' => 'Unauthorized'
            ];
        }

        $user = new User();
        $success = $user->updateUserInfos($userId, $updateData);

        if ($success) {
            return [
                'status' => 200,
                'message' => 'Profile updated successfully.'
            ];
        }

        return [
            'status' => 400,
            'message' => 'Failed to update profile or nothing to change.'
        ];
    }
}
