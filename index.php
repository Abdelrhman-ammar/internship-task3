<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CSV Handel</title>
        <link rel="stylesheet" href="./resources/style.css">
    </head>
    <body>
        <nav>
            <button class="btn" onclick="formHandel()">DataBase Connection</button>
            <form method="post" action="back.php" enctype="multipart/form-data">
                <input name="upload-file" type="file" required>
                <button name="upload-form" type="submit" class="btn">Upload</button>
            </form>

            <form method="post" action="back.php">
                <button name="import-data" type="submit" class="btn">Import CSV Data</button>
            </form>

            <form method="post" action="back.php">
                <button name="show-data" type="submit" class="btn">Show CSV Data</button>
            </form>

            <form method="post" action="back.php">
                <button name="remove-data" type="submit" class="btn">Remove CSV Data</button>
            </form>
        </nav>
        <h4 class="alert">
            <?php 
                if(isset($_SESSION["alert"])){
                    echo $_SESSION["alert"];
                }
            ?>
        </h4>
        <div class="main-div">
            
            <form id="connectionForm" method="post" action="back.php" class="connection-form">
                <input name="user-name" type="text" placeholder="Enter Database UserName" required>
                <input name="password" type="password" placeholder="Enter Database Password">
                <button name="db-info" class="btn-submit" type="submit">Connect</button>
            </form>
        </div>
        <?php if(isset($data)): ?>
            <table id="mytable">
                    <thead>
                        <tr>
                            <th>Row Id</th>
                            <th>Client</th>
                            <th>Client Id</th>
                            <th>Deal</th>
                            <th>Deal Id</th>
                            <th>Hour</th>
                            <th>Accepted</th>
                            <th>Refused</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row): ?>
                            <tr>
                                <td><?=$row[0]?></td>
                                <td><?=$row[3]?></td>
                                <td><?=$row[1]?></td>
                                <td><?=$row[4]?></td>
                                <td><?=$row[2]?></td>
                                <td><?=$row[5]?></td>
                                <td><?=$row[6]?></td>
                                <td><?=$row[7]?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
            </table>
        <?php endif ?>
        <script src="./resources/index.js"></script>
    </body>
</html>