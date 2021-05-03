<?php 
    
    include('connection.php');

    $id=$_REQUEST['id'];
    $query = "select b.id,b.name,b.publisher_id,b.cover_image,b.isbn,p.name as 'publisher_name' from books as b
                    left join publishers as p on p.id= b.publisher_id where b.id='".$id."'"; 

    $result = $conn->query($query) or die ( $conn->error);
    $row = $result->fetch_assoc();


    $uploadError = '';
    $insertMsg = '';

    if(isset($_POST['add_book'])){

        $publisher_name = $_POST['publisher_name'];
        
        $publisher_get_query = "select * from publishers where name ='".$publisher_name."'";
        
        $publisher_get_query_result = $conn->query($publisher_get_query) or die ( $conn->error);
        $publisher_row = $publisher_get_query_result->fetch_assoc();

        $publisher_id ;
        if(@$publisher_row['name'] == $publisher_name){
            
            $publisher_id = $publisher_row['id'];
            
        } else {
            
            $publisher_add_query = "insert into publishers (`name`) values ('$publisher_name')";
            if ($conn->query($publisher_add_query) === TRUE) {
                $publisher_id = $conn->insert_id;
                
            }
        }
        
        $book_name = $_POST['book_name'];
        $isbn = $_POST['isbn'];
        
        $cover_image = '';
        if($_FILES["cover_image"]["name"]){
            uploadImage();
            $cover_image = str_replace(basename($_SERVER['REQUEST_URI']),"",$_SERVER['REQUEST_URI'])."images/" . basename($_FILES["cover_image"]["name"]);
        }

        $query_update_book = "update books 
                            set name = '$book_name',    
                            isbn = '$isbn', 
                            publisher_id = $publisher_id 
                            where id = $id";
                            echo $query_update_book;

        $conn->query($query_update_book);  
        $insertMsg = "Book updated successfully.";

    }

    include('edit.template.php');