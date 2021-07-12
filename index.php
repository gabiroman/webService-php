<?php
include 'db.php';

$pdo = new Db();

//Show
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $pdo->show("SELECT * FROM products WHERE id=?", [$_GET['id']]);
    } else {
        $pdo->index("SELECT * FROM products");
    }
}
//Insert
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo->store(
        "INSERT INTO products (name, price, description) VALUES(?, ?, ?)",
        [$_POST['name'], $_POST['price'], $_POST['description']]
    );
}
//Update
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $pdo->update(
        "UPDATE products SET name=?, price=?, description=? WHERE id=?",
        [$_GET['name'], $_GET['price'], $_GET['description'], $_GET['id']]
    );
}

//Delete
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $pdo->destroy("DELETE FROM products WHERE id=?", [$_GET['id']]);
}

header("HTTP/1.1 400 Bad Request");
