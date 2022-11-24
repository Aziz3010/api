<?php
    // connectionDB

    // $host = 'localhost';
    // $userName = 'root';
    // $password = '';
    // $dataBaseName = 'my-portfolio-api';

    $host = 'sql304.epizy.com';
    $userName = 'epiz_33054314';
    $password = 'MyO5FLqZAPG';
    $dataBaseName = 'epiz_33054314_portfolioapi';

    $conn = mysqli_connect($host, $userName, $password, $dataBaseName);

    if(!$conn) {
        die("Connection failed: " .mysqli_connect_error());
    };

?>