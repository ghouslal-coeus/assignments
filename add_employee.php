<?php 

    include('Database.php');
    include('Employee.php');

    session_start();

    $uploadError = '';
    $insertMsg = '';
    $employee = new Employee();

    $managers = $employee->getManager();
    // echo $managers;


    if(isset($_POST['add_employee'])){

        $employee->name = $_POST['name'];
        $employee->department = $_POST['department'];
        $employee->salary = $_POST['salary'];
        $employee->boss = isset($_POST['boss']) ? $_POST['boss'] : '';
        $employee->designation = $_POST['designation'];
        
        $avatar = '';
        if($_FILES["avatar"]["name"]){
            
            uploadImage();
            $avatar = str_replace(basename($_SERVER['REQUEST_URI']),"",$_SERVER['REQUEST_URI'])."images/" . basename($_FILES["avatar"]["name"]);
        }
        $employee->image = $avatar;
        $employee->insertEmployee();

    }

    function uploadImage(){

        $target_dir = getcwd()."/images/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
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

            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {

                $GLOBALS['uploadError'] = "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";

            } else {
                $GLOBALS['uploadError'] = "Sorry, there
                 was an error uploading your file.";
            }
        }

    }


    include('employee.template.php');