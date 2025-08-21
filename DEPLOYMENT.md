# 🚀 Canlıya Alma Rehberi

Bu rehber, SARL SAMAK web sitesini canlıya almak için gerekli adımları açıklar.

## 📋 Canlıya Alma Seçenekleri

### 1. **Netlify (Önerilen - Ücretsiz)**
- **Avantajlar**: Hızlı, ücretsiz, otomatik deployment
- **URL**: `https://sarlsamak.netlify.app` (özel domain eklenebilir)

#### Kurulum Adımları:
1. [Netlify.com](https://netlify.com) hesabı oluşturun
2. "New site from Git" seçin
3. GitHub/GitLab hesabınızı bağlayın
4. Repository'yi seçin
5. Build komutunu boş bırakın (static site)
6. Publish directory: `/` (root)
7. Deploy butonuna tıklayın

### 2. **Vercel (Alternatif - Ücretsiz)**
- **Avantajlar**: Hızlı, ücretsiz, otomatik deployment
- **URL**: `https://sarlsamak.vercel.app`

#### Kurulum Adımları:
1. [Vercel.com](https://vercel.com) hesabı oluşturun
2. "New Project" seçin
3. GitHub/GitLab repository'nizi import edin
4. Framework Preset: "Other" seçin
5. Deploy butonuna tıklayın

### 3. **GitHub Pages (Ücretsiz)**
- **Avantajlar**: GitHub ile entegre, ücretsiz
- **URL**: `https://kullaniciadi.github.io/repo-adi`

#### Kurulum Adımları:
1. Repository'de "Settings" sekmesine gidin
2. "Pages" bölümünü bulun
3. Source: "Deploy from a branch" seçin
4. Branch: "main" seçin
5. Save butonuna tıklayın

### 4. **Firebase Hosting (Google - Ücretsiz)**
- **Avantajlar**: Google altyapısı, hızlı
- **URL**: `https://sarlsamak.web.app`

#### Kurulum Adımları:
1. [Firebase Console](https://console.firebase.google.com) hesabı oluşturun
2. Yeni proje oluşturun
3. "Hosting" seçin
4. Firebase CLI kurun: `npm install -g firebase-tools`
5. `firebase login` ve `firebase init hosting`
6. `firebase deploy` komutunu çalıştırın

## 🌐 Özel Domain Ekleme

### Netlify'da Özel Domain:
1. Site ayarlarına gidin
2. "Domain management" sekmesi
3. "Add custom domain" butonu
4. Domain adınızı girin
5. DNS ayarlarını yapılandırın

### DNS Ayarları:
```
A Record: 75.2.60.5 (Netlify IP)
CNAME: www.sarlsamak.com → sarlsamak.netlify.app
```

## 📁 Dosya Yapısı (Canlıya Alma İçin)

```
Site/
├── index.html              # Ana sayfa
├── assets/
│   ├── css/
│   │   └── main.css        # Ana stiller
│   ├── js/
│   │   └── main.js         # Ana JavaScript
│   └── images/
│       ├── hero-animation.gif
│       └── about-company.jpg
├── admin/
│   ├── index.html          # Admin paneli
│   ├── assets/
│   │   ├── css/
│   │   │   └── admin.css   # Admin stilleri
│   │   └── js/
│   │       └── admin.js    # Admin JavaScript
│   └── login.html          # Giriş sayfası
├── README.md
└── DEPLOYMENT.md
```

## 🔧 Admin Panel Erişimi

### Admin Panel URL'leri:
- **Ana Site**: `https://sarlsamak.com`
- **Admin Panel**: `https://sarlsamak.com/admin`
- **Giriş Sayfası**: `https://sarlsamak.com/admin/login.html`

### Varsayılan Giriş Bilgileri:
- **Kullanıcı Adı**: `admin`
- **Şifre**: `sarlsamak2024`

## 📱 Mobil Uyumluluk

Site tüm cihazlarda mükemmel çalışır:
- ✅ Desktop (1200px+)
- ✅ Tablet (768px - 1199px)
- ✅ Mobile (480px - 767px)
- ✅ Small Mobile (480px altı)

## 🔒 Güvenlik Önerileri

### Admin Panel Güvenliği:
1. **Güçlü Şifre**: En az 12 karakter, büyük/küçük harf, sayı, özel karakter
2. **HTTPS**: SSL sertifikası kullanın
3. **Rate Limiting**: Brute force saldırılarına karşı koruma
4. **Backup**: Düzenli yedekleme yapın

### Örnek Güçlü Şifre:
```
S@rlS@m@k2024!Secure
```

## 📊 SEO Optimizasyonu

### Meta Etiketleri (index.html'de mevcut):
```html
<meta name="description" content="SARL SAMAK - 1998'den beri iş makineleri ve endüstriyel ekipman sektöründe güvenilir çözümler">
<meta name="keywords" content="iş makineleri, endüstriyel ekipman, ekskavatör, kiralama, bakım">
<meta name="author" content="SARL SAMAK">
```

### Google Analytics Ekleme:
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

## 🚀 Hızlı Başlangıç

### 1. Netlify ile (En Hızlı):
1. [Netlify Drop](https://app.netlify.com/drop) sayfasına gidin
2. Tüm dosyaları sürükleyip bırakın
3. Site otomatik olarak yayınlanır
4. URL'yi kopyalayın ve paylaşın

### 2. Manuel Upload:
1. Dosyaları web hosting'inize yükleyin
2. `index.html` dosyasını ana dizine koyun
3. Site hazır!

## 📞 Destek

Herhangi bir sorun yaşarsanız:
- **E-posta**: info@sarlsamak.com
- **Telefon**: +213 123 456 789
- **Dokümantasyon**: Bu README dosyasını inceleyin

## 🔄 Güncelleme

### İçerik Güncelleme:
1. Admin paneline giriş yapın
2. İlgili bölümü düzenleyin
3. Kaydet butonuna tıklayın
4. Değişiklikler anında yayınlanır

### Kod Güncelleme:
1. Dosyaları düzenleyin
2. Git'e commit edin
3. Netlify/Vercel otomatik olarak günceller

---

**Not**: Bu rehber sürekli güncellenmektedir. En güncel bilgiler için dokümantasyonu kontrol edin.
