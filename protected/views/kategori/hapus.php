<?php

$a=$_GET['id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "widya_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from kategori WHERE id_kategori='$a'";

if ($conn->query($sql) === TRUE) {
    echo"Data Terhapus!";
    echo"<meta http-equiv='refresh' content='1; url=index.php?r=kategori/admin'>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?> 
