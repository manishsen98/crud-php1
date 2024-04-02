
<?php 
include "config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];

    $email = $_POST["email"];
    $number = $_POST["number"];
    $address = $_POST["address"];
    
    $sql = "UPDATE users SET name='$name' ,  email='$email', number='$number', address='$address'   WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: home.php");

    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT id, name, email, number, address   FROM users WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Edit Record</title>
            <link rel="stylesheet"  href="table.css" >
            <link rel="stylesheet"  href="update.css" >
        
        </head>
        <body>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <h2>Edit Record</h2>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
            Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
            Address: <input type="text" name="address" value="<?php echo $row['address']; ?>"> <br><br>
            number: <input type="text" name="number" value="<?php echo $row['number']; ?>"> <br><br>
            <input type="submit" value="Update">
        </form>

        </body>
        </html>

        <?php
    } else {
        echo "No record found";
    }
}
?>