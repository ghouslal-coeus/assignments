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
                    <h1>Search book</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="book_name">Book name</label>
                        <input type="text" name="name">
                        <button class="btn" type="submit" name="submit">Search</button>
                    </form>
                    <br>
                </div>
                <div class="col1">
                    <h1>Add New Book</h1>
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="request_book_name">Book name</label>
                        <input type="text" name="book_name" required="">

                        <label for="book_author">Publisher Name</label>
                        <input type="text" name="publisher_name">
                        
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" required="">

                        <label for="cover_image">Cover Image</label>
                        <input type="file" name="cover_image" >

                        <button class="btn" type="submit" name="add_book">Add Book</button>
                    </form>
                </div>
            </aside>
    </section>
        <?php if(isset($books)){?> 
        <section id="books" class="book_shelf">
        <h1>List of Books </h1>
        <div class="book_list_table">
        <?php if($books->num_rows > 0){?> 
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Publisher Name</th>
                        <th>isbn</th>   
                        <th>Cover Image </th>
                    </tr>
                </thead>

                <tbody>                
                <?php while($row = $books->fetch_assoc()) 
                {
                    echo "<tr>";
                    echo "<td>" . @$row['name'] . "</td>";
                    echo "<td>" . @$row['publisher_name'] . "</td>";
                    echo "<td>" . @$row['isbn'] . "</td>";
                    if(@$row['cover_image']){
                        echo "<td>" ?> <img src="<?php echo @$row['cover_image']; ?>".jpg"> <?php echo "</td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                }
                else {
                echo "<p>No record found";
                }
                $conn->close();
                ?>
        </div>
    </section> 
    <?php } ?>
</body>

</html>