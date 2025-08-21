<?php
// Veritabanı bağlantı ayarları
$host = 'localhost';
$dbname = 'sarlsamak_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Eğer veritabanı yoksa JSON dosyası kullan
    $pdo = null;
}

// JSON dosya yolu
$dataFile = '../data/site_data.json';
$imagesDir = '../../assets/images/';

// Görsel dizinini oluştur (eğer yoksa)
if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0777, true);
}

// JSON dosyasını oluştur (eğer yoksa)
if (!file_exists($dataFile)) {
    $defaultData = [
        'hero' => [
            'title' => 'SARL SAMAK',
            'subtitle' => 'İş Makineleri ve Endüstriyel Ekipman',
            'description' => '1998\'den beri güvenilir çözümler, kaliteli hizmet'
        ],
        'about' => [
            'description' => '1998 yılında kurulan SARL SAMAK, iş makineleri ve endüstriyel ekipman alanında faaliyet gösteren köklü bir şirkettir...',
            'mission' => 'Müşterilerimize güvenilir, kaliteli ve yenilikçi çözümler sunarak...',
            'vision' => 'İş makineleri ve endüstriyel çözümler alanında...'
        ],
        'contact' => [
            'address' => 'Endüstriyel Bölge, No: 123, Algiers, Cezayir',
            'phone' => '+213 123 456 789',
            'email' => 'info@sarlsamak.com',
            'hours' => 'Pazartesi - Cuma: 08:00 - 18:00\nCumartesi: 08:00 - 14:00'
        ],
        'services' => [
            'makine_satisi' => 'Kaliteli iş makineleri ve endüstriyel ekipman satışı ile projelerinizi destekliyoruz.',
            'kiralama' => 'Kısa ve uzun vadeli kiralama seçenekleri ile esnek çözümler sunuyoruz.',
            'bakim_onarim' => 'Uzman ekibimizle periyodik bakım ve hızlı onarım hizmetleri veriyoruz.'
        ]
    ];
    
    // Dizin oluştur
    if (!is_dir(dirname($dataFile))) {
        mkdir(dirname($dataFile), 0777, true);
    }
    
    file_put_contents($dataFile, json_encode($defaultData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Veri okuma fonksiyonu
function getData() {
    global $dataFile;
    if (file_exists($dataFile)) {
        return json_decode(file_get_contents($dataFile), true);
    }
    return [];
}

// Veri kaydetme fonksiyonu
function saveData($data) {
    global $dataFile;
    return file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Görsel yükleme fonksiyonu
function uploadImage($file) {
    global $imagesDir;
    
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        return ['success' => false, 'message' => 'Geçersiz dosya türü'];
    }
    
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'Dosya boyutu çok büyük (max 5MB)'];
    }
    
    $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    $filePath = $imagesDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        return ['success' => true, 'filename' => $fileName, 'path' => $filePath];
    }
    
    return ['success' => false, 'message' => 'Dosya yüklenemedi'];
}
?>
