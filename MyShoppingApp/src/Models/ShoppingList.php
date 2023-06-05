<?php

namespace MyShoppingApp\Models;

use MyShoppingApp\Repositories\ShoppingListRepository;

class ShoppingList implements ShoppingListInterface
{
    private $repository;

    public function __construct(ShoppingListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addItem(string $item)
    {
        $this->repository->addItem($item);
    }

    public function checkItem(int $id, bool $checked)
    {
        $this->repository->checkItem($id, $checked);
    }

    public function editItem(int $id, string $item)
    {
        $this->repository->editItem($id, $item);
    }

    public function deleteItem(int $id)
    {
        $this->repository->deleteItem($id);
    }

    public function getItems(): array
    {
        return $this->repository->getItems();
    }

    public function getErrorMessage(): string
    {
        return $this->repository->getErrorMessage();
    }
}
