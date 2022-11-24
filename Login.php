<?php
// Login
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: multipart/form-data");
// header("Access-Control-Allow-Age: 3600");

require './connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $proEmail = $_POST['email'];
        // Get User from db
        $query = "SELECT * FROM `user` WHERE email = '$proEmail' ";
        $runQuery = mysqli_query($conn, $query);
        if ($runQuery->num_rows > 0) {
            // User exist and check the password
            $data = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
            $userId = $data[0]["id"];
            $proPassword = $_POST['password'];
            $oldHashedPassword = $data[0]["password"];
            $verify_password = password_verify($proPassword, $oldHashedPassword);
            if ($verify_password) {
                // create access-token and insert it in db
                $rand01 = rand(0, 1000000);
                $rand02 = rand(0, 1000000);
                $rand03 = rand(0, 1000000);
                $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "K", "L"];
                $rand04 = rand(0, 9);
                $rand05 = rand(0, 9);
                $access_token = $rand01 * $rand02 * $rand03 + $rand01 + $rand02 + $rand03 . $letters[$rand04] . $letters[$rand05];
                $queryInserToken = "UPDATE `user` SET accessToken='$access_token' WHERE id='$userId'";
                $runQueryInserToken = mysqli_query($conn, $queryInserToken);
                if ($runQueryInserToken) {
                    print_r(json_encode(['access_token' => $access_token]));
                } else {
                    print_r(json_encode(['msg' => "Failed to add the access token."]));
                }
            } else {
                print_r(json_encode(['msg' => "Email or Password aren't correct."]));
            }
        } else {
            print_r(json_encode(['msg' => "User didn't exist."]));
        }
    } else {
        print_r(json_encode(['msg' => "All fields are required."]));
    }
} else {
    http_response_code(404);
}
