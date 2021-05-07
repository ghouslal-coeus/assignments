<?php 

    session_start();
    
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        // echo "login";
        header("location: mark_attendance.php");
        exit;
    }

    include('Database.php');
    include('Employee.php');

    $insert_msg = '';
    $employee = new Database();
    // echo $managers;


    if(isset($_POST['login'])){
        $username = trim($_POST["username"]);
        
        $password = trim($_POST["password"]);
        
        $query = "SELECT employee_id, username, password, designation FROM users 
                        INNER JOIN employees on employee_id = id
                        WHERE username = ?";
            
            // echo $query;
            if($result = $employee->conn->prepare($query)){

                $result->bind_param("s", $param_username);
                
                $param_username = $username;
                
                if($result->execute()){

                    $result->store_result();
                    
                    if($result->num_rows == 1) {

                        $result->bind_result($employee_id, $username, $hashed_password,$designation);

                        if($result->fetch()) {

                            if($password == $hashed_password) {
                                
                                session_start();
                                
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $employee_id;
                                $_SESSION["username"] = $username;
                                $_SESSION["designation"] = $designation;
                                
                                header("location: mark_attendance.php");

                            } else{

                                $insert_msg =  "Invalid password.";

                            }
                        }
                    } else {

                        $insert_msg =  "Invalid username.";

                    }
                } else{

                    $insert_msg =  "Oops! Something went wrong. Please try again later.";

                }
    
                $result->close();
            }

        
        $employee->closeDBConn();

    }

    include('login.template.php');