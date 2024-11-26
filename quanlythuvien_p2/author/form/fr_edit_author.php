<?php
if (isset($_GET['updateCode'])) {

    try {
        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();
        $updateCode = $_GET['updateCode'];
        $stmt = $conn->prepare("SELECT * FROM authors WHERE author_code = :author_code");
        $stmt->execute([':author_code' => $updateCode]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo '<h1>Update Author</h1>';
        echo '<form action="author/handle/updateAuthor.php" method="POST">';
        echo '<div class="">';
        echo '<input name="author_code" style="display: none;" type="text" value="' . $row['author_code'] . '" readonly>';
        echo '</div>';
        echo '<div class="">';
        echo '<label for="author_name">Author Name</label>';
        echo '<input name="author_name" type="text" value="' . $row['author_name'] . '" required>';
        echo '</div>';
        echo '<div class="">';
        echo '<label for="author_des">Author Description</label>';
        echo '<input name="author_des" type="text" value="' . $row['author_des'] . '" required>';
        echo '</div>';
        echo '<div class="">';
        echo '<label for="author_image">Author Image</label>';
        echo '<input name="author_image" type="text" value="' . $row['author_image'] . '" required>';
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
}
