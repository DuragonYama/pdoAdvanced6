<?php 
    
    require "database.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $db->delete($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Het is verwijdert</h1>
</body>
</html>