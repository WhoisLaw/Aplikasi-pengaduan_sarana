<?php
// Enable error reporting for debugging on Vercel
if (getenv('VERCEL') || getenv('DB_SSL')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once 'config/database.php';
require_once 'helpers/auth.php';

$database = new Database();
$db = $database->connect();

$page = $_GET['page'] ?? 'landing';

switch ($page) {
    case 'landing':
        require 'views/landing.php';
        break;

    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController($db);
        $controller->login();
        break;

    case 'register':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController($db);
        $controller->register();
        break;

    case 'logout':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController($db);
        $controller->logout();
        break;

    // Database Migration Route
    case 'migrate':
        require 'migrate.php';
        break;

    // Siswa Routes
    case 'siswa_dashboard':
        require_once 'controllers/SiswaController.php';
        $controller = new SiswaController($db);
        $controller->dashboard();
        break;

    case 'siswa_submit':
        require_once 'controllers/SiswaController.php';
        $controller = new SiswaController($db);
        $controller->createAspirasi();
        break;

    case 'siswa_lapor':
        require_once 'controllers/SiswaController.php';
        $controller = new SiswaController($db);
        $controller->lapor();
        break;

    case 'siswa_detail':
        require_once 'controllers/SiswaController.php';
        $controller = new SiswaController($db);
        $controller->detailAspirasi($_GET['id'] ?? 0);
        break;

    case 'siswa_hapus':
        require_once 'controllers/SiswaController.php';
        $controller = new SiswaController($db);
        $controller->hapusAspirasi();
        break;

    // Admin Routes
    case 'admin_dashboard':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->dashboard();
        break;

    case 'admin_list':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->listAspirasi();
        break;

    case 'admin_detail':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->detailAspirasi($_GET['id'] ?? 0);
        break;

    case 'admin_update_status':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->updateStatus();
        break;

    case 'admin_add_feedback':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->addFeedback();
        break;

    // Admin User Management Routes
    case 'admin_users':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->listUsers();
        break;

    case 'admin_user_add':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->addUser();
        break;

    case 'admin_user_store':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->storeUser();
        break;

    case 'admin_user_edit':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->editUser($_GET['id'] ?? 0);
        break;

    case 'admin_user_update':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->updateUser();
        break;

    case 'admin_user_delete':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController($db);
        $controller->deleteUser($_GET['id'] ?? 0);
        break;

    default:
        header("Location: index.php?page=login");
        break;
}
