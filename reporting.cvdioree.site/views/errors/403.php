<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>403 Forbidden</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border border-gray-100 flex flex-col items-center">
        <svg class="w-14 h-14 text-red-500 mb-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <line x1="9" y1="9" x2="15" y2="15" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
            <line x1="15" y1="9" x2="9" y2="15" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        </svg>
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center tracking-tight">403 Forbidden</h1>
        <p class="text-gray-700 text-center mb-6">You do not have permission to access this page.</p>
        <a href="/login" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Go Home</a>
    </div>
</body>
</html>