    <header class="assignment_header">
        <nav class="assignment_navbar">
            <ul>
            <?php 
                if(!empty($_SESSION["loggedin"]) &&  $_SESSION["loggedin"] === true){ ?>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                <?php }
                if(empty($_SESSION["loggedin"])){ ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                <?php }

                ?>
                <li>
                    <a href="mark_attendance.php">Time In/Time Out</a>
                </li>
                <!-- $_SESSION["designation"] -->
                <?php 
                    if(!empty($_SESSION["designation"]) &&  $_SESSION["designation"]== 'hrmanager'){ ?>
                    <li>
                        <a href="home.php">All Employees</a>
                    </li>
                    <li>
                        <a href="add_employee.php">Add Employee</a>
                    </li>
                    <li>
                        <a href="check_attendance.php">Check attendance</a>
                    </li>
                    <li>
                        <a href="report.php">Get Report</a>
                    </li>
                    <?php }
                ?>
            </ul>
        </nav>
    </header>