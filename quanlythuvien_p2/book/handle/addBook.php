<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (
        !empty($_POST["book_name"]) &&
        !empty($_POST["category_id"]) &&
        !empty($_POST["author_code"]) &&
        !empty($_POST["publisher"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["image"]) &&
        !empty($_POST["quantity"])
    ) {
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();

            $stmt = $conn->prepare('INSERT INTO books (book_name, category_id, author_code, publisher, price, image, quantity) VALUES (:book_name, :category_id, :author_code, :publisher, :price, :image, :quantity)');

            $stmt->bindParam(':book_name', $book_name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':author_code', $author_code);
            $stmt->bindParam(':publisher', $publisher);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':quantity', $quantity);

            $book_name = trim($_POST["book_name"]);
            $category_id = trim($_POST["category_id"]);
            $author_code = trim($_POST["author_code"]);
            $publisher = trim($_POST["publisher"]);
            $price = trim($_POST["price"]);
            $image = trim($_POST["image"]);
            $quantity = trim($_POST["quantity"]);

            $stmt->execute();

            header("Location: ../../index.php?action=get_add_form_books&err=thêm thành công");
            exit;
        } catch (Exception $e) {
            $err = $e->getMessage();
            header("Location: ../../index.php?action=get_add_form_books&err=$err");
            exit;
        }
    } else {
        header("Location: ../../index.php?action=get_add_form_books&err=thiếu dữ liệu");
        exit;
    }
}
