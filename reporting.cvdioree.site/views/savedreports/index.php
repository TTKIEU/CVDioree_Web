<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Saved Reports</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-xl border border-gray-100">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-12 h-12 text-blue-500 mb-2 mx-auto block" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M8 12l2 2 4-4" />
            </svg>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center tracking-tight">Saved Reports</h1>
        </div>
        <div class="text-gray-600 text-center mb-4">
            Logged in as: <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span> |
            Role: <span class="font-medium text-green-600"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
        </div>
        <nav class="mb-6 text-center">
            <a href="/dashboard" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Go Back</a>
        </nav>
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Available Categories</h2>
        <ul class="flex flex-col gap-4 mb-6">
            <li>
                <a href="/savedreports/technical" class="block bg-blue-50 border border-blue-100 rounded-xl px-6 py-4 text-lg font-semibold text-blue-800 hover:bg-blue-100 hover:text-blue-900 transition-all shadow-sm text-center">Technical Reports</a>
            </li>
            <li>
                <a href="/savedreports/behavioral" class="block bg-blue-50 border border-blue-100 rounded-xl px-6 py-4 text-lg font-semibold text-blue-800 hover:bg-blue-100 hover:text-blue-900 transition-all shadow-sm text-center">Behavioral Reports</a>
            </li>
            <li>
                <a href="/savedreports/performance" class="block bg-blue-50 border border-blue-100 rounded-xl px-6 py-4 text-lg font-semibold text-blue-800 hover:bg-blue-100 hover:text-blue-900 transition-all shadow-sm text-center">Performance Reports</a>
            </li>
        </ul>
        <p class="text-gray-700 text-center">This page represents saved report views that a viewer is allowed to access.</p>
    </div>
</body>
</html>