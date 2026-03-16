<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Edit User</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-lg border border-gray-100">
        <div class="flex flex-col items-center mb-4">
            <svg class="w-12 h-12 text-blue-500 mb-2 mx-auto block" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v4l2 2" />
            </svg>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center tracking-tight">Edit User</h1>
        </div>
        <p class="text-gray-700 text-center mb-6">Editing: <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($user['username']); ?></span></p>
        <form method="POST" action="/users/update" class="space-y-6">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div>
                <label for="role" class="block text-gray-700 font-semibold mb-1">Role</label>
                <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    <option value="viewer" <?php echo $user['role'] === 'viewer' ? 'selected' : ''; ?>>viewer</option>
                    <option value="analyst" <?php echo $user['role'] === 'analyst' ? 'selected' : ''; ?>>analyst</option>
                    <option value="super_admin" <?php echo $user['role'] === 'super_admin' ? 'selected' : ''; ?>>super_admin</option>
                </select>
            </div>
            <div id="permissions-section" class="mt-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Permissions</h3>
                <div class="flex flex-wrap gap-4">
                <?php foreach ($permissions as $perm): ?>
                    <label class="flex items-center space-x-2 text-gray-700">
                        <input
                            type="checkbox"
                            name="permissions[]"
                            value="<?php echo htmlspecialchars($perm['id']); ?>"
                            <?php echo in_array($perm['id'], $assignedPermissionIds) ? 'checked' : ''; ?>
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-400"
                        >
                        <span><?php echo htmlspecialchars($perm['name']); ?></span>
                    </label>
                <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded transition">Save Changes</button>
        </form>
        <p class="mt-6 text-center text-sm">
            <a href="/users" class="text-blue-600 hover:underline">Back to User Management</a>
        </p>
    </div>
    <script>
        const roleSelect = document.getElementById('role');
        const permissionsSection = document.getElementById('permissions-section');
        function togglePermissions() {
            if (roleSelect.value === 'analyst') {
                permissionsSection.style.display = 'block';
            } else {
                permissionsSection.style.display = 'none';
            }
        }
        roleSelect.addEventListener('change', togglePermissions);
        // run on initial page load
        togglePermissions();
    </script>
</body>
</html>