<?php
session_start();


if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}


try {
    $pdo = new PDO('mysql:host=localhost;dbname=system', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $pdo->query("SELECT * FROM sales ORDER BY date DESC");
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    echo json_encode($sales);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
