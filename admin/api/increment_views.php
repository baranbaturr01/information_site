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
    $viewsFile = '../data/views.json';
    
    // Mevcut görüntülenme verilerini oku
    if (file_exists($viewsFile)) {
        $viewsData = json_decode(file_get_contents($viewsFile), true);
    } else {
        $viewsData = [
            'total' => 0,
            'daily' => [],
            'lastUpdate' => date('Y-m-d')
        ];
    }
    
    // Toplam görüntülenmeyi artır
    $viewsData['total']++;
    
    // Günlük istatistikleri güncelle
    $today = date('Y-m-d');
    if (!isset($viewsData['daily'][$today])) {
        $viewsData['daily'][$today] = 0;
    }
    $viewsData['daily'][$today]++;
    
    // Son güncelleme tarihini güncelle
    $viewsData['lastUpdate'] = $today;
    
    // Eski günlük verileri temizle (30 günden eski)
    $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));
    foreach ($viewsData['daily'] as $date => $count) {
        if ($date < $thirtyDaysAgo) {
            unset($viewsData['daily'][$date]);
        }
    }
    
    // Verileri kaydet
    if (file_put_contents($viewsFile, json_encode($viewsData, JSON_PRETTY_PRINT))) {
        $response = [
            'success' => true,
            'message' => 'Görüntülenme sayacı güncellendi',
            'total' => $viewsData['total']
        ];
    } else {
        throw new Exception('Görüntülenme sayacı kaydedilemedi');
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
