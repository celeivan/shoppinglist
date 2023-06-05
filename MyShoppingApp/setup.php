<?php

require_once 'vendor/autoload.php';

use MyShoppingApp\DatabaseConnection;
use MyShoppingApp\Scripts\Install;

// Establish a shared database connection
$database = new DatabaseConnection();

// Run the installation script
$installer = new Install($database);
$installer->run();

echo "Setup completed successfully.";