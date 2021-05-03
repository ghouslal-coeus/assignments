<?php 

    $conn = new mysqli('localhost','coeus','Gh_12345678','book_store');
    if ($conn->connect_error){
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }
