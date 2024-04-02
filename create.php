 
<?php 
include "config.php";

if (isset($_POST['check_Emailbtn'])) {
    $email = $_POST['email'];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "email is already exists";
    } else {
        echo "";
    }

    exit();
}

if (isset($_POST['addUser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST["number"];
    $address = $_POST["address"];
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $checkEmail_run = mysqli_query($conn, $checkEmail);

    if(mysqli_num_rows($checkEmail_run) > 0) {
        echo "email already exists";     
        exit();
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (name, email, password, number, address) VALUES ('$name', '$email', '$hashed_password', '$number', '$address')";
        
        if(mysqli_query($conn, $insertQuery)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
