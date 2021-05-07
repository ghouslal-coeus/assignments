<?php 

    Class Employee extends Database {

        public $name;
        public $department;
        public $salary;
        public $boss;
        public $designation;
        public $image;

        public function insertEmployee() {

            $query = "insert into employees (`name`,`department`,`salary`,`boss`,`designation`,`image`) 
            values ('$this->name','$this->department','$this->salary','$this->boss','$this->designation','$this->image')";

            if ($this->conn->query($query) === TRUE) {

                echo "New record created successfully";

            } else {

                echo "Error: " . $query . "<br>" . $this->conn->error;

            }
              
             // $conn->close();
            $insertMsg = "New record created successfully.";

        }

        public function editEmployee($id)
        {
            $query = "Update employees
                        set name = '$this->name', 
                        department = '$this->department',
                        salary = '$this->salary', 
                        boss = '$this->boss', 
                        designation = '$this->designation'
                        where id = $id";
                        
            return $this->conn->query($query);
        }

        public function deleteEmployee($id)
        {
            return $this->conn->query("Delete from employees where id = $id");
        }

        public function getEmployee($id)
        {
            $query = "select e.id,e.name,e.department,e.salary,e.boss,e.designation,e.image,m.name as boss_name
                        from employees e
                        INNER JOIN employees m on e.boss = m.id
                        where e.id = $id";
                        // echo $query;
            return $this->conn->query($query);
        }

        public function getAllEmployees() {

            $query = "select e.id,e.name,e.department,e.salary,e.boss,e.designation,e.image,m.name as boss_name
                        from employees e
                        INNER JOIN employees m on e.boss = m.id";

            return $this->conn->query($query);

        }

        public function getManager () {
            
            return $this->conn->query("select id,name from employees where designation = 'manager'");

        }

    }