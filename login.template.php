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
                    <h1>Login</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="username">Username</label>
                        <input type="text" name="username" required="">

                        <label for="password">Password</label>
                        <input type="password" name="password" required="">

                        <button class="btn" type="submit" name="login">Login</button>
                    </form>
                </div>
            </div>
    </section>
</body>

</html>