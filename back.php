<?php

    session_start();
    require_once "./database/connection.php";
    require_once "./database/queryBuilder.php";
    
    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST["db-info"])){
            $config = require_once "./config.php";
            $_SESSION["database"] = $config["database"];
            $_SESSION["database"]["username"] = $_POST["user-name"];
            $_SESSION["database"]["password"] = $_POST["password"];
            $_SESSION["alert"] = "UserName And Password Are Resevied";
            header("Location: ./index.php");

        }elseif(isset($_POST["upload-form"])){

            $fileName = $_FILES["upload-file"]['tmp_name'];
            $_SESSION["csvAsArray"] = array_map('str_getcsv', file($fileName));
            $_SESSION["alert"] = "File Uploaded Successfully";
            header("Location: ./index.php");

        }elseif(isset($_POST["import-data"])){
            $pdo = connection::connectConfig($_SESSION["database"]);
            $dbobj = new queryBuilder($pdo);
            $rowData = [];
            $size = sizeof($_SESSION["csvAsArray"]);
            for($row = 1; $row < $size; $row++){
                $data = explode("@",$_SESSION["csvAsArray"][$row][0]);
                $rowData['client'] = trim($data[0]);
                $rowData['clientId'] = (int)trim($data[1]);

                $data = explode("#",$_SESSION["csvAsArray"][$row][1]);
                $rowData['deal'] = trim($data[0]);
                $rowData['dealId'] = (int)trim($data[1]);

                $rowData['time'] = trim($_SESSION["csvAsArray"][$row][2]);
                $rowData['accepted'] = (int)trim($_SESSION["csvAsArray"][$row][3]);
                $rowData['refused'] = (int)trim($_SESSION["csvAsArray"][$row][4]);

                $dbobj->insert("csv",$rowData);
            }
            $_SESSION["alert"] = "Data Saved in Database Successfuly";
            header("Location: ./index.php");

        }elseif(isset($_POST["show-data"])){
            $pdo = connection::connectConfig($_SESSION["database"]);
            $dbobj = new queryBuilder($pdo);
            $data = $dbobj->makeQuery("SELECT * FROM csv");
            require "./index.php";
        }elseif(isset($_POST["remove-data"])){
            $pdo = connection::connect($_SESSION["database"]["username"],$_SESSION["database"]["password"],$_SESSION["database"]["host"]);
            $dbobj = new queryBuilder($pdo);
            $dbobj->makeQuery("DROP DATABASE IF EXISTS {$_SESSION["database"]["DBName"]}");
            session_unset();
            session_destroy();
            header("Location: ./index.php");
        }
        
    }