<?php


class db
{

    function __construct()
    {
        $this->db_connection();
    }

    function db_connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new PDO("mysql:host=$servername;dbname=task", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function getProd()
    {
        $conn = $this->db_connection();
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getOrders()
    {
        $conn = $this->db_connection();
        $stmt = $conn->prepare("SELECT cart.id, cart.user_id, cart.product_id, cart.quantity, products.price FROM products INNER JOIN cart ON products.product_id=cart.product_id");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function productGroupItem()
    {
        $conn = $this->db_connection();
        $stmt = $conn->prepare("SELECT * FROM product_group_items");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function productSaleVal()
    {
        $conn = $this->db_connection();
        $stmt = $conn->prepare("SELECT * FROM user_product_groups");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
}



$connData = new db();
$products_data = $connData->getProd();
$orders_data = $connData->getOrders();
$productGroupItem = $connData->productGroupItem();
$saleVal = $connData->productSaleVal();
