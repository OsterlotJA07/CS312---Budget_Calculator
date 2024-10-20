<?php
    session_start(); //I know in the todo list it says that this file will send stuff to database, but for now (since we havent covered) database I'll be using sessions
    // maybe, instead of saving straight to the database, we'll use a session variable and allow user to save to database using a username and password?
    //idk just riffin ya know?

    if(isset($_POST['item_name'])){ //since item_name is a required field, checking if just it is set should(?) be fine
        if(!isset($_SESSION['purchases'])){ //if the purchases array hasnt been set yet, we initialize as empty array
            $_SESSION['purchases'] = [];
        }
        array_push($_SESSION['purchases'], array("item_name" => $_POST['item_name'],
                    "price" => $_POST['price'], 
                    "link" => $_POST['link'])); //adding whatever the form sent to this page to the purchases array
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Budget Calculator</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./ui_styles.css">
</head>
<body>
    <h1>
        Add purchase:
</h1>
<form action="./purchase_interface.php" method="post">
    <label for="item_name">Item name: </label><br>
    <input type="text" id="item_name" name="item_name" required><br>

    <label for="price">Item price: </label><br>
    $<input type="number" id="price" name="price" required><br>
    
    <label for="link">Link to product (optional): </label><br>
    <input type="text" id="link" name="link"><br>

    <button type="submit">Add purchase</button>
</form>
<br>
<table>
    <th>Name</th>
    <th>Price</th>
    <th>Link</th>
<?php 

    if(isset($_SESSION['purchases'])){ // This block of code pretty much just creates a table out of the purchases array
        $purchases = $_SESSION['purchases'];
        foreach ($purchases as $p){
            $tr= "<tr>";
            $tr .= ("<th>" . $p['item_name'] . "</th>"); 
            $tr .= ("<th>" . $p['price'] . "</th>"); 
            if($p['link']!=""){ // idk why, but the form sends link out as an empty string if the user doesnt put anything in. I assume this is a blunder on my part, so for now this if statement is like this
                $tr .= ("<th>" . $p['link'] . "</th>"); 
            }
            else{
                $tr .= ("<th> N/A </th>");
            }
            $tr .= "</tr>";
            echo $tr;
        }
    }
    
?>
</table>
<a href="budget_index.php">Back to budget index</a> 
</body>