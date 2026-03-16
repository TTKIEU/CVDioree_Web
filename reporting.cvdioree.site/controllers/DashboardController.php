<?php
require_once __DIR__ . '/BaseController.php';

class DashboardController extends BaseController {
    public function index() {
        $this->requireLogin();
        require __DIR__ . '/../views/dashboard/index.php';
    }
}