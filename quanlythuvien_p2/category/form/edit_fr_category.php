<h1>update category</h1>
<?php
if (isset($_GET['updateId'])) {

    try {
        require_once(dirname(dirname(__DIR__)) . "/database/database.php");
        $conn = getDatabaseConnection();
        $updateId = $_GET['updateId'];

        $stmt = $conn->prepare("SELECT * FROM categories where category_id=$updateId ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute();
        echo '
        <form action="category/handle/editcategory.php" method="POST">
            <label for="category_name">Category Name</label>
            <input style="display: none;" name="category_id" type="text" value="' . $row['category_id'] . '">
            <input name="category_name" type="text" value="' . $row['category_name'] . '">
            <input type="submit" name="action" value="Update">
        </form>
    ';
        if (isset($_GET['err'])) {
            $err = $_GET['err'];
            echo "<p>  $err</p>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>