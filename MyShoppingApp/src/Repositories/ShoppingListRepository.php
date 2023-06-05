<?php

namespace MyShoppingApp\Repositories;

use MyShoppingApp\DatabaseConnection;
use MyShoppingApp\Models\ShoppingListInterface;
use PDO;

class ShoppingListRepository implements ShoppingListInterface
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function addItem(string $item)
    {
        $query = "INSERT INTO shopping_list (item_name, checked) VALUES (:item, 0)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':item', $item);
        $statement->execute();
    }

    public function checkItem(int $id, bool $checked)
    {
        $query = "UPDATE shopping_list SET checked = :checked WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':checked', $checked, PDO::PARAM_BOOL);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function editItem(int $id, string $item)
    {
        $query = "UPDATE shopping_list SET item_name = :item WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':item', $item);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteItem(int $id)
    {
        $query = "DELETE FROM shopping_list WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getItems(): array
    {
        $query = "SELECT * FROM shopping_list";
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getErrorMessage(): string
    {
        return ''; // Customise error message
    }
}
