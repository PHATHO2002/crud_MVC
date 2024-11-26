<form action="index.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required><br><br>

    <label for="des">Description:</label>
    <textarea id="des" name="des" required></textarea><br><br>

    <label for="producer">Producer:</label>
    <input type="text" id="producer" name="producer" required><br><br>

    <input type="text" style="display: none;" name="action" value="add">
    <input type="submit" value="Add Product">
</form>
<?php
if (isset($_GET['err'])) {
    $err = htmlspecialchars($_GET['err']);
    echo "<p style='color: red;'>$err</p>";
}
?>
<a href="index.php">về trang chính</a>