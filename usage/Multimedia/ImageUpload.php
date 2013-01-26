<!DOCTYPE html>
<html lang="en">
<head>
    <title>Image Upload Function Usage</title>
</head>
<body>
<?php
require_once "../../src/Lib/Multimedia/ImageUpload.php";
//Create ImageUpload Object
$obj = new ImageUpload();
echo $obj->ImgUpload("../../src/lib",null,null,null);
?>
<form action="?click=upload" method="post" enctype="multipart/form-data">
    <input type="file" name="ImgName"/>
    <input type="submit" name="submit" value="SUBMIT"/>
</form>
</body>
</html>
