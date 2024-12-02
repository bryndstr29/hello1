<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ra_pos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = $_GET['category'] ?? '';

$sql = "SELECT * FROM stock";
if ($category) {
    $sql .= " WHERE category = '$category'";
}

$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'category' => $row['category'],
            'price' => $row['price'],
            'image' => $row['image']
        ];
    }
}

echo json_encode($products);
$conn->close();
?>
