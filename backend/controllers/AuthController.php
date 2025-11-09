<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{

    public function registerUser($registerData)
    {
        $user = new User();
        $registerSuces = $user->registerUser($registerData);

        if ($registerSuces) {
            return [
                'status' => '201 created',
                'message' => 'User registered.'
            ];
        } else {
            return
                [
                    'status' => '400 bad request',
                    'message' => 'Failed to register.'
                ];
        }
    }

    public function login($username, $userPassword)
    {

        $user = new User();

        $userExists = $user->findUserByUsername($username);

        if ($userExists && password_verify($userPassword, $userExists['senha'])) {
            session_start();
            $_SESSION['user_id'] = $userExists['id'];
            $_SESSION['username'] = $userExists['username'];
            return [
                'status' => '200 ok',
                'message' => 'Login successful',
            ];
        } else {
            return [
                'status' => '401 not autorized',
                'message' => 'Invalid username or password.'
            ];
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        return [
            'status' => 'success',
            'message' => 'User logged out successfully.'
        ];
    }
}
