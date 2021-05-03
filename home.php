<?php 
    
    include('connection.php');

    $per_page = 10;
    $offset = 0;
    $total_count = $conn->query("select count(*) as total from books");
    $total_count = $total_count->fetch_assoc();
    $total = $total_count['total'];

    if(isset($_REQUEST['offset']) && $_REQUEST['offset']){

        $offset = $_REQUEST['offset'];

    }

    $query_offset = $offset * $per_page;

    $query = "select b.id,b.name,b.publisher_id,b.cover_image,b.isbn,p.name as 'publisher_name' from books as b
                    left join publishers as p on p.id= b.publisher_id order by b.name limit $query_offset  , $per_page";

    $result = $conn->query($query);

    include('home.template.php');