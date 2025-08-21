<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

try {
    $imagesDir = $imagesDir; // config.php'den al
    $images = [];
    
    // Dizin var mı kontrol et
    if (!is_dir($imagesDir)) {
        throw new Exception('Görsel dizini bulunamadı');
    }
    
    // Dizindeki dosyaları oku
    $files = scandir($imagesDir);
    
    foreach ($files as $file) {
        // . ve .. dizinlerini atla
        if ($file === '.' || $file === '..') {
            continue;
        }
        
        $filePath = $imagesDir . $file;
        
        // Sadece dosyaları al
        if (is_file($filePath)) {
            // Dosya uzantısını kontrol et
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
            
            if (in_array($extension, $allowedExtensions)) {
                $fileSize = filesize($filePath);
                $fileSizeFormatted = formatFileSize($fileSize);
                
                // Dosya türünü belirle
                $type = 'Genel';
                if (strpos($file, 'hero') !== false) {
                    $type = 'Hero';
                } elseif (strpos($file, 'about') !== false) {
                    $type = 'Hakkımızda';
                } elseif (strpos($file, 'service') !== false) {
                    $type = 'Hizmet';
                } elseif (strpos($file, 'gallery') !== false) {
                    $type = 'Galeri';
                }
                
                $images[] = [
                    'name' => $file,
                    'type' => $type,
                    'size' => $fileSizeFormatted,
                    'path' => '../assets/images/' . $file
                ];
            }
        }
    }
    
    // Dosyaları tarihe göre sırala (en yeni önce)
    usort($images, function($a, $b) use ($imagesDir) {
        $timeA = filemtime($imagesDir . $a['name']);
        $timeB = filemtime($imagesDir . $b['name']);
        return $timeB - $timeA;
    });
    
    echo json_encode([
        'success' => true,
        'images' => $images,
        'count' => count($images)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}
?>
