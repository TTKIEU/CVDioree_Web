<?php
require_once __DIR__ . '/../config/database.php';

class Activity {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAll($limit = 100) {
        $stmt = $this->db->prepare("
            SELECT id, session_id, event_type, page_url, user_agent, screen_size, total_load_time, server_received_at
            FROM activity_log
            ORDER BY id DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventCounts() {
        $stmt = $this->db->query("
            SELECT event_type, COUNT(*) AS count
            FROM activity_log
            GROUP BY event_type
            ORDER BY count DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}