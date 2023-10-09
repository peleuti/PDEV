<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'app/controllers/UserController.php';
require_once 'app/models/UserModel.php';

// Roteamento - Determine a ação com base no método HTTP.
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET') {
    // Solicitações GET, como links e visualizações de formulários
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
} elseif ($method === 'POST') {
    // Solicitações POST
    $action = isset($_POST['action']) ? $_POST['action'] : 'index';
}

// Instancia do controlador
switch ($action) {
    case 'index':
        $controller = new UserController();
        $controller->index();
        break;
    case 'edit':
        $controller = new UserController();
        $controller->edit();
        break;
    case 'delete':
        $controller = new UserController();
        $controller->delete();
        break;
    case 'update':
        $controller = new UserController();
        $controller->update();
        break;
    case 'add':
        $controller = new UserController();
        $controller->add();
        break;
    case 'create':
        $controller = new UserController();
        $controller->create();
        break;
    case 'add_cores':
        $controller = new UserController();
        $controller->add_cores();
        break;
    case 'add_cor':
        $controller = new UserController();
        $controller->add_cor();
        break;
    default:
        // Lida com ações desconhecidas ou inválidas aqui.
        echo 'Ação inválida.';
        break;
}
