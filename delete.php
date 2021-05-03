<?php 
    
    include('connection.php');

    $id=$_REQUEST['id'];
    $query = "DELETE FROM books WHERE id=$id"; 
    $result = $conn->query($query);

    include('delete.template.php');