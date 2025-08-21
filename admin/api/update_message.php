<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Sadece POST metodu kabul edilir']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['message_id']) || !isset($input['action'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Geçersiz veri']);
    exit;
}

$messages_file = '../data/messages.json';

if (!file_exists($messages_file)) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Mesaj dosyası bulunamadı']);
    exit;
}

$messages = json_decode(file_get_contents($messages_file), true) ?? [];
$message_id = $input['message_id'];
$action = $input['action'];

// Mesajı bul
$message_index = -1;
foreach ($messages as $index => $message) {
    if ($message['id'] === $message_id) {
        $message_index = $index;
        break;
    }
}

if ($message_index === -1) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Mesaj bulunamadı']);
    exit;
}

// İşlemi gerçekleştir
switch ($action) {
    case 'mark_read':
        $messages[$message_index]['read'] = true;
        break;
    case 'mark_unread':
        $messages[$message_index]['read'] = false;
        break;
    case 'delete':
        array_splice($messages, $message_index, 1);
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Geçersiz işlem']);
        exit;
}

// Dosyayı güncelle
if (file_put_contents($messages_file, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode([
        'success' => true,
        'message' => 'İşlem başarıyla gerçekleştirildi'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Dosya güncellenirken hata oluştu']);
}
?>
