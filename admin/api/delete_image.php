<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

// JSON verisini al
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['image_name'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Görsel adı belirtilmedi'
    ]);
    exit;
}

$imageName = $input['image_name'];
$imagePath = $imagesDir . $imageName;

try {
    // Dosya var mı kontrol et
    if (!file_exists($imagePath)) {
        throw new Exception('Görsel bulunamadı');
    }
    
    // Dosyayı sil
    if (unlink($imagePath)) {
        echo json_encode([
            'success' => true,
            'message' => 'Görsel başarıyla silindi'
        ]);
    } else {
        throw new Exception('Görsel silinemedi');
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
