<?php 
    
    include('Database.php');
    include('Employee.php');

    session_start();

    $employee = new Employee(); 

    $id=$_REQUEST['id'];
    $result = $employee->deleteEmployee($id);

    include('delete.template.php');