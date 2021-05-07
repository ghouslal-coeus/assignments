<?php 

    session_start();
        
    include('Database.php');
    include('Attendance.php');

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

        $insert_msg = '';
        $attendance = new Attendance();
        
        $employee_attendance = $attendance->getEmployeeAttendance($_SESSION["id"]);
        $row = $employee_attendance->fetch_assoc();
        // $attendance->markLeaveAndNotifyBoss();
    
        if(isset($_POST['mark_attendance'])){
    
            $attendance->employee_id = $_SESSION["id"];
            $attendance->date = $_POST['date'];
            $attendance->time_in = $_POST['time_in'];
            $attendance->time_out = $_POST['time_out'];
            
            if(empty($row['time_in']) && !empty($_POST['time_in'])) {

                $attendance->markTimeIn();
                $insert_msg = "Time in saved";
                
            } else if(empty($row['time_out']) && !empty($_POST['time_out'])){
                
                $attendance->markTimeOut();
                $insert_msg = "Time out saved";

            } else if (!empty($row['time_in']) && !empty($row['time_out'])){

                $insert_msg = "You already time out";
            } else{

                $insert_msg = "Select time in or time out value";
            }
    
        }
    
        include('mark_attendance.template.php');

    } else {
        
        header("location: login.php");

    }
