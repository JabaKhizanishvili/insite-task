<?php
include 'main.php';

print_r($_POST);
$prodid = $_POST['id'];




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO cart (id, user_id, product_id,quantity)
  VALUES (null,15, $prodid, 1)";
    $conn->exec($sql);
    echo "New record created successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

// INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES (NULL, '', '', '')

return header("location:index.php");
