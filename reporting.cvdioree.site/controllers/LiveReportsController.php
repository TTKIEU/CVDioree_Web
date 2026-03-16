<?php
require_once __DIR__ . '/BaseController.php';

class LiveReportsController extends BaseController {

    public function index() {

        $this->requireRole(['super_admin', 'analyst']);

        require __DIR__ . '/../views/livereports/index.php';
    }

}