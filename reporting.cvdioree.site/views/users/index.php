<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>User Management</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
</head>
</body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100 py-10">
        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-4xl border border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2 md:mb-0 text-center md:text-left tracking-tight">User Management</h1>
                <div class="text-gray-600 text-center md:text-right">
                    Logged in as: <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span> |
                    Role: <span class="font-medium text-green-600"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                </div>
            </div>
            <?php if (!empty($_SESSION['user_error'])): ?>
                <div class="mb-6">
                    <div class="text-red-700 bg-red-50 border border-red-200 rounded px-4 py-3 text-center text-sm font-medium">
                        <?php echo htmlspecialchars($_SESSION['user_error']); unset($_SESSION['user_error']); ?>
                    </div>
                </div>
            <?php endif; ?>
            <nav class="mb-6">
                <a href="/dashboard" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Go Back</a>
            </nav>
            <div class="overflow-x-auto">
                <?php if (empty($users)): ?>
                    <div class="flex flex-col items-center justify-center py-16">
                        <svg class="w-16 h-16 text-blue-200 mb-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9 10h.01M15 10h.01M8 16c1.333-1 4.667-1 6 0" />
                        </svg>
                        <div class="text-blue-700 bg-blue-50 border border-blue-200 rounded-xl px-6 py-4 text-center text-lg font-semibold shadow-sm">
                            There are no users to display or edit.
                        </div>
                    </div>
                <?php else: ?>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Username</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Created At</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Edit</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php foreach ($users as $u): ?>
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-800"><?php echo htmlspecialchars($u['id']); ?></td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-800"><?php echo htmlspecialchars($u['username']); ?></td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <?php
                                    $role = $u['role'];
                                    $roleClass = match($role) {
                                        'super_admin' => 'bg-red-100 text-red-700',
                                        'analyst' => 'bg-green-100 text-green-700',
                                        'viewer' => 'bg-blue-100 text-blue-700',
                                        default => 'bg-gray-200 text-gray-800',
                                    };
                                ?>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?php echo $roleClass; ?>">
                                    <?php echo htmlspecialchars($role); ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-600"><?php echo htmlspecialchars($u['created_at']); ?></td>
                            <td class="px-4 py-2 text-center">
                                <a href="/users/edit?id=<?php echo urlencode($u['id']); ?>" class="text-blue-600 hover:text-blue-800 font-semibold transition">Edit</a>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <form method="POST" action="/users/delete" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($u['id']); ?>">
                                    <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 font-semibold px-3 py-1 rounded transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>