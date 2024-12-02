<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ra_pos";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $price = $_POST['price'];

   
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $stmt = $conn->prepare("INSERT INTO stock (category, name, price, image_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $category, $name, $price, $imagePath);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Item added successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add item']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No image uploaded or invalid image']);
    }
}

$conn->close();
?>
