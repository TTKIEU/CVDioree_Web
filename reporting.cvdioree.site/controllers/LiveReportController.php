<?php
require_once __DIR__ . '/BaseController.php';

class LiveReportController extends BaseController {

    public function index() {
        $this->requireLogin();
        
        $conn = $this->db;
        $data = [];

        // Category 1: Behavioral
        $res1 = $conn->query("SELECT event_type, COUNT(*) as count FROM activity_log GROUP BY event_type");
        $data['behavioral_summary'] = $res1->fetch_all(MYSQLI_ASSOC);

        // Category 2: Technical
        $res2 = $conn->query("SELECT browser, COUNT(*) as count FROM activity_log GROUP BY browser");
        $data['technical_summary'] = $res2->fetch_all(MYSQLI_ASSOC);

        // Category 3: Performance
        $res3 = $conn->query("SELECT path, AVG(load_time) as avg_time FROM performance_log GROUP BY path");
        $data['performance_summary'] = $res3->fetch_all(MYSQLI_ASSOC);

        require __DIR__ . '/../views/livereports/index.php';
    }
    public function saveComment() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /controllers/LiveReportController.php?action=index");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $reportName = $_POST['report_name'] ?? 'Live Snapshot';
        $comments = $_POST['comments'] ?? '';
        $category = $_POST['category'] ?? 'general';

        $conn = $this->db;
        $stmt = $conn->prepare("INSERT INTO saved_reports (user_id, report_name, category, analyst_comments) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $reportName, $category, $comments);

    if ($stmt->execute()) {
    $rid = $stmt->insert_id; // Get the ID of the row we just saved
    $userId = $_SESSION['user_id'];
    $stmt->close();

    // This is the magic line that triggers the download
    header("Location: https://reporting.cvdioree.site/cgi-bin/export_report.py?uid=$userId&rid=$rid");
    exit();
}
     else {
            die("Error saving: " . $conn->error);
        }
    }
    public function activity_logs() {
        $this->requireLogin();
        $conn = $this->db;
        $res = $conn->query("SELECT * FROM activity_log ORDER BY timestamp DESC LIMIT 100");
        $data['logs'] = $res->fetch_all(MYSQLI_ASSOC);
        require __DIR__ . '/../views/livereports/activity_logs.php';
    }

    public function charts() {
        $this->requireLogin();
        // Add chart data fetching logic here if needed
        require __DIR__ . '/../views/livereports/charts.php';
    }
}
$controller = new LiveReportController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->saveComment();
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
