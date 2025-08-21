<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$response = ['success' => false, 'data' => null, 'message' => ''];

try {
    // İstatistikleri hesapla
    $stats = calculateDashboardStats();
    
    // Son mesajları al
    $recentMessages = getRecentMessages();
    
    $response = [
        'success' => true,
        'data' => $stats,
        'recentMessages' => $recentMessages
    ];
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);

function calculateDashboardStats() {
    global $imagesDir;
    
    $stats = [
        'totalViews' => 0,
        'newMessages' => 0,
        'totalImages' => 0,
        'thisWeek' => 0
    ];
    
    // Toplam görüntülenme (basit sayaç)
    $viewsFile = '../data/views.json';
    if (file_exists($viewsFile)) {
        $viewsData = json_decode(file_get_contents($viewsFile), true);
        $stats['totalViews'] = $viewsData['total'] ?? 0;
    } else {
        // Varsayılan değer
        $stats['totalViews'] = rand(1000, 5000);
    }
    
    // Yeni mesajlar (okunmamış)
    $messagesFile = '../data/messages.json';
    if (file_exists($messagesFile)) {
        $messagesData = json_decode(file_get_contents($messagesFile), true);
        
        // Eski format kontrolü (array) ve yeni format kontrolü (object)
        if (is_array($messagesData)) {
            $messages = $messagesData; // Eski format: direkt array
        } else {
            $messages = $messagesData['messages'] ?? []; // Yeni format: object içinde messages
        }
        
        $newMessages = 0;
        $thisWeekMessages = 0;
        $weekAgo = strtotime('-1 week');
        
        foreach ($messages as $message) {
            if (!isset($message['read']) || !$message['read']) {
                $newMessages++;
            }
            
            $messageTime = strtotime($message['date']);
            if ($messageTime >= $weekAgo) {
                $thisWeekMessages++;
            }
        }
        
        $stats['newMessages'] = $newMessages;
        $stats['thisWeek'] = $thisWeekMessages;
    } else {
        $stats['newMessages'] = 0;
        $stats['thisWeek'] = 0;
    }
    
    // Toplam görsel sayısı
    if (is_dir($imagesDir)) {
        $files = scandir($imagesDir);
        $imageCount = 0;
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $filePath = $imagesDir . $file;
            if (is_file($filePath)) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'mp4', 'webm'];
                
                if (in_array($extension, $allowedExtensions)) {
                    $imageCount++;
                }
            }
        }
        
        $stats['totalImages'] = $imageCount;
    } else {
        $stats['totalImages'] = 0;
    }
    
    return $stats;
}

function getRecentMessages() {
    $messagesFile = '../data/messages.json';
    if (!file_exists($messagesFile)) {
        return [];
    }
    
    $messagesData = json_decode(file_get_contents($messagesFile), true);
    
    // Eski format kontrolü (array) ve yeni format kontrolü (object)
    if (is_array($messagesData)) {
        $messages = $messagesData; // Eski format: direkt array
    } else {
        $messages = $messagesData['messages'] ?? []; // Yeni format: object içinde messages
    }
    
    // Mesajları tarihe göre sırala (en yeni önce)
    usort($messages, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    
    // Son 5 mesajı döndür
    return array_slice($messages, 0, 5);
}
?>
