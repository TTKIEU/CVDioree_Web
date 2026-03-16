<?php
require_once __DIR__ . '/BaseController.php';

class ReportController extends BaseController {
    public function index() {
        $this->requireLogin();
        require __DIR__ . '/../views/savedreports/index.php';
    }

    public function performance() {
        $this->requireLogin();
        require __DIR__ . '/../views/savedreports/performance/index.php';
    }

    public function behavioral() {
        $this->requireLogin();
        require __DIR__ . '/../views/savedreports/behavioral/index.php';
    }

    public function technical() {
        $this->requireLogin();
        require __DIR__ . '/../views/savedreports/technical/index.php';
    }
}
