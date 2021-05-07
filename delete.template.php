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
        <div class="book_list_table">
        <?php if($result) {

                echo "<p>Employee deleted successfully</p>";
                }
                else {
                    echo "<p>Some error occured, please try again</p>";
                }
                ?>
        </div>
    </section> 
</body>

</html>