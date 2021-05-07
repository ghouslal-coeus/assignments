<?php 

    include('Database.php');
    include('Employee.php');

    session_start();

    $employee = new Employee();

    $employees = $employee->getAllEmployees();

    include('home.template.php');