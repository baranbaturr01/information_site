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
    $section = $_GET['section'] ?? 'all';
    
    $data = getData();
    
    if ($section === 'all') {
        $response = [
            'success' => true,
            'data' => $data
        ];
    } else {
        if (isset($data[$section])) {
            $response = [
                'success' => true,
                'data' => $data[$section]
            ];
        } else {
            throw new Exception('Bölüm bulunamadı');
        }
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
