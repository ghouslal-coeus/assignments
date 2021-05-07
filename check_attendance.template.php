<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Attendance System</title>
</head>

<body>
    <?php include 'header.php';?>
    <section id="books" class="book_shelf">
        <h1>List of employees </h1>
        <div class="book_list_table">
        <?php if(mysqli_num_rows($employees) > 0){?> 
            <table>
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Date</th>
                        <th>Status</th>  
                        <th>Department</th>
                        <th>Designation</th>
                    </tr>
                </thead>

                <tbody>                
                <?php while($row = mysqli_fetch_array($employees)) 
                {
                    echo "<tr>";
                    echo "<td>" . @$row['name'] . "</td>";
                    echo "<td>" . @$row['time_in'] . "</td>";
                    echo "<td>" . @$row['time_out'] . "</td>";
                    echo "<td>" . @$row['date'] . "</td>";
                    echo "<td>" . @$row['status'] . "</td>";
                    echo "<td>" . @$row['department'] . "</td>";
                    echo "<td>" . @$row['designation'] . "</td>";
                }
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No Book Available</p>";
            }
            $attendance->closeDBConn();

            
            ?>
        </div>
    </section>
</body>

</html>