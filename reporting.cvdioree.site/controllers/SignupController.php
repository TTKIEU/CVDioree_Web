<?php
require_once __DIR__ . '/../models/User.php';

class SignupController {
    public function index() {
        if (!empty($_SESSION['logged_in'])) {
            header('Location: /dashboard');
            exit;
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirmPassword = trim($_POST['confirm_password'] ?? '');

            if ($username === '' || $password === '' || $confirmPassword === '') {
                $error = 'All fields are required.';
            } elseif ($password !== $confirmPassword) {
                $error = 'Passwords do not match.';
            } else {
                $userModel = new User();
                $result = $userModel->registerViewer($username, $password);

                if ($result['success']) {
                    $success = $result['message'];
                } else {
                    $error = $result['message'];
                }
            }
        }

        require __DIR__ . '/../views/auth/signup.php';
    }
}