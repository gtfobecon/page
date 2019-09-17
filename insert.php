<?php
try{
    require('mysqli_connect.php');
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
    
}catch(Exception $e){
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
echo "<br>";
$sql = "INSERT INTO users (first_name, last_name, email, password, registration_date, user_level)
VALUES ('AA', 'BB', 'AABB@example.com', 'ABC', now(), 2)";
if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>