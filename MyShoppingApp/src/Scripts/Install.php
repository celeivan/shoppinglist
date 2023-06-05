<?php

namespace MyShoppingApp\Scripts;

use MyShoppingApp\DatabaseConnection;

class Install
{
    private $database;

    public function __construct(DatabaseConnection $database)
    {
        $this->database = $database;
    }

    public function run()
    {
        $this->createShoppingListTable();
        $this->seedShoppingListTable();
    }

    private function createShoppingListTable()
    {
        $connection = $this->database->getConnection();
        $tableName = 'shopping_list';

        $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
            `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
            `item_name` VARCHAR(255) NOT NULL,
            `checked` TINYINT(1) NOT NULL DEFAULT 0,
            `fav` TINYINT(1) NOT NULL DEFAULT 0
        )";

        $connection->exec($sql);
        $connection->exec("TRUNCATE $tableName");
    }

    private function seedShoppingListTable()
    {
        $connection = $this->database->getConnection();
        $tableName = 'shopping_list';

        $items = [
            "Eggs",
            "Milk",
            "Bread",
            "Apples",
            "Bananas",
            "Chicken",
            "Rice",
            "Pasta",
            "Tomatoes",
            "Onions"
        ];

        foreach ($items as $item) {
            $itemName = $connection->quote($item);
            $checked = (int) rand(0, 1);

            $sql = "INSERT INTO $tableName (`item_name`, `checked`) VALUES ($itemName, $checked)";
            $connection->exec($sql);
        }
    }
}
