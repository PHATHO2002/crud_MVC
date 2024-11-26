<?php


try {
    require_once(dirname(dirname(__DIR__)) . "/database/database.php");
    $conn = getDatabaseConnection();
    $categoryStmt = $conn->prepare("SELECT category_id,category_name FROM categories");
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
    $authorStmt = $conn->prepare("SELECT author_code,author_name FROM authors");
    $authorStmt->execute();
    $authors = $authorStmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<h1>ADD BOOK</h1>';
    echo '<form action="book/handle/addBook.php" method="POST">';
    echo '<div class="">';
    echo '<label for="book_name">name</label>';
    echo '<input name="book_name" type="text" >';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="category_id">category</label>';
    echo '<select name="category_id">';
    foreach ($categories as $category) {
        echo "<option value='" . $category['category_id'] . "'>" . $category['category_name'] . "</option>";
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="author_code">author</label>';
    echo '<select name="author_code">';
    foreach ($authors as $author) {
        echo "<option value='" . $author['author_code'] . "'>" . $author['author_name'] . "</option>";
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="publisher">publisher</label>';
    echo '<input name="publisher" type="text" " required>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="price">price</label>';
    echo '<input name="price" type="text" " required>';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="image">image</label>';
    echo '<input name="image" type="text" >';
    echo '</div>';
    echo '<div class="">';
    echo '<label for="quantity">quantity</label>';
    echo '<input name="quantity" type="number" >';
    echo '</div>';
    echo '<input type="submit" name="action" value="ADD">';
    echo '</form>';

    if (isset($_GET['err'])) {
        $err = $_GET['err'];
        echo "<p>$err</p>";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
