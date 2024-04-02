<?php 
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    
    $stmt->bind_param("i", $id);
    
    
    if ($stmt->execute()) {
        header("Location: home.php"); 
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "ID parameter is missing";
}



?>