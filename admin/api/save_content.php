<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$response = ['success' => false, 'message' => ''];

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        throw new Exception('Geçersiz veri');
    }
    
    $section = $input['section'] ?? '';
    $data = $input['data'] ?? [];
    
    if (empty($section)) {
        throw new Exception('Bölüm belirtilmedi');
    }
    
    // Mevcut veriyi oku
    $currentData = getData();
    
    // Yeni veriyi güncelle
    switch ($section) {
        case 'hero':
            $currentData['hero'] = array_merge($currentData['hero'] ?? [], $data);
            break;
            
        case 'about':
            $currentData['about'] = array_merge($currentData['about'] ?? [], $data);
            break;
            
        case 'contact':
            $currentData['contact'] = array_merge($currentData['contact'] ?? [], $data);
            break;
            
        case 'services':
            $currentData['services'] = array_merge($currentData['services'] ?? [], $data);
            break;
            
        default:
            throw new Exception('Geçersiz bölüm');
    }
    
    // Veriyi kaydet
    if (saveData($currentData)) {
        $response = [
            'success' => true,
            'message' => 'İçerik başarıyla kaydedildi!',
            'data' => $currentData
        ];
    } else {
        throw new Exception('Veri kaydedilemedi');
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
