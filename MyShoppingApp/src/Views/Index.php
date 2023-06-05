<?php

namespace MyShoppingApp\Views;

class Index
{
    private $errorMessage;
    private $items;

    public function __construct(string $errorMessage, array $items)
    {
        $this->errorMessage = $errorMessage;
        $this->items = $items;
    }

    public function render()
    {
?>
        <!DOCTYPE html>
        <html>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <head>
            <title>Shopping List</title>
        </head>

        <body class="container">

            <h1>Shopping List</h1>
            <hr/>

            <?php if ($this->errorMessage) : ?>
                <p style="color: red;"><?php echo $this->errorMessage; ?></p>
            <?php endif; ?>

            <p class="alert p-0 m-0 mb-2 alert-sm alert-info text-center">Add New Item to List</p>

            <form method="post" action="index.php?action=add" class="row g-3 align-items-center">
                <div class="col">
                    <input type="text" class="form-control" name="item" placeholder="Enter item name" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Add Item</button>
                </div>
            </form>
            <hr class="my-3" />
            <?php if (!empty($this->items)) : ?>
                <ul class="list-group">
                    <?php foreach ($this->items as $item) : ?>
                        <li class="<?php echo $item['checked'] ? 'text-success' : ''; ?>  list-group-item d-flex justify-content-between align-items-center">

                            <form method="post" action="index.php?action=check&id=<?php echo $item['id']; ?>" style="display: inline;">
                                <input name="checked" onchange="this.form.submit()" class="form-check-input me-1" type="checkbox" value="<?php echo !$item['checked']; ?>" <?php echo $item['checked'] ? "checked" : ''  ?>>

                                <label class="form-check-label">
                                    <?php echo $item['item_name']; ?>
                                </label>
                            </form>

                            <span>
                                <form method="post" action="index.php?action=edit&id=<?php echo $item['id']; ?>" style="display: inline;">
                                    <input type="text" class="rounded" name="item" value="<?php echo $item['item_name']; ?>" required>
                                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</button>
                                </form>

                                <form method="post" action="index.php?action=delete&id=<?php echo $item['id']; ?>" style="display: inline;">
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Remove</button>
                                </form>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No items in the shopping list.</p>
            <?php endif; ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        </body>

        </html>
<?php
    }
}
