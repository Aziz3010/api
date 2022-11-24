<?php
// Login
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: multipart/form-data");
// header("Access-Control-Allow-Age: 3600");

require './connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['access_token'])) {
        $access_token = $_POST['access_token'];
        // Get User from db
        $query = "SELECT * FROM `user` WHERE accessToken = '$access_token' ";
        $runQuery = mysqli_query($conn, $query);
        if ($runQuery->num_rows > 0) {
            $queryInserToken = "UPDATE `user` SET accessToken = null WHERE accessToken='$access_token'";
            $runQueryInserToken = mysqli_query($conn, $queryInserToken);
            if ($runQueryInserToken) {
                print_r(json_encode(['msg' => "Logout successfully"]));
            } else {
                print_r(json_encode(['msg' => "Failed to logout."]));
            }
        } else {
            print_r(json_encode(['msg' => "User didn't exist."]));
        }
    } else {
        print_r(json_encode(['msg' => "Access token is required."]));
    }
} else {
    http_response_code(404);
}
