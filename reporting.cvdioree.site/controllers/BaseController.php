<?php

class BaseController {
    protected function requireLogin() {
        if (empty($_SESSION['logged_in'])) {
            header('Location: /login');
            exit;
        }
    }

    protected function requireRole(array $allowedRoles) {
        $this->requireLogin();

        $role = $_SESSION['role'] ?? null;

        if (!$role || !in_array($role, $allowedRoles, true)) {
            http_response_code(403);
            require __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }

    protected function hasPermission($permission) {
        $this->requireLogin();

        if (($_SESSION['role'] ?? null) === 'super_admin') {
            return true;
        }

        $permissions = $_SESSION['permissions'] ?? [];
        return in_array($permission, $permissions, true);
    }

    protected function requirePermission($permission) {
        if (!$this->hasPermission($permission)) {
            http_response_code(403);
            require __DIR__ . '/../views/errors/403.php';
            exit;
        }
    }
}