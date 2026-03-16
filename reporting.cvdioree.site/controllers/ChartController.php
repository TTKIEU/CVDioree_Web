<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Activity.php';

class ChartController extends BaseController {
    public function index() {
        $this->requirePermission('view_charts');

        $activityModel = new Activity();
        $counts = $activityModel->getEventCounts();

        $labels = [];
        $data = [];

        foreach ($counts as $row) {
            $labels[] = $row['event_type'];
            $data[] = (int)$row['count'];
        }

        require __DIR__ . '/../views/livereports/charts/index.php';
    }
}