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
    if (!isset($_FILES['image'])) {
        throw new Exception('Görsel dosyası bulunamadı');
    }
    
    $file = $_FILES['image'];
    $type = $_POST['type'] ?? 'general';
    
    // Dosya hata kontrolü
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Dosya yükleme hatası: ' . $file['error']);
    }
    
    // About görseli için özel işlem
    if ($type === 'about') {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFilename = 'about-company.' . $extension;
        
        // Eski about görselini sil
        $oldFiles = glob($imagesDir . 'about-company.*');
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
                'message' => 'Hakkımızda görseli başarıyla yüklendi!',
                'filename' => $newFilename,
                'path' => '../assets/images/' . $newFilename
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            throw new Exception('Dosya yüklenemedi');
        }
    }
    
    // Hero GIF için özel işlem
    if ($type === 'hero-gif') {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFilename = 'hero-animation.' . $extension;
        
        // Eski hero GIF'i sil
        $oldFiles = glob($imagesDir . 'hero-animation.*');
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
                'message' => 'Hero GIF başarıyla yüklendi!',
                'filename' => $newFilename,
                'path' => '../assets/images/' . $newFilename
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            throw new Exception('Dosya yüklenemedi');
        }
    }
    
    // Genel görsel yükleme
    $result = uploadImage($file);
    
    if ($result['success']) {
        $response = [
            'success' => true,
            'message' => 'Görsel başarıyla yüklendi!',
            'filename' => $result['filename'],
            'path' => '../assets/images/' . $result['filename']
        ];
    } else {
        throw new Exception($result['message']);
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
