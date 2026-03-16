<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Live Reports</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-3xl border border-gray-100">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-12 h-12 text-blue-500 mb-2 mx-auto block" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M8 12l2 2 4-4" />
            </svg>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center tracking-tight">Live Reports</h1>
        </div>
        <div class="text-gray-600 text-center mb-4">
            Logged in as: <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span> |
            Role: <span class="font-medium text-green-600"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
        </div>
        <nav class="mb-6 text-center">
            <a href="/dashboard" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Go Back</a>
        </nav>
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Available Reports</h2>
        <ul class="flex flex-col md:flex-row gap-4 mb-8 justify-center">
            <li>
                <a href="/livereports/activity_logs" class="block bg-blue-50 border border-blue-100 rounded-xl px-6 py-4 text-lg font-semibold text-blue-800 hover:bg-blue-100 hover:text-blue-900 transition-all shadow-sm text-center">Activity Log</a>
            </li>
            <li>
                <a href="/livereports/charts" class="block bg-blue-50 border border-blue-100 rounded-xl px-6 py-4 text-lg font-semibold text-blue-800 hover:bg-blue-100 hover:text-blue-900 transition-all shadow-sm text-center">Event Charts</a>
            </li>
        </ul>
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Analyst Command Center</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 border border-blue-100 rounded-xl shadow-sm px-6 py-6 flex flex-col">
                <h3 class="text-lg font-bold text-blue-900 mb-2">Category 1: Behavioral Analysis</h3>
                <p class="text-gray-600 mb-3">Focus: User interaction patterns and event frequencies.</p>
                <form action="" method="POST" class="flex flex-col gap-3 mt-auto">
                    <input type="hidden" name="category" value="behavioral">
                    <input type="hidden" name="report_name" value="Behavioral Analysis Snapshot">
                    <textarea name="comments" rows="3" placeholder="Enter analyst decoding..." required class="rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"></textarea>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg transition">Save & Export Behavioral PDF</button>
                </form>
            </div>
            <div class="bg-blue-50 border border-blue-100 rounded-xl shadow-sm px-6 py-6 flex flex-col">
                <h3 class="text-lg font-bold text-blue-900 mb-2">Category 2: Technical Metrics</h3>
                <p class="text-gray-600 mb-3">Focus: Browser distribution and system environments.</p>
                <form action="" method="POST" class="flex flex-col gap-3 mt-auto">
                    <input type="hidden" name="category" value="technical">
                    <input type="hidden" name="report_name" value="Technical Metric Snapshot">
                    <textarea name="comments" rows="3" placeholder="Enter analyst decoding..." required class="rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"></textarea>
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 rounded-lg transition">Save & Export Technical PDF</button>
                </form>
            </div>
            <div class="bg-blue-50 border border-blue-100 rounded-xl shadow-sm px-6 py-6 flex flex-col">
                <h3 class="text-lg font-bold text-blue-900 mb-2">Category 3: Performance & Latency</h3>
                <p class="text-gray-600 mb-3">Focus: Page load speeds and server response times.</p>
                <form action="" method="POST" class="flex flex-col gap-3 mt-auto">
                    <input type="hidden" name="category" value="performance">
                    <input type="hidden" name="report_name" value="Performance Latency Snapshot">
                    <textarea name="comments" rows="3" placeholder="Enter analyst decoding..." required class="rounded-lg border border-gray-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"></textarea>
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 rounded-lg transition">Save & Export Performance PDF</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
