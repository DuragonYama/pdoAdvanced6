<?php 
    
    require "database.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    if (isset($_POST['knop'])) {
        $db->update($_POST['email'], $_POST['wachtwoord'], $id);
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
    <form method="POST">
        <input type="email" name="email" placeholder="Uw nieuw email"> <br>
        <input type="password" name="wachtwoord" placeholder="Uw nieuw wachtwoord"> <br><br>
        <input type="submit" name="knop">
    </form>
</body>
</html>