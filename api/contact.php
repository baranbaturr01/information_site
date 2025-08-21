<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Sadece POST metodu kabul edilir']);
    exit;
}

// JSON verisini al
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Geçersiz JSON verisi']);
    exit;
}

// Gerekli alanları kontrol et
$required_fields = ['name', 'email', 'message'];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Lütfen $field alanını doldurun"]);
        exit;
    }
}

// E-posta doğrulaması
if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Geçersiz e-posta adresi']);
    exit;
}

// Mesaj verilerini hazırla
$message_data = [
    'id' => uniqid(),
    'name' => htmlspecialchars($input['name']),
    'email' => htmlspecialchars($input['email']),
    'phone' => htmlspecialchars($input['phone'] ?? ''),
    'service' => htmlspecialchars($input['service'] ?? ''),
    'message' => htmlspecialchars($input['message']),
    'date' => date('Y-m-d H:i:s'),
    'read' => false
];

// Mesajları kaydet
$messages_file = '../admin/data/messages.json';
$messages = [];

if (file_exists($messages_file)) {
    $messages = json_decode(file_get_contents($messages_file), true) ?? [];
}

$messages[] = $message_data;

if (file_put_contents($messages_file, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    // E-posta gönderimi (opsiyonel)
    $to = 'info@sarlsamak.com'; // Admin e-posta adresi
    $subject = 'Yeni İletişim Formu Mesajı - ' . $message_data['name'];
    
    $email_body = "
    Yeni bir iletişim formu mesajı alındı:
    
    Ad: {$message_data['name']}
    E-posta: {$message_data['email']}
    Telefon: {$message_data['phone']}
    Hizmet: {$message_data['service']}
    Mesaj: {$message_data['message']}
    Tarih: {$message_data['date']}
    ";
    
    $headers = 'From: ' . $message_data['email'] . "\r\n" .
               'Reply-To: ' . $message_data['email'] . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    // E-posta gönderimi (sunucu ayarlarına bağlı)
    // mail($to, $subject, $email_body, $headers);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Mesajınız başarıyla gönderildi! En kısa sürede size dönüş yapacağız.',
        'data' => $message_data
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Mesaj kaydedilirken bir hata oluştu']);
}
?>
