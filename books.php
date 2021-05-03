<?php 
    
    include('connection.php');

    $uploadError = '';
    $insertMsg = '';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $select = "select b.name,b.publisher_id,b.cover_image,b.isbn,p.name as 'publisher_name' from books as b 
                    left join publishers as p on p.id= b.publisher_id 
                    where ";

        $query = $select. "b.`name` like '%" . $name . "%'";
        $books = $conn->query($query);
        if ($books->num_rows < 1) {

            $query = $select. "b.`isbn` like '%" . $name . "%'";

            $books = $conn->query($query);
            if ($books->num_rows < 1) {

                $publisher_get_query = "select * from publishers where name like '%" . $name . "%'";

                $publishers = $conn->query($publisher_get_query);

                $pub_row = $publishers->fetch_assoc();
                
                if(@$pub_row['name']){
                    $pub_id = @$pub_row['id'];

                    $query = $select. "p.`id` = $pub_id ";
                    $books = $conn->query($query);
                }
            }
        }

    }

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
                
            } else {

                $insertMsg = "Error: " . $publisher_add_query . "<br>" . $conn->error;
            }
        }

        $book_name = $_POST['book_name'];
        $isbn = $_POST['isbn'];
        $cover_image = '';
        if($_FILES["cover_image"]["name"]){

            uploadImage();
            $cover_image = str_replace(basename($_SERVER['REQUEST_URI']),"",$_SERVER['REQUEST_URI'])."images/" . basename($_FILES["cover_image"]["name"]);
        }
        
        $last_id = $conn->insert_id;
        $query_add_book = "insert into books (`name`,`isbn`,`cover_image`,`publisher_id`) 
        values ('$book_name','$isbn','$cover_image','$publisher_id')";

        $conn->query($query_add_book);
        $insertMsg = "New record created successfully.";

    }

    function uploadImage(){

        $target_dir = getcwd()."/images/";
        $target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
            if($check !== false) {
                $GLOBALS['uploadError'] =  "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $GLOBALS['uploadError'] = "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $GLOBALS['uploadError'] .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0 ) {

            $GLOBALS['uploadError'] .= "your file was not uploaded.";

        } else {

            if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {

                $GLOBALS['uploadError'] = "The file ". htmlspecialchars( basename( $_FILES["cover_image"]["name"])). " has been uploaded.";

            } else {
                $GLOBALS['uploadError'] = "Sorry, there
                 was an error uploading your file.";
            }
        }

    }


    include('books.template.php');