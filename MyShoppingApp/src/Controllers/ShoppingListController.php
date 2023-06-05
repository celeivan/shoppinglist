<?php

namespace MyShoppingApp\Controllers;

use MyShoppingApp\Models\ShoppingListInterface;

class ShoppingListController
{
    private $model;

    public function __construct(ShoppingListInterface $model)
    {
        $this->model = $model;
    }

    public function addItem(string $item)
    {
        $this->model->addItem($item);
    }

    public function checkItem(int $id, bool $checked)
    {
        $this->model->checkItem($id, $checked);
    }

    public function editItem(int $id, string $item)
    {
        $this->model->editItem($id, $item);
    }

    public function deleteItem(int $id)
    {
        $this->model->deleteItem($id);
    }

    public function getItems(): array
    {
        return $this->model->getItems();
    }

    public function getErrorMessage(): string
    {
        return $this->model->getErrorMessage();
    }
}
