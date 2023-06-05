<?php

namespace MyShoppingApp\Models;

interface ShoppingListInterface
{
    public function addItem(string $item);
    
    public function checkItem(int $id, bool $checked);
    
    public function editItem(int $id, string $item);
    
    public function deleteItem(int $id);
    
    public function getItems(): array;
    
    public function getErrorMessage(): string;
}
