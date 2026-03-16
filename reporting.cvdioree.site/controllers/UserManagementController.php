<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/User.php';

class UserManagementController extends BaseController {
    public function index() {
        $this->requirePermission('manage_users');

        $userModel = new User();
        $users = $userModel->getAllUsers();

        require __DIR__ . '/../views/users/index.php';
    }

    public function edit() {
        $this->requirePermission('manage_users');

        $userId = $_GET['id'] ?? null;
        if (!$userId) {
            http_response_code(400);
            echo "Missing user id";
            exit;
        }

        $userModel = new User();
        $user = $userModel->getUserById($userId);
        $permissions = $userModel->getAllPermissions();
        $assignedPermissionIds = $userModel->getPermissionIdsByUserId($userId);

        require __DIR__ . '/../views/users/edit.php';
    }

    public function update() {
        $this->requirePermission('manage_users');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /users');
            exit;
        }

        $userId = $_POST['user_id'] ?? null;
        $role = $_POST['role'] ?? 'viewer';
        $permissionIds = $_POST['permissions'] ?? [];

        $userModel = new User();

        // optional safety: don't demote or break your own active account
        if ((int)$userId === (int)($_SESSION['user_id'] ?? -1) && $role !== 'super_admin') {
            $_SESSION['user_error'] = "You cannot change your own active account away from super_admin.";
            header('Location: /users');
            exit;
        }

        $userModel->updateRole($userId, $role);

        if ($role === 'viewer') {
            // viewers only get reports
            $viewerPermissionIds = $userModel->getPermissionIdsByNames(['view_reports']);
            $userModel->replacePermissions($userId, $viewerPermissionIds);
        } elseif ($role === 'analyst') {
            // analysts get selected permissions
            $userModel->replacePermissions($userId, $permissionIds);
        } else {
            // super_admin doesn't need stored permissions
            $userModel->replacePermissions($userId, []);
        }

        header('Location: /users');
        exit;
    }

    public function delete() {
        $this->requirePermission('manage_users');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /users');
            exit;
        }

        $userId = $_POST['user_id'] ?? null;

        if ((int)$userId === (int)($_SESSION['user_id'] ?? 0)) {
            $_SESSION['user_error'] = "You cannot delete your own active account.";
            header('Location: /users');
            exit;
        }

        $userModel = new User();
        $userModel->deleteUser($userId);

        header('Location: /users');
        exit;
    }
}