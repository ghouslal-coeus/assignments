<?php 
    include("EmailTrait.php");
    Class Attendance extends Database {

        use EmailTrait;

        public $employee_id;
        public $date;
        public $time_in;
        public $time_out;
        public $status;

        public function markTimeIn() 
        {   

            $this->status = 'present';
            $query = "insert into attendance (`employee_id`,`date`,`time_in`,`status`) 
            values ('$this->employee_id','$this->date','$this->time_in','$this->status')";

            $this->conn->query($query);
              
            $this->closeDBConn();
        }

        public function markTimeOut() 
        {
            $query = "update attendance  
                        set time_out = '$this->time_out'
                        where employee_id = $this->employee_id and date =  '$this->date'"; 

            $this->conn->query($query);

            $this->closeDBConn();

        }

        public function getEmployeeAttendance($id)
        {
            $date = Date('y-m-d');
            $query = "SELECT a.employee_id,a.time_in,a.time_out,a.date
                        FROM attendance a
                        where a.employee_id = $id and date = '$date'";
            
            return $this->conn->query($query);
        }

        public function getTodayAttendance()
        {
            $date = Date('y-m-d');
            $query = "SELECT a.employee_id,a.time_in,a.time_out,a.date,a.status,e.name,e.department,e.designation 
                        FROM attendance a
                        INNER JOIN employees e on a.employee_id = e.id
                        where a.date = '$date'";
            
            return $this->conn->query($query);
        }

        private function getAbsentEmployee () 
        {
            $date = Date('y-m-d');
            $query = "SELECT e.id,e.email,e.name,e.boss,m.email as boss_email 
                        FROM employees e
                        INNER JOIN employees m on e.boss = m.id
                        WHERE e.id not in ( SELECT employee_id from attendance where date = '$date' )"; 
            
            return $this->conn->query($query);

        }

        public function sendRemindEmail()
        {
            $employees = $this->getAbsentEmployee();
            $subject = "Mark your attendance";
            $message = "hey, You haven't mark your attendance, please mark it ASAP";

            while($row = $employees->fetch_assoc()) {
                
                // echo $row['id'].' '.$row['email']."\r\n";
                if(!empty($row['email'])){
                    
                    $this->sendEmail($row['email'],$subject,$message);
                    
                }
            }
            $this->closeDBConn();
        }

        public function markLeaveAndNotifyBoss ()
        {
            $employees = $this->getAbsentEmployee();
            $subject = "Informing about leave";
            
            while($row = $employees->fetch_assoc()){
                
                $message = "Your assistant " .$row['name'] ." is on leave today";
                // echo $row['id'].' '.$row['email']." " . $message;
                if(!empty($row['email'])){
                    
                    $this->sendEmail($row['boss_email'],$subject,$message);
                    
                }
                $date = Date('y-m-d');
                $id = $row['id'];
                $query = "insert into attendance (`employee_id`,`date`,`time_in`,`time_out`,`status`) 
                values ($id,'$date','','','leave')";

                $this->conn->query($query);

            }
            $this->closeDBConn();
        }

        public function getMonthlyReport($month)
        {
            $query = "SELECT a.employee_id,e.name,count(a.employee_id) as 'leave'
                        from attendance a
                        inner join employees e on a.employee_id = e.id
                        where a.status = 'leave' and DATE_FORMAT(date,'%Y-%m') = '$month'
                        group by a.employee_id";

            return $this->conn->query($query);
        }
    }