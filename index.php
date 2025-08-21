<?php
// Veri dosyasını oku
$dataFile = 'admin/data/site_data.json';
$siteData = [];

if (file_exists($dataFile)) {
    $siteData = json_decode(file_get_contents($dataFile), true);
}

// Varsayılan değerler
$hero = $siteData['hero'] ?? [
    'title' => 'SARL SAMAK',
    'subtitle' => 'İş Makineleri ve Endüstriyel Ekipman',
    'description' => '1998\'den beri güvenilir çözümler, kaliteli hizmet'
];

$about = $siteData['about'] ?? [
    'description' => '1998 yılında kurulan SARL SAMAK, iş makineleri ve endüstriyel ekipman alanında faaliyet gösteren köklü bir şirkettir. Kuruluşumuzdan bu yana temel amacımız, müşterilerimize güvenilir, kaliteli ve sürdürülebilir çözümler sunmak olmuştur.',
    'mission' => 'Müşterilerimize güvenilir, kaliteli ve yenilikçi çözümler sunarak, uzun vadeli iş ortaklıkları kurmak ve iş süreçlerini daha verimli hale getirmek.',
    'vision' => 'İş makineleri ve endüstriyel çözümler alanında, yerel ve uluslararası pazarda öncü ve tercih edilen bir marka olmak.'
];

$contact = $siteData['contact'] ?? [
    'address' => 'Endüstriyel Bölge, No: 123, Algiers, Cezayir',
    'phone' => '+213 123 456 789',
    'email' => 'info@sarlsamak.com',
    'hours' => 'Pazartesi - Cuma: 08:00 - 18:00\nCumartesi: 08:00 - 14:00'
];

