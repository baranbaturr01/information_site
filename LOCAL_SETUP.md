# 🖥️ Lokal Kurulum Rehberi

Bu rehber, SARL SAMAK web sitesini lokal ortamda çalıştırmak için gerekli adımları açıklar.

## 📋 Gereksinimler

### **PHP Kurulumu (Gerekli)**
Admin paneli için PHP gereklidir.

#### **macOS'ta PHP Kurulumu:**
```bash
# Homebrew ile PHP kurulumu
brew install php

# PHP versiyonunu kontrol et
php --version
```

#### **Windows'ta PHP Kurulumu:**
1. [XAMPP](https://www.apachefriends.org/) indirin ve kurun
2. XAMPP Control Panel'den Apache'yi başlatın
3. Dosyaları `htdocs` klasörüne kopyalayın

#### **Linux'ta PHP Kurulumu:**
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php php-cli

# CentOS/RHEL
sudo yum install php php-cli
```

## 🚀 Hızlı Başlangıç

### **1. PHP ile Sunucu Başlatma (Önerilen)**

Terminal'de şu komutları çalıştırın:

```bash
# Site klasörüne gidin
cd /Users/sabancidx/Desktop/test2/Site

# PHP sunucusunu başlatın
php -S localhost:8000
```

### **2. Tarayıcıda Test**

Sunucu başladıktan sonra tarayıcınızda şu adresleri açın:

- **Ana Site**: `http://localhost:8000`
- **Admin Panel**: `http://localhost:8000/admin`
- **Admin Giriş**: `http://localhost:8000/admin/login.html`

## 🔐 Admin Panel Giriş

### **Varsayılan Giriş Bilgileri:**
- **Kullanıcı Adı**: `admin`
- **Şifre**: `sarlsamak2024`

## 📁 Dosya Yapısı Kontrolü

Şu dosyaların mevcut olduğundan emin olun:

```
Site/
├── index.html              ✅ Ana sayfa
├── assets/
│   ├── css/main.css       ✅ Ana stiller
│   ├── js/main.js         ✅ Ana JavaScript
│   └── images/            ✅ Görseller klasörü
├── admin/
│   ├── index.html         ✅ Admin paneli
│   ├── login.html         ✅ Giriş sayfası
│   ├── api/
│   │   ├── config.php     ✅ Veritabanı config
│   │   ├── save_content.php ✅ İçerik kaydetme
│   │   ├── upload_image.php ✅ Görsel yükleme
│   │   └── get_content.php  ✅ İçerik okuma
│   └── assets/
│       ├── css/admin.css  ✅ Admin stilleri
│       └── js/admin.js    ✅ Admin JavaScript
└── README.md              ✅ Dokümantasyon
```

## 🔧 Özellikler Test

### **Ana Site Testleri:**
- ✅ Sayfa yükleniyor mu?
- ✅ Responsive tasarım çalışıyor mu?
- ✅ Smooth scroll çalışıyor mu?
- ✅ İletişim formu çalışıyor mu?

### **Admin Panel Testleri:**
- ✅ Giriş yapılabiliyor mu?
- ✅ İçerik düzenleme çalışıyor mu?
- ✅ Görsel yükleme çalışıyor mu?
- ✅ Kaydetme işlemi çalışıyor mu?

## 🖼️ Görsel Ekleme

### **Hero GIF Ekleme:**
1. `assets/images/` klasörüne GIF dosyası ekleyin
2. Adını `hero-animation.gif` yapın
3. Sayfayı yenileyin

### **Admin Panelden Görsel Yükleme:**
1. Admin paneline giriş yapın
2. "Görsel Yönetimi" bölümüne gidin
3. "Görsel Seç" butonunu kullanın
4. Dosyayı seçin ve yükleyin

## 🐛 Hata Giderme

### **PHP Hatası:**
```bash
# PHP versiyonunu kontrol et
php --version

# PHP modüllerini kontrol et
php -m
```

### **Dosya İzinleri:**
```bash
# Klasör izinlerini ayarla
chmod -R 755 admin/data/
chmod -R 755 assets/images/
```

### **Port Hatası:**
Eğer 8000 portu kullanımdaysa:
```bash
# Farklı port kullan
php -S localhost:8080
```

## 📊 Veri Saklama

Sistem şu anda JSON dosyası kullanıyor:
- **Dosya**: `admin/data/site_data.json`
- **Otomatik oluşturulur**: İlk çalıştırmada
- **Yedekleme**: Manuel olarak kopyalayabilirsiniz

## 🔄 Güncelleme

### **İçerik Güncelleme:**
1. Admin paneline giriş yapın
2. İlgili bölümü düzenleyin
3. "Kaydet" butonuna tıklayın
4. Değişiklikler anında kaydedilir

### **Kod Güncelleme:**
1. Dosyaları düzenleyin
2. Tarayıcıda sayfayı yenileyin
3. Değişiklikler görünür

## 📞 Destek

Sorun yaşarsanız:

1. **Tarayıcı Console'u kontrol edin** (F12)
2. **PHP hata loglarını kontrol edin**
3. **Dosya izinlerini kontrol edin**
4. **Dosya yollarını kontrol edin**

## 🚀 Canlıya Alma

Lokal test tamamlandıktan sonra:
1. `DEPLOYMENT.md` dosyasını inceleyin
2. Netlify, Vercel veya başka bir platform seçin
3. Dosyaları yükleyin

---

**Not**: Bu rehber sürekli güncellenmektedir. En güncel bilgiler için dokümantasyonu kontrol edin.
