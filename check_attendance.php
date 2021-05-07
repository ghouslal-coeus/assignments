<?php 
    
    include('Database.php');
    include('Attendance.php');

    session_start();
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        $attendance = new Attendance();
    
        $employees = $attendance->getTodayAttendance();
    
        include('check_attendance.template.php');

    } else {

        header("location: login.php");

    }

