<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Technical Reports</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-100 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-2xl border border-gray-100">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-12 h-12 text-blue-500 mb-2 mx-auto block" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M8 12l2 2 4-4" />
            </svg>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center tracking-tight">Technical Reports</h1>
        </div>
        <nav class="mb-4">
            <a href="/savedreports" class="text-blue-600 hover:text-blue-800 font-semibold transition">&laquo; Back to All Categories</a>
        </nav>
        <hr class="mb-6">
        <div>
        <?php 
        // Look in the current directory for PDF files
        $files = glob("*.pdf"); 

        if (!empty($files)): 
            // Sort files so the newest is on top
            array_multisort(array_map('filemtime', $files), SORT_DESC, $files);

            foreach ($files as $file): 
        ?>
            <div class="flex flex-col md:flex-row md:items-center justify-between bg-blue-50 border border-blue-100 rounded-xl shadow-sm px-6 py-4 mb-4 transition-all">
                <div class="mb-2 md:mb-0">
                    <strong class="text-lg text-blue-900"><?php echo htmlspecialchars($file); ?></strong><br>
                    <span class="text-gray-500 text-sm">Generated on: <?php echo date("F d, Y H:i", filemtime($file)); ?></span>
                </div>
                <a href="<?php echo htmlspecialchars($file); ?>" class="bg-gradient-to-r from-blue-500 to-purple-400 hover:from-blue-600 hover:to-purple-500 text-white font-bold px-6 py-2 rounded-full shadow-md transition-all text-base" target="_blank">Open PDF</a>
            </div>
        <?php 
            endforeach; 
        else: 
        ?>
            <div class="flex flex-col items-center justify-center py-12">
                <svg class="w-16 h-16 text-blue-200 mb-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9 10h.01M15 10h.01M8 16c1.333-1 4.667-1 6 0" />
                </svg>
                <div class="text-blue-700 bg-blue-50 border border-blue-200 rounded-xl px-6 py-4 text-center text-lg font-semibold shadow-sm">
                    No static reports have been saved in this category yet.
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
