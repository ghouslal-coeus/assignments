<?php 

    session_start();
        
    include('Database.php');
    include('Attendance.php');

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

        $attendance = new Attendance();
    
        // $attendance->sendRemindEmail();
        
        if(isset($_POST['get_report'])){
            
            $employees = $attendance->getMonthlyReport($_POST['month']);

        }
    
        include('report.template.php');

    } else {
        
        header("location: login.php");

    }
