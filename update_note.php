<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $note_id = $_POST['id'] ?? 0;
    $content = trim($_POST['content'] ?? '');
 
    if ($note_id && is_numeric($note_id)) {
        $stmt = $pdo->prepare("UPDATE notes SET content = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        if ($stmt->execute([$content, $note_id, $_SESSION['user_id']])) {
            echo json_encode(['success' => true]);
            exit();
        }
    }
}

echo json_encode(['success' => false]);
?>