<?php

$prodid = $_POST['id'];
$quantity = $_POST['quantity'];

echo $prodid . " " . $quantity;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE cart SET quantity=$quantity WHERE product_id=$prodid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo $stmt->rowCount() . " records UPDATED successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

?>

<script>
    setTimeout(() => {
        window.location.href = "index.php";
    }, 1000);
</script>