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
    <section class="form_section">
            <aside class="form_section_inner">
                <div class="col1">
                    <h1>Mark attendance</h1>
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="month">Select Month</label>
                        <input id="month" type="month" name="month" required>

                        <button class="btn" type="submit" name="get_report">Get Report</button>
                    </form>
                </div>
            </aside>
    </section>

    <?php if(isset($employees)){?> 
        <section id="books" class="book_shelf">
            <h1>Leave report </h1>
            <?php if(mysqli_num_rows($employees) > 0){?> 
                <?php while($row = mysqli_fetch_array($employees)) {?>
                    <div class="book_list_table">             
                    
                    <?php
                    echo "<p>" . @$row['name'] . " took " . @$row['leave'] . " leaves </p>";

                }?>
                    </div>
                <?php
            } else {
                echo "<p>No Record Available</p>";
            }
            $attendance->closeDBConn();

            
            ?>
        <!-- </div> -->
    </section>
    <?php } ?>
</body>

</html>