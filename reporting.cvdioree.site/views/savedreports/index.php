<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Saved Reports</title>
</head>
<body>
    <h1>Saved Reports</h1>

    <p>
        Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> |
        Role: <?php echo htmlspecialchars($_SESSION['role']); ?>
    </p>

    <nav>
        <a href="/dashboard">Go Back</a>
    </nav>

    <h2>Available Categories</h2>
    <ul>
        <li><a href="/savedreports/technical">Technical Reports</a></li>
        <li><a href="/savedreports/behavioral">Behavioral Reports</a></li>
        <li><a href="/savedreports/performance">Performance Reports</a></li>
    </ul>

    <p>This page represents saved report views that a viewer is allowed to access.</p>
</body>
</html>