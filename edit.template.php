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
    <div>
        <?php
            if($insert_msg){
                echo "<h4>" . $insert_msg . "</h4>";
            }
        ?>
    </div>
    <section class="form_section">
            <div class="form_section_inner">
                <div class="col1">
                    <h1>Update Employee</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="name">Employee name</label>
                        <input type="text" name="name" value="<?php echo $row['name'];?>" required="">

                        <label for="department">Department Name</label>
                        <input type="text" name="department" value="<?php echo $row['department'];?>">
                        
                        <label for="salary">salary</label>
                        <input type="text" name="salary" value="<?php echo $row['salary'];?>">

                        <label for="boss">Boss</label>
                        <select name="boss">
                            <option value="" disabled > Select Boss</option>

                            <?php
                                while ($row = $managers->fetch_assoc())
                                {
                                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                } ?>
  
                        </select>

                        <label for="designation">Designation</label>
                        <select name="designation" required="">
                            <option value="" disabled > Select designation</option>
                            <option value="developer" > Developer</option>
                            <option value="manager" > Manager</option>
                            <option value="hrmanager" > HRManager</option>
                            <option value="ceo" > CEO</option>
                        </select>

                        <button class="btn" type="submit" name="add_employee">Update Employee</button>
                    </form>
                </div>
            </div>
    </section>
</body>

</html>