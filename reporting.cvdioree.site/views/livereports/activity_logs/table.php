<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Activity Table</title>
</head>
<body>
    <h1>Activity Log Table</h1>

    <nav>
        <a href="/livereports">Go Back</a>
    </nav>

    <br>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Session ID</th>
            <th>Event Type</th>
            <th>Page URL</th>
            <th>User Agent</th>
            <th>Screen Size</th>
            <th>Total Load Time</th>
            <th>Server Received At</th>
        </tr>

        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['session_id']); ?></td>
                <td><?php echo htmlspecialchars($row['event_type']); ?></td>
                <td><?php echo htmlspecialchars($row['page_url'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['user_agent'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['screen_size'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['total_load_time'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['server_received_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>