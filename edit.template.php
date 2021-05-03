<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Book Store</title>
</head>

<body>
    <?php include 'header.php';?>
    <div>
        <?php
            // if($uploadError){
                echo "<h4>" . $GLOBALS['uploadError'] . "</h4>";
                // echo @$uploadError;
            // }
        ?>
    </div>
    <div>
        <?php
            // if($uploadError){
                echo "<h4>" . $insertMsg . "</h4>";
                // echo @$uploadError;
            // }
        ?>
    </div>
    <section class="form_section">
            <aside class="form_section_inner">
                <div class="col1">
                    <h1>Update Book</h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="request_book_name">Book name</label>
                        <input type="text" name="book_name" value="<?php echo $row['name'];?>" required="">

                        <label for="book_author">Publisher Name</label>
                        <input type="text" value="<?php echo $row['publisher_name'];?>" name="publisher_name">
                        
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" value="<?php echo $row['isbn'];?>" required="">

                        <label for="cover_image">Cover Image</label>
                        <input type="file" value="<?php echo $row['cover_image'];?>" name="cover_image" >

                        <button class="btn" type="submit" name="add_book">Update Book</button>
                    </form>
                </div>
            </aside>
    </section>
</body>

</html>