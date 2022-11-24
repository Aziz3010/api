<?php
require "./connectionDB.php";

$password = "15113010";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO `user`(`id`, `email`, `username`, `password`, `access-token`, `title`, `linkedin`, `github`, `gmail`, `whatsapp`, `paragraph01`, `paragraph02`, `paragraph03`)
VALUES (NULL, 'a.abdelazizg@gmail.com', 'ahmed abdelaziz', '$hashed_password', NULL, 'Full stack web developer', 'https://www.linkedin.com/in/ahmedgomaa3/', 'https://github.com/Aziz3010?tab=repositories', 'a.abdelazizg@gmail.com', '201069855288', 'Freelancer providing services from programming. Join me down below and let''s make great website.', 'Since the beginning of my journey as a freelance developer, I''ve done many websites for clients and companies. I offer a wide range of services in frontend and backend.', 'I have many years experience in web development and you can watch my projects here.')";
$runQuery = mysqli_query($conn, $query);

if ($runQuery) {
    print_r(json_encode(['msg' => "User added"]));
} else {
    print_r(json_encode(['msg' => "Failed"]));
}