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
    <section id="books" class="book_shelf">
        <h1>List of Books </h1>
        <div class="book_list_table">
        <?php if(mysqli_num_rows($result) > 0){?> 
            <table>
                <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Book Name</th>
                        <th>Publisher Name</th>
                        <th>ISBN</th>
                        <th>Cover Image</th>  
                        <th>Edit book</th>  
                        <th>Delete book</th>  
                    </tr>
                </thead>

                <tbody>                
                <?php while($row = mysqli_fetch_array($result)) 
                {
                    echo "<tr>";
                    echo "<td>" . @$row['id'] . "</td>";
                    echo "<td>" . @$row['name'] . "</td>";
                    echo "<td>" . @$row['publisher_name'] . "</td>";
                    echo "<td>" . @$row['isbn'] . "</td>";
                    if(@$row['cover_image']){
                        echo "<td>" ?> <img src="<?php echo @$row['cover_image']; ?>".jpg"> <?php echo "</td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "<td align='center'>" ?> <a href="edit.php?id=<?php echo $row['id']; ?>"> <?php echo "Edit</a></td>";
                    echo "<td align='center'>" ?> <a href="delete.php?id=<?php echo $row['id']; ?>"> <?php echo "Delete</a></td>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No Book Available";
            }
            $conn->close();

            if($total > (($offset+1)*$per_page)){ ?>

                <div >
                    <a href="home.php?offset=<?php echo ($offset+1); ?>">Show more</a> 
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</body>

</html>