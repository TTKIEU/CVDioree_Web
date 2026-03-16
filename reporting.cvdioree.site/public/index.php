<?php
session_start();

$url = $_GET['url'] ?? 'login';
$url = trim($url, '/');

switch ($url) {
    case '':
    case 'login':
        require_once __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'signup':
        require_once __DIR__ . '/../controllers/SignupController.php';
        $controller = new SignupController();
        $controller->index();
        break;

    case 'logout':
        require_once __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    case 'dashboard':
        require_once __DIR__ . '/../controllers/DashboardController.php';
        (new DashboardController())->index();
        break;

    case 'livereports/activity_logs':
        require_once __DIR__ . '/../controllers/ActivityController.php';
        (new ActivityController())->index();
        break;

    case 'livereports/charts':
        require_once __DIR__ . '/../controllers/ChartController.php';
        (new ChartController())->index();
        break;


    case 'savedreports':
        require_once __DIR__ . '/../controllers/ReportController.php';
        (new ReportController())->index();
        break;

    case 'savedreports/performance':
        require_once __DIR__ . '/../controllers/ReportController.php';
        (new ReportController())->performance();
        break;

    case 'savedreports/behavioral':
        require_once __DIR__ . '/../controllers/ReportController.php';
        (new ReportController())->behavioral();
        break;

    case 'savedreports/technical':
        require_once __DIR__ . '/../controllers/ReportController.php';
        (new ReportController())->technical();
        break;

    case 'users':
        require_once __DIR__ . '/../controllers/UserManagementController.php';
        (new UserManagementController())->index();
        break;

    case 'users/edit':
        require_once __DIR__ . '/../controllers/UserManagementController.php';
        (new UserManagementController())->edit();
        break;

    case 'users/update':
        require_once __DIR__ . '/../controllers/UserManagementController.php';
        (new UserManagementController())->update();
        break;

    case 'users/delete':
        require_once __DIR__ . '/../controllers/UserManagementController.php';
        (new UserManagementController())->delete();
        break;

    case 'livereports':
        require_once __DIR__ . '/../controllers/LiveReportsController.php';
        (new LiveReportsController())->index();
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
        exit;
}