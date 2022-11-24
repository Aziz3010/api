<?php
// UpdateProject
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Age: 3600");

require './connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['productName']) && isset($_POST['productArrange']) && isset($_POST['productUrl']) && isset($_POST['productTools'])) {
        
        $projectId = $_POST['projectId'];
        
        $proName = $_POST['productName'];
        $proArrange = $_POST['productArrange'];
        $proLink = $_POST['productUrl'];
        $proTools = $_POST['productTools'];
        // image
        if (!empty($_FILES['productImage'])) {
            $image = $_FILES['productImage'];
            $image_name = $image['name'];
            $extention = pathinfo($image_name, PATHINFO_EXTENSION);
            $tmp_name = $image['tmp_name'];
            $rand = uniqid();
            $imageNewName = $rand . $proName . "." . $extention;
            move_uploaded_file($tmp_name, "./uploads/$imageNewName");
        } else {
            $imageNewName = null;
        }

        if (!empty($proName) && !empty($proArrange) && !empty($proLink) && !empty($proTools)) {
            $query = "UPDATE `projects` SET productName = '$proName', productArrange = '$proArrange', productUrl = '$proLink', productTools = '$proTools', productImage = '$imageNewName'  WHERE id = '$projectId'";

            $runQuery = mysqli_query($conn, $query);
            if ($runQuery) {
                print_r(json_encode(['msg' => "Project updated."]));
            } else {
                print_r(json_encode(['msg' => "Failed to update the project."]));
            }
        } else {
            print_r(json_encode(['msg' => "All fields are required."]));
        }
    } else {
        print_r(json_encode(['msg' => "All fields are required."]));
    }
} else {
    http_response_code(404);
}
