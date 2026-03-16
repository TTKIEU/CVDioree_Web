<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-2xl mt-10 border border-gray-100">
        <div class="flex flex-col items-center mb-4">
            <!-- Logo/Icon Placeholder -->
            <svg class="w-14 h-14 text-blue-500 mb-2 mx-auto block" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M8 12l2 2 4-4" />
            </svg>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2 text-center tracking-tight">Analytics Dashboard</h1>
        </div>

        <p class="text-gray-600 mb-4 text-center text-lg">
            Welcome, <span class="font-semibold text-blue-600 hover:underline cursor-pointer"><?php echo htmlspecialchars($_SESSION['username']); ?></span>.<br>
            <span class="text-base">Role: <span class="font-medium text-green-600"><?php echo htmlspecialchars($_SESSION['role']); ?></span></span>
        </p>

        <hr class="my-4 border-t border-gray-200">

        <nav class="flex justify-center mb-6">
            <ul class="flex flex-wrap justify-center gap-6 md:gap-10">
                <li><a href="/dashboard" class="transition-colors duration-200 text-blue-600 hover:text-blue-800 font-semibold px-2 py-1 rounded hover:bg-blue-50">Dashboard</a></li>
                <li><a href="/users" class="transition-colors duration-200 text-blue-600 hover:text-blue-800 font-semibold px-2 py-1 rounded hover:bg-blue-50">User Management</a></li>
                <li><a href="/livereports" class="transition-colors duration-200 text-blue-600 hover:text-blue-800 font-semibold px-2 py-1 rounded hover:bg-blue-50">Live Reports</a></li>
                <li><a href="/savedreports" class="transition-colors duration-200 text-blue-600 hover:text-blue-800 font-semibold px-2 py-1 rounded hover:bg-blue-50">Saved Reports</a></li>
                <li><a href="/logout" class="transition-colors duration-200 text-red-500 hover:text-white hover:bg-red-500 font-semibold px-2 py-1 rounded">Logout</a></li>
            </ul>
        </nav>

        <p class="text-gray-700 text-center text-base mt-2">This is the protected dashboard landing page.</p>
    </div>
</body>
</html>