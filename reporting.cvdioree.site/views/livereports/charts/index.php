<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Activity Charts</h1>

    <nav>
        <a href="/livereports">Go Back</a>
    </nav>

    <br>

    <canvas id="eventChart" width="600" height="300"></canvas>

    <script>
        const ctx = document.getElementById('eventChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Event Count',
                    data: <?php echo json_encode($data); ?>
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>