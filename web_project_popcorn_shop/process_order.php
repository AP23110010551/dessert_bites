<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    if (!isset($data['items']) || !isset($data['total'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        exit();
    }
    
    $items = $data['items'];
    $total = $data['total'];
    $user_id = $_SESSION['user_id'];
    
    $conn->begin_transaction();
    
    try {
        $order_sql = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
        $order_stmt = $conn->prepare($order_sql);
        $order_stmt->bind_param("id", $user_id, $total);
        $order_stmt->execute();
        
        $order_id = $conn->insert_id;
        
        $item_sql = "INSERT INTO order_items (order_id, item_name, price, quantity) VALUES (?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_sql);
        
        foreach ($items as $item) {
            $item_stmt->bind_param("isdi", $order_id, $item['item'], $item['price'], $item['quantity']);
            $item_stmt->execute();
        }
        
        $conn->commit();
        
        echo json_encode(['success' => true, 'message' => 'Order placed successfully', 'order_id' => $order_id]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error processing order: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
