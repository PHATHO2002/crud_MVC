<h1>add new category</h1>
<form action="category/handle/addcategory.php" method="POST">
    <label for="category_name"> category name</label>
    <input name="category_name" type="text">
    <input type="submit" name="action" value="add">
</form>
<?php
if (isset($_GET['err'])) {
    $err = $_GET['err'];
    echo "<p>  $err</p>";
}
?>