<?php 
  
    include('Database.php');
    include('Employee.php');

    session_start();

    $emp = new Employee(); 

    $id=$_REQUEST['id'];

    $managers = $emp->getManager();
    $employee = $emp->getEmployee($id);
    $row = $employee->fetch_assoc();

    $insert_msg = '';

    if(isset($_POST['add_employee'])){

        $emp->name = $_POST['name'];
        $emp->department = $_POST['department'];
        $emp->salary = $_POST['salary'];
        $emp->boss = $_POST['boss'];
        $emp->designation = $_POST['designation'];
        
        $result = $emp->editEmployee($id);
        if($result){
            $employee = $emp->getEmployee($id);
            $row = $employee->fetch_assoc();

            $insert_msg = "Employee updated successfully.";

        } else {

            $insert_msg = "Some error occured, please try again.";

        }

    }

    include('edit.template.php');