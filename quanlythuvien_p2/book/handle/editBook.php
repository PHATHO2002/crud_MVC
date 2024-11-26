<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["book_id"])) {
        $id = $_POST["book_id"];
        if (!empty($_POST["book_name"]) && !empty($_POST["category_id"]) && !empty($_POST["author_code"]) && !empty($_POST["publisher"]) && !empty($_POST["price"])) {
            try {
                require_once(dirname(dirname(__DIR__)) . "/database/database.php");
                $conn = getDatabaseConnection();
                $stmt = $conn->prepare('UPDATE books SET book_name = :book_name, category_id = :category_id, author_code = :author_code, publisher = :publisher, price = :price, image = :image WHERE book_id = :book_id');

                $stmt->bindParam(':book_name', $book_name);
                $stmt->bindParam(':category_id', $category_id);
                $stmt->bindParam(':author_code', $author_code);
                $stmt->bindParam(':publisher', $publisher);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':book_id', $book_id);

                $book_name = trim($_POST["book_name"]);
                $category_id = trim($_POST["category_id"]);
                $author_code = trim($_POST["author_code"]);
                $publisher = trim($_POST["publisher"]);
                $price = trim($_POST["price"]);
                $image = trim($_POST["image"]);
                $book_id = trim($_POST["book_id"]);

                $stmt->execute();

                header("Location: ../../index.php?action=get_edit_form_update_book&book_id=$book_id&err=update thành công");
                exit;
            } catch (Exception $e) {
                $err = $e->getMessage();
                header("Location: ../../index.php?action=get_edit_form_update_book&book_id=$book_id&err=$err");
                exit;
            }
        } else {

            header("Location: ../../index.php?action=get_edit_form_update_book&book_id=$book_id&err=thiếu dữ liệu");
            exit;
        }
    } else {

        header("Location: ../../index.php?action=get_edit_form_update_book&book_id=$book_id&err=thiếu id");
        exit;
    }
}
