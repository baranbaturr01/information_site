<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$messages_file = '../data/messages.json';

if (file_exists($messages_file)) {
    $messages = json_decode(file_get_contents($messages_file), true) ?? [];
    
    // Mesajları tarihe göre sırala (en yeni önce)
    usort($messages, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    
    echo json_encode([
        'success' => true,
        'messages' => $messages,
        'count' => count($messages),
        'unread_count' => count(array_filter($messages, function($msg) {
            return !$msg['read'];
        }))
    ]);
} else {
    echo json_encode([
        'success' => true,
        'messages' => [],
        'count' => 0,
        'unread_count' => 0
    ]);
}
?>
