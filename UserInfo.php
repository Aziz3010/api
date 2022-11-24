<?php
    // UserInfo
    require_once './connectionDB.php';
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type: application/json; charset=UTF-8");
    // header("Access-Control-Allow-Age: 3600");

    if($_SERVER['REQUEST_METHOD'] == 'GET' ){
        $query = "SELECT * FROM `user` ";
        $runQuery = mysqli_query($conn, $query);
        $results = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
        $results_json = json_encode($results);
        print_r($results_json);
    }
