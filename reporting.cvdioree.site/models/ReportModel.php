<?php
class ReportModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getLiveSummary() {
        $query = "SELECT event_type, COUNT(*) as count FROM activity_log GROUP BY event_type";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveAnalystComment($reportName, $comments) {
        $stmt = $this->db->prepare("INSERT INTO analyst_reports (report_name, analyst_comments) VALUES (?, ?)");
        return $stmt->execute([$reportName, $comments]);
    }

    public function getLatestComment() {
        $query = "SELECT * FROM analyst_reports ORDER BY created_at DESC LIMIT 1";
        return $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
    }
}
