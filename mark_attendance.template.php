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
            <aside class="form_section_inner">
                <div class="col1">
                    <h1>Mark attendance</h1>
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="request_book_name">Time In</label>
                        <input id="time_in" type="time" name="time_in" value="<?php echo $row['time_in'];?>" onclick="setTime('time_in')">

                        <label for="book_author">Time out</label>
                        <input id="time_out" type="time" name="time_out" value="<?php echo $row['time_out'];?>" onclick="setTime('time_out')">
                        
                        <!-- <label for="date">Date</label> -->
                        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">

                        <button class="btn" type="submit" name="mark_attendance">Save</button>
                    </form>
                </div>
            </aside>
    </section>
</body>
<script src="main.js"></script>

</html>