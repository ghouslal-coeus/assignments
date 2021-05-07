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
                        <th>Department</th>
                        <th>salary</th>
                        <th>boss</th>
                        <th>designation</th>
                        <th>Avatar</th>  
                        <th>Edit book</th>  
                        <th>Delete book</th>  
                    </tr>
                </thead>

                <tbody>                
                <?php while($row = mysqli_fetch_array($employees)) 
                {
                    echo "<tr>";
                    echo "<td>" . @$row['name'] . "</td>";
                    echo "<td>" . @$row['department'] . "</td>";
                    echo "<td>" . @$row['salary'] . "</td>";
                    echo "<td>" . @$row['boss_name'] . "</td>";
                    echo "<td>" . @$row['designation'] . "</td>";
                    if(@$row['image']){
                        echo "<td>" ?> <img src="<?php echo @$row['image']; ?>".jpg"> <?php echo "</td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "<td align='center'>" ?> <a href="edit.php?id=<?php echo $row['id']; ?>"> <?php echo "Edit</a></td>";
                    echo "<td align='center'>" ?> <a href="delete.php?id=<?php echo $row['id']; ?>"> <?php echo "Delete</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No Employee Available</p>";
            }
            $employee->closeDBConn();

            
            ?>
        </div>
    </section>
</body>

</html>