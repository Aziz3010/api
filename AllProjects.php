<?php
    // AllProjects
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type: application/json; charset=UTF-8");
    // header("Access-Control-Allow-Age: 3600");
    
    require './connectionDB.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET' ){
        $query = "SELECT * FROM `projects` ";
        $runQuery = mysqli_query($conn, $query);
        $results = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
        $results_json = json_encode($results);
        print_r($results_json);
    }

?>