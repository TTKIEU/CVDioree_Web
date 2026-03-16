<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Live Reports</title>
</head>
<body>
    <h1>Live Reports</h1>

    <p>
        Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> |
        Role: <?php echo htmlspecialchars($_SESSION['role']); ?>
    </p>

    <nav>
        <a href="/dashboard">Go Back</a>
    </nav>

    <h2>Available Reports</h2>
    <ul>
        <li><a href="/livereports/activity_logs">Activity Log</a></li>
        <li><a href="/livereports/charts">Event Charts</a></li>
    </ul>
    <h1>Analyst Command Center</h1>
    <p>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></p>
    <nav><a href="/dashboard">« Back to Dashboard</a></nav>
<div class="section behavioral">
        <h2>Category 1: Behavioral Analysis</h2>
        <p>Focus: User interaction patterns and event frequencies.</p>
        <form action="" method="POST">
            <input type="hidden" name="category" value="behavioral">
            <input type="hidden" name="report_name" value="Behavioral Analysis Snapshot">
            <textarea name="comments" rows="3" placeholder="Enter analyst decoding..." required></textarea>
            <button type="submit">Save & Export Behavioral PDF</button>
        </form>
    </div>

    <div class="section technical">
        <h2>Category 2: Technical Metrics</h2>
        <p>Focus: Browser distribution and system environments.</p>
        <form action="" method="POST">
            <input type="hidden" name="category" value="technical">
            <input type="hidden" name="report_name" value="Technical Metric Snapshot">
            <textarea name="comments" rows="3" placeholder="Enter analyst decoding..." required></textarea>
            <button type="submit" style="background:#17a2b8;">Save & Export Technical PDF</button>
        </form>
    </div>

    <div class="section performance">
        <h2>Category 3: Performance & Latency</h2>
        <p>Focus: Page load speeds and server response times.</p>
        <form action="" method="POST">
            <input type="hidden" name="category" value="performance">
            <input type="hidden" name="report_name" value="Performance Latency Snapshot">
            <textarea name="comments" rows="3" placeholder="Enter analyst decoding..." required></textarea>
            <button type="submit" style="background:#ffc107; color:#333;">Save & Export Performance PDF</button>
        </form>
    </div>
</body>
</html>