// Görsel ve video kontrolü fonksiyonu
function getMediaPath($fileName, $defaultPath = '') {
    $mediaPath = 'assets/images/' . $fileName;
    if (file_exists($mediaPath)) {
        return $mediaPath;
    }
    return $defaultPath ?: 'assets/images/placeholder.jpg';
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($hero['title']); ?> - İş Makineleri ve Endüstriyel Ekipman</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <i class="fas fa-truck-monster"></i>
                <span><?php echo htmlspecialchars($hero['title']); ?></span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Ana Sayfa</a></li>
                <li><a href="#about">Hakkımızda</a></li>
                <li><a href="#services">Hizmetler</a></li>
                <li><a href="#equipment">Ekipmanlar</a></li>
                <li><a href="#gallery">Galeri</a></li>
                <li><a href="#contact">İletişim</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <!-- Hero Video Background -->
        <video autoplay muted loop playsinline class="hero-video" id="hero-video">
            <source src="<?php echo getMediaPath('hero-video.mp4', 'assets/images/hero-video.mp4'); ?>" type="video/mp4">
            <source src="<?php echo getMediaPath('hero-video.webm', 'assets/images/hero-video.webm'); ?>" type="video/webm">
            <!-- Fallback için GIF -->
            <img src="<?php echo getMediaPath('hero-animation.gif', 'assets/images/hero-animation.gif'); ?>" alt="İş Makineleri Animasyonu" class="hero-fallback">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="highlight"><?php echo htmlspecialchars($hero['title']); ?></span>
                <br><?php echo htmlspecialchars($hero['subtitle']); ?>
            </h1>
            <p class="hero-subtitle">
                <?php echo htmlspecialchars($hero['description']); ?>
            </p>
            <div class="hero-buttons">
                <a href="#services" class="btn btn-primary">Hizmetlerimiz</a>
                <a href="#contact" class="btn btn-secondary">İletişim</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <i class="fas fa-calendar-alt"></i>
                <span class="stat-number">25+</span>
                <span class="stat-label">Yıllık Deneyim</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-globe"></i>
                <span class="stat-number">3</span>
                <span class="stat-label">Ülke</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <span class="stat-number">500+</span>
                <span class="stat-label">Mutlu Müşteri</span>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-building"></i> Hakkımızda</h2>
                <p>1998'den beri sektörde güvenilir çözüm ortağınız</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <p><?php echo nl2br(htmlspecialchars($about['description'])); ?></p>
                    <p>Faaliyetlerimiz; makine satışı, kiralama, bakım ve onarım hizmetleri ile endüstriyel çözümler, beton santrali kurulumu ve kule vinç hizmetlerini kapsamaktadır.</p>
                    <div class="mission-vision">
                        <div class="mission">
                            <h3><i class="fas fa-bullseye"></i> Misyonumuz</h3>
                            <p><?php echo nl2br(htmlspecialchars($about['mission'])); ?></p>
                        </div>
                        <div class="vision">
                            <h3><i class="fas fa-star"></i> Vizyonumuz</h3>
                            <p><?php echo nl2br(htmlspecialchars($about['vision'])); ?></p>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="<?php echo getMediaPath('about-company.jpg', 'assets/images/about-company.jpg'); ?>" alt="SARL SAMAK Şirket Görseli">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-cogs"></i> Hizmetlerimiz</h2>
                <p>Projelerinize değer katan kapsamlı çözümler</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3>Makine Satışı</h3>
                    <p>Kaliteli iş makineleri ve endüstriyel ekipman satışı ile projelerinizi destekliyoruz.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Kiralama</h3>
                    <p>Kısa ve uzun vadeli kiralama seçenekleri ile esnek çözümler sunuyoruz.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Bakım & Onarım</h3>
                    <p>Uzman ekibimizle periyodik bakım ve hızlı onarım hizmetleri veriyoruz.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3>Endüstriyel Çözümler</h3>
                    <p>Beton santrali kurulumu ve endüstriyel tesis çözümleri sağlıyoruz.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-crane"></i>
                    </div>
                    <h3>Kule Vinç</h3>
                    <p>Profesyonel kule vinç hizmetleri ile yapı projelerinizi destekliyoruz.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3>Montaj Hizmetleri</h3>
                    <p>Uzman montaj ekibimizle ekipmanlarınızı güvenle kuruyoruz.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipment Section -->
    <section id="equipment" class="equipment">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-truck"></i> Ekipmanlarımız</h2>
                <p>Modern ve güvenilir iş makineleri</p>
            </div>
            <div class="equipment-grid">
                <div class="equipment-item">
                    <div class="equipment-icon">
                        <i class="fas fa-truck-pickup"></i>
                    </div>
                    <h3>Ekskavatörler</h3>
                    <p>Farklı kapasitelerde ekskavatör seçenekleri</p>
                </div>
                <div class="equipment-item">
                    <div class="equipment-icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <h3>Yükleyiciler</h3>
                    <p>Güçlü ve dayanıklı yükleyici makineler</p>
                </div>
                <div class="equipment-item">
                    <div class="equipment-icon">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <h3>Buldozerler</h3>
                    <p>Zorlu arazi koşulları için buldozerler</p>
                </div>
                <div class="equipment-item">
                    <div class="equipment-icon">
                        <i class="fas fa-truck-monster"></i>
                    </div>
                    <h3>Kamyonlar</h3>
                    <p>Yük taşıma için güvenilir kamyonlar</p>
                </div>
                <div class="equipment-item">
                    <div class="equipment-icon">
                        <i class="fas fa-crane"></i>
                    </div>
                    <h3>Vinçler</h3>
                    <p>Profesyonel vinç ve kaldırma ekipmanları</p>
                </div>
                <div class="equipment-item">
                    <div class="equipment-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3>Beton Santralleri</h3>
                    <p>Modern beton üretim tesisleri</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-images"></i> Galeri</h2>
                <p>Projelerimizden görseller</p>
            </div>
            <div class="gallery-grid" id="gallery-grid">
                <!-- Görseller JavaScript ile yüklenecek -->
                <div class="loading">Görseller yükleniyor...</div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-envelope"></i> İletişim</h2>
                <p>Bizimle iletişime geçin</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Adres</h3>
                            <p><?php echo nl2br(htmlspecialchars($contact['address'])); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h3>Telefon</h3>
                            <p><?php echo htmlspecialchars($contact['phone']); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>E-posta</h3>
                            <p><?php echo htmlspecialchars($contact['email']); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Çalışma Saatleri</h3>
                            <p><?php echo nl2br(htmlspecialchars($contact['hours'])); ?></p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contact-form">
                        <div class="form-group">
                            <input type="text" id="contact-name" name="name" placeholder="Adınız" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="contact-email" name="email" placeholder="E-posta" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="contact-phone" name="phone" placeholder="Telefon">
                        </div>
                        <div class="form-group">
                            <select id="contact-service" name="service" required>
                                <option value="">Hizmet Seçin</option>
                                <option value="satis">Makine Satışı</option>
                                <option value="kiralama">Kiralama</option>
                                <option value="bakim">Bakım & Onarım</option>
                                <option value="montaj">Montaj</option>
                                <option value="diger">Diğer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea id="contact-message" name="message" placeholder="Mesajınız" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Mesaj Gönder</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-truck-monster"></i>
                        <span><?php echo htmlspecialchars($hero['title']); ?></span>
                    </div>
                    <p>1998'den beri iş makineleri ve endüstriyel ekipman sektöründe güvenilir çözümler sunuyoruz.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Hizmetler</h3>
                    <ul>
                        <li><a href="#services">Makine Satışı</a></li>
                        <li><a href="#services">Kiralama</a></li>
                        <li><a href="#services">Bakım & Onarım</a></li>
                        <li><a href="#services">Montaj</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Şirket</h3>
                    <ul>
                        <li><a href="#about">Hakkımızda</a></li>
                        <li><a href="#equipment">Ekipmanlar</a></li>
                        <li><a href="#contact">İletişim</a></li>
                        <li><a href="#">Kariyer</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>İletişim</h3>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($contact['address']); ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($contact['phone']); ?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($contact['email']); ?></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 <?php echo htmlspecialchars($hero['title']); ?>. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
    <script>
        // İletişim formu işlevselliği
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contact-form');
            
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    console.log('Form submit edildi!');
                    
                    // FormData kullanarak verileri topla
                    const formData = new FormData(this);
                    
                    // FormData'yı objeye çevir
                    const data = {};
                    for (let [key, value] of formData.entries()) {
                        data[key] = value.trim();
                    }
                    
                    console.log('FormData ile toplanan veriler:', data);
                    // Gerekli alanları kontrol et
                    if (!data.name) {
                        showNotification('Lütfen adınızı girin!', 'error');
                        return;
                    }
                    if (!data.email) {
                        showNotification('Lütfen e-posta adresinizi girin!', 'error');
                        return;
                    }
                    if (!data.message) {
                        showNotification('Lütfen mesajınızı girin!', 'error');
                        return;
                    }
                    
                    // Submit butonunu devre dışı bırak
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Gönderiliyor...';
                    
                    // API'ye gönder
                    fetch('api/contact.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            // Başarı mesajı göster
                            showNotification(result.message, 'success');
                            // Formu temizle
                            contactForm.reset();
                        } else {
                            showNotification(result.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Bir hata oluştu! Lütfen tekrar deneyin.', 'error');
                    })
                    .finally(() => {
                        // Submit butonunu tekrar aktif et
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                    });
                });
            }
        });
        
        // Bildirim sistemi
        function showNotification(message, type = 'info') {
            // Mevcut bildirimleri kaldır
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());
            
            // Bildirim oluştur
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
                    <span>${message}</span>
                    <button class="notification-close">&times;</button>
                </div>
            `;
            
            // Bildirim stilleri
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : '#3498db'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                transform: translateX(400px);
                transition: transform 0.3s ease;
                max-width: 400px;
                font-family: 'Inter', sans-serif;
            `;
            
            document.body.appendChild(notification);
            
            // Animasyon
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Kapatma butonu
            const closeBtn = notification.querySelector('.notification-close');
            closeBtn.addEventListener('click', () => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => notification.remove(), 300);
            });
            
            // Otomatik kapatma
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.transform = 'translateX(400px)';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }
        
        // Görüntülenme sayacı
        fetch('admin/api/increment_views.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        }).catch(error => console.log('Görüntülenme sayacı hatası:', error));
    </script>
</body>
</html>
