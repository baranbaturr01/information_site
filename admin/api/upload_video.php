<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_FILES['video'])) {
        throw new Exception('Video dosyası bulunamadı');
    }
    
    $file = $_FILES['video'];
    $type = $_POST['type'] ?? 'general';
    
    // Dosya hata kontrolü
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Dosya yükleme hatası: ' . $file['error']);
    }
    
    // Dosya boyutu kontrolü (50MB)
    if ($file['size'] > 50 * 1024 * 1024) {
        throw new Exception('Video dosyası çok büyük (maksimum 50MB)');
    }
    
    // Dosya türü kontrolü
    $allowedTypes = ['video/mp4', 'video/webm', 'video/ogg'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Desteklenmeyen video formatı. Sadece MP4, WebM ve OGG formatları desteklenir.');
    }
    
    // Hero video için özel işlem
    if ($type === 'hero-video') {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFilename = 'hero-video.' . $extension;
        
        // Eski hero video dosyalarını sil
        $oldFiles = glob($imagesDir . 'hero-video.*');
        foreach ($oldFiles as $oldFile) {
            if (is_file($oldFile)) {
                unlink($oldFile);
            }
        }
        
        // Yeni dosyayı yükle
        $uploadPath = $imagesDir . $newFilename;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $response = [
                'success' => true,
                'message' => 'Hero video başarıyla yüklendi!',
                'filename' => $newFilename,
                'path' => '../assets/images/' . $newFilename
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            throw new Exception('Video yüklenemedi');
        }
    }
    
    // Hero video WebM için özel işlem
    if ($type === 'hero-video-webm') {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFilename = 'hero-video.' . $extension;
        
        // Yeni dosyayı yükle
        $uploadPath = $imagesDir . $newFilename;
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $response = [
                'success' => true,
                'message' => 'Hero WebM video başarıyla yüklendi!',
                'filename' => $newFilename,
                'path' => '../assets/images/' . $newFilename
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            throw new Exception('Video yüklenemedi');
        }
    }
    
    // Genel video yükleme
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $newFilename = time() . '_video.' . $extension;
    
    $uploadPath = $imagesDir . $newFilename;
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        $response = [
            'success' => true,
            'message' => 'Video başarıyla yüklendi!',
            'filename' => $newFilename,
            'path' => '../assets/images/' . $newFilename
        ];
    } else {
        throw new Exception('Video yüklenemedi');
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
