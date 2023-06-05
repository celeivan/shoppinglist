<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MyShoppingApp\Controllers\ShoppingListController;
use MyShoppingApp\DatabaseConnection;
use MyShoppingApp\Models\ShoppingList;
use MyShoppingApp\Repositories\ShoppingListRepository;
use MyShoppingApp\Views\Index;

// Establish a shared database connection
$database = new DatabaseConnection();


// Create instances of the dependencies
$repository = new ShoppingListRepository($database);
$model = new ShoppingList($repository);
$controller = new ShoppingListController($model);

// Handle the actions
$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $item = $_POST['item'];
        $controller->addItem($item);
    } elseif ($action === 'check') {
        $id = $_GET['id'];
        $checked = isset($_POST['checked']) ? (bool)$_POST['checked'] : false;
        $controller->checkItem($id, $checked);
    } elseif ($action === 'edit') {
        $id = $_GET['id'];
        $item = $_POST['item'];
        $controller->editItem($id, $item);
    } elseif ($action === 'delete') {
        $id = $_GET['id'];
        $controller->deleteItem($id);
    }

    header('Location: /');
    exit();
}

// Get the updated items and error message
$items = $controller->getItems();
$errorMessage = $controller->getErrorMessage();

// Render the view
$view = new Index($errorMessage, $items);
$view->render();
