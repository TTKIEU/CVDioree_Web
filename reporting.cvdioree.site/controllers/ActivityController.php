<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Activity.php';

class ActivityController extends BaseController {
    public function index() {
        $this->requirePermission('view_activity');

        $activityModel = new Activity();
        $rows = $activityModel->getAll(100);

        require __DIR__ . '/../views/livereports/activity_logs/table.php';
    }
}