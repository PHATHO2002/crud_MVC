<h1>add new author</h1>
<form action="author/handle/addAuthor.php" method="POST">
    <div class="">
        <label for="author_code"> author code</label>
        <input name="author_code" type="text">
    </div>
    <div class="">
        <label for="author_name"> author name</label>
        <input name="author_name" type="text">
    </div>
    <div class="">
        <label for="author_des">author des</label>
        <input name="author_des" type="text">
    </div>
    <div class="">
        <label for="author_image">author image</label>
        <input name="author_image" type="text">
    </div>

    <input type="submit" name="action" value="add">
</form>
<?php
if (isset($_GET['err'])) {
    $err = $_GET['err'];
    echo "<p>  $err</p>";
}
?>