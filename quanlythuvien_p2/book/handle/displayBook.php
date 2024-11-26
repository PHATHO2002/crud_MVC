<h1>Books list</h1>
<table border="1">
    <thead>
        <tr>
            <th>Book Name</th>
            <th>Category</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Price</th>
            <th>Image</th>
        </tr>
    </thead>

    <tbody>
        <?php
        try {
            require_once(dirname(dirname(__DIR__)) . "/database/database.php");
            $conn = getDatabaseConnection();

            $stmt = $conn->prepare("SELECT * FROM books");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {

                $cateId = $row['category_id'];
                $stmtCategoryName = $conn->prepare("SELECT category_name FROM categories WHERE category_id = :cateId");
                $stmtCategoryName->bindParam(':cateId', $cateId);
                $stmtCategoryName->execute();
                $CategoryName = $stmtCategoryName->fetch(PDO::FETCH_ASSOC);


                $authorCode = $row['author_code'];
                $stmtAuthorName = $conn->prepare("SELECT author_name FROM authors WHERE author_code = :authorCode");
                $stmtAuthorName->bindParam(':authorCode', $authorCode);
                $stmtAuthorName->execute();
                $AuthorName = $stmtAuthorName->fetch(PDO::FETCH_ASSOC);

                $book_name = $row["book_name"];
                $book_id = $row["book_id"];
                $category_name = $CategoryName["category_name"];
                $author_name = $AuthorName["author_name"];
                $publisher = $row["publisher"];
                $price = $row["price"];
                $image = $row["image"];

                echo "<tr>
                <td>$book_name</td>
                <td>$category_name</td>
                <td>$author_name</td>
                <td>$publisher</td>
                <td>$price</td>
                <td><img src='$image' alt='$book_name' width='100'></td>
                <td>  <a href='index.php?action=get_edit_form_update_book&book_id=$book_id'>update</a></td>
                <td>  <a href='book/handle/deleteBook.php?deleteId=$book_id'>delete</a></td>            
                </tr>";
            }
        } catch (Exception $e) {
            echo "An error occurred while displaying books: " . $e->getMessage();
        }
        ?>
    </tbody>
</table>
<a href="index.php?action=get_form_add_book">Add new Book</a>