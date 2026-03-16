<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login() {
        if (!empty($_SESSION['logged_in'])) {
            header('Location: /dashboard');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->authenticate($username, $password);

            if ($user) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['permissions'] = $user['permissions'];

                header('Location: /dashboard');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}