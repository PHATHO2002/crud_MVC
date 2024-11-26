<form action="index.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price'] ?? '') ?>" required><br><br>

    <label for="des">Description:</label>
    <textarea id="des" name="des" required><?= htmlspecialchars($product['des'] ?? '') ?></textarea><br><br>

    <label for="producer">Producer:</label>
    <input type="text" id="producer" name="producer" value="<?= htmlspecialchars($product['producer'] ?? '') ?>" required><br><br>


    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">

    <input type="submit" value="Update Product">
</form>
<?php
if (isset($_GET['err'])) {
    $err = htmlspecialchars($_GET['err']);
    echo "<p style='color: red;'>$err</p>";
}
?>
<a href="index.php">về trang chính</a>