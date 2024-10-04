<?php

    require "database.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Wachtwoord</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $db->Select();
                    ?>
                </tbody>
        </table>
    </div>
</body>
</html>