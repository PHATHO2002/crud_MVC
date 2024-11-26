<?php

try {
    require_once(dirname(dirname(__DIR__)) . "/database/database.php");
    $conn = getDatabaseConnection();


    if (isset($_GET['book_id'])) {
        $bookId = $_GET['book_id'];
        $bookStmt = $conn->prepare("SELECT * FROM books WHERE book_id = :book_id");
        $bookStmt->execute([':book_id' => $bookId]);
        $book = $bookStmt->fetch(PDO::FETCH_ASSOC);
    }


    $categoryStmt = $conn->prepare("SELECT category_id, category_name FROM categories");
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    $authorStmt = $conn->prepare("SELECT author_code, author_name FROM authors");
    $authorStmt->execute();
    $authors = $authorStmt->fetchAll(PDO::FETCH_ASSOC);


    echo '<h1>Edit Book</h1>';
    echo '<form action="book/handle/editBook.php" method="POST">';
    echo '<input type="hidden" name="book_id" value="' . $book['book_id'] . '">'; // ID của sách
    echo '<div class="">';
    echo '<label for="book_name">Book Name</label>';
    echo '<input name="book_name" type="text" value="' . $book['book_name'] . '" required>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="category_id">Category</label>';
    echo '<select name="category_id" required>';
    foreach ($categories as $category) {
        $selected = ($category['category_id'] == $book['category_id']) ? 'selected' : '';
        echo "<option value='" . $category['category_id'] . "' $selected>" . $category['category_name'] . "</option>";
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="author_code">Author</label>';
    echo '<select name="author_code" required>';
    foreach ($authors as $author) {

        $selected = ($author['author_code'] == $book['author_code']) ? 'selected' : '';
        echo "<option value='" . $author['author_code'] . "' $selected>" . $author['author_name'] . "</option>";
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="publisher">Publisher</label>';
    echo '<input name="publisher" type="text" value="' . $book['publisher'] . '" required>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="price">Price</label>';
    echo '<input name="price" type="text" value="' . $book['price'] . '" required>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="image">Image</label>';
    echo '<input name="image" type="text" value="' . $book['image'] . '" required>';
    echo '</div>';
    echo '<input type="submit" name="action" value="Update">';
    echo '</form>';


    if (isset($_GET['err'])) {
        $err = $_GET['err'];
        echo "<p>$err</p>";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
