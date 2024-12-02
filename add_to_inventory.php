<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ra_pos";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo "<script>alert('File is not an image.'); window.location.href = 'main.php';</script>";
        exit();
    }

   
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'main.php';</script>";
        exit();
    }

   
    $stmt = $conn->prepare("INSERT INTO stock (category, name, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $category, $name, $price, $target_file);

    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!'); window.location.href = 'main.php';</script>";
    } else {
        echo "<script>alert('Failed to add product to inventory. Please try again.'); window.location.href = 'main.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
