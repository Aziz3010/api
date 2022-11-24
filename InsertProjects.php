<?php
// InsertProjects
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Age: 3600");

require './connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['access_token']) && !empty($_POST['access_token'])) {
        $access_token = $_POST['access_token'];
        $queryToken = "SELECT * FROM `user` WHERE accessToken = '$access_token'";
        $runQueryToken = mysqli_query($conn, $queryToken);
        if ($runQueryToken) {
            if (isset($_POST['productName']) && isset($_POST['productArrange']) && isset($_POST['productUrl']) && isset($_POST['productTools'])) {
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
                    $query = "INSERT INTO `projects`(productName, productArrange, productUrl, productTools, productImage)
                    VALUES('$proName', '$proArrange', '$proLink', '$proTools', '$imageNewName')";
                    $runQuery = mysqli_query($conn, $query);
                    if ($runQuery) {
                        print_r(json_encode(['msg' => "Project added."]));
                    } else {
                        print_r(json_encode(['msg' => "Failed to add the project."]));
                    }
                } else {
                    print_r(json_encode(['msg' => "All fields are required."]));
                }
            } else {
                print_r(json_encode(['msg' => "All fields are required."]));
            }
        } else {
            print_r(json_encode(['msg' => "access token is not correct"]));
        }
    } else {
        print_r(json_encode(['msg' => "Not authenticate."]));
    }
} else {
    http_response_code(404);
}
