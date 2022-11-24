<?php
// DeleteProjects
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Age: 3600");

require './connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id'])) {
        $proId = $_GET['id'];
        if (!empty($proId)) {
            $query = "DELETE FROM `projects` WHERE id = '$proId'";
            $runQuery = mysqli_query($conn, $query);
            if ($runQuery) {
                print_r(json_encode(['msg' => "Project deleted."]));
            } else {
                print_r(json_encode(['msg' => "Failed to delete the project."]));
            }
        } else {
            print_r(json_encode(['msg' => "Project id is required."]));
        }
    } else {
        print_r(json_encode(['msg' => "Project id is required."]));
    }
} else {
    http_response_code(404);
}
