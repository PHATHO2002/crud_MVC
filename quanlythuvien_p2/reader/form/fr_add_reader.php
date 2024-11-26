<h1>add new reader</h1>
<form action="reader/handle/addReader.php" method="POST">
    <div class="">
        <label for="reader_code"> reader code</label>
        <input name="reader_code" type="text">
    </div>
    <div class="">
        <label for="reader_name"> reader name</label>
        <input name="reader_name" type="text">
    </div>
    <div class="">
        <label for="reader_address">reader address</label>
        <input name="reader_address" type="text">
    </div>
    <div class="">
        <label for="reader_email">reader email</label>
        <input name="reader_email" type="text">
    </div>
    <div class="">
        <label for="reader_phone">reader phone</label>
        <input name="reader_phone" type="text">
    </div>

    <input type="submit" name="action" value="add">
</form>
<?php
if (isset($_GET['err'])) {
    $err = $_GET['err'];
    echo "<p>  $err</p>";
}
?>