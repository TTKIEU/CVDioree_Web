<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function authenticate($username, $password) {
        // Hardcoded legacy users
        $legacyUsers = [
            'grader' => [
                'password' => 'cse135-grader',
                'role' => 'super_admin',
                'permissions' => ['*']
            ],
            'grader-superadmin' => [
                'password' => 'cse135-superadmin',
                'role' => 'super_admin',
                'permissions' => ['*']
            ],
            'grader-analyst' => [
                'password' => 'cse135-analyst',
                'role' => 'analyst',
                'permissions' => [
                    'view_activity',
                    'view_charts',
                ]
            ],
            'grader-viewer' => [
                'password' => 'cse135-viewer',
                'role' => 'viewer',
                'permissions' => [
                    'view_reports'
                ]
            ]
        ];

        if (isset($legacyUsers[$username])) {
            if ($legacyUsers[$username]['password'] !== $password) {
                return false;
            }

            return [
                'id' => null,
                'username' => $username,
                'role' => $legacyUsers[$username]['role'],
                'permissions' => $legacyUsers[$username]['permissions']
            ];
        }

        // DB-backed users
        $stmt = $this->db->prepare("
            SELECT id, username, password_hash, role
            FROM users
            WHERE username = ?
        ");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return false;
        }

        $permissions = $this->getPermissionsByUserId($user['id']);

        return [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'permissions' => $permissions
        ];
    }

    public function registerViewer($username, $password) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            return [
                'success' => false,
                'message' => 'Username already exists.'
            ];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO users (username, password_hash, role)
            VALUES (?, ?, 'viewer')
        ");
        $ok = $stmt->execute([$username, $passwordHash]);

        if (!$ok) {
            return [
                'success' => false,
                'message' => 'Could not create account.'
            ];
        }

        $newUserId = $this->db->lastInsertId();

        // Force viewer to have view_reports only
        $viewerPermIds = $this->getPermissionIdsByNames(['view_reports']);
        $this->replacePermissions($newUserId, $viewerPermIds);

        return [
            'success' => true,
            'message' => 'Viewer account created successfully.'
        ];
    }

    public function getPermissionsByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT p.name
            FROM user_permissions up
            JOIN permissions p ON up.permission_id = p.id
            WHERE up.user_id = ?
            ORDER BY p.name ASC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("
            SELECT id, username, role, created_at
            FROM users
            ORDER BY id ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("
            SELECT id, username, role
            FROM users
            WHERE id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
    }

    public function updateRole($userId, $role) {
        $stmt = $this->db->prepare("
            UPDATE users
            SET role = ?
            WHERE id = ?
        ");
        return $stmt->execute([$role, $userId]);
    }

    public function getAllPermissions() {
        $stmt = $this->db->query("
            SELECT id, name
            FROM permissions
            ORDER BY name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermissionIdsByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT permission_id
            FROM user_permissions
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getPermissionIdsByNames(array $names) {
        if (empty($names)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($names), '?'));
        $stmt = $this->db->prepare("
            SELECT id
            FROM permissions
            WHERE name IN ($placeholders)
        ");
        $stmt->execute($names);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function replacePermissions($userId, array $permissionIds) {
        $stmt = $this->db->prepare("DELETE FROM user_permissions WHERE user_id = ?");
        $stmt->execute([$userId]);

        if (empty($permissionIds)) {
            return true;
        }

        $stmt = $this->db->prepare("
            INSERT INTO user_permissions (user_id, permission_id)
            VALUES (?, ?)
        ");

        foreach ($permissionIds as $permissionId) {
            $stmt->execute([$userId, $permissionId]);
        }

        return true;
    }
}