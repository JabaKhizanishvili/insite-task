<?php

$prodid = $_POST['id'];

echo $prodid;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM cart WHERE product_id=$prodid";
    $conn->exec($sql);
    echo "Record deleted successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

return header("location:index.php");
