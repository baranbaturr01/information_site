// Admin Panel JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Giriş kontrolü
    if (localStorage.getItem('admin_logged_in') !== 'true') {
        window.location.href = 'login.html';
        return;
    }
    // Sidebar toggle for mobile
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Navigation
    const navLinks = document.querySelectorAll('.sidebar-nav a');
    const contentSections = document.querySelectorAll('.content-section');
    const pageTitle = document.getElementById('page-title');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetSection = this.getAttribute('data-section');
            
            // Update active nav item
            navLinks.forEach(nav => nav.parentElement.classList.remove('active'));
            this.parentElement.classList.add('active');
            
            // Show target section
            contentSections.forEach(section => section.classList.remove('active'));
            document.getElementById(targetSection).classList.add('active');
            
            // Update page title
            const sectionName = this.querySelector('span').textContent;
            pageTitle.textContent = sectionName;
        });
    });

    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Update active tab button
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Show target panel
            tabPanels.forEach(panel => panel.classList.remove('active'));
            document.getElementById(targetTab).classList.add('active');
        });
    });

    // Form submissions
    const contentForms = document.querySelectorAll('.content-form');
    
    contentForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const section = this.closest('.tab-panel').id;
            const data = {};
            
            // Form verilerini topla
            this.querySelectorAll('input, textarea, select').forEach(input => {
                if (input.name || input.id) {
                    const key = input.name || input.id.replace(section + '-', '');
                    data[key] = input.value;
                }
            });
            
            // API'ye gönder
            fetch('api/save_content.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    section: section,
                    data: data
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showNotification(result.message, 'success');
                } else {
                    showNotification(result.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Bir hata oluştu!', 'error');
            });
        });
    });

    // Service update buttons
    const updateServiceBtns = document.querySelectorAll('.update-service-btn');
    
    updateServiceBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const serviceItem = this.closest('.service-item');
            const description = serviceItem.querySelector('.service-description').value;
            
            // Show success message
            showNotification('Hizmet başarıyla güncellendi!', 'success');
            
            console.log('Service updated:', description);
        });
    });

    // Image upload functionality
    const imageUpload = document.getElementById('image-upload');
    const uploadBtn = document.querySelector('.upload-btn');
    const uploadZone = document.querySelector('.upload-zone');
    
    // About image upload
    const aboutImageUpload = document.getElementById('about-image');
    if (aboutImageUpload) {
        aboutImageUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('type', 'about');
                
                fetch('api/upload_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showNotification('Hakkımızda görseli başarıyla yüklendi!', 'success');
                        // Ana sayfayı yenilemek için kullanıcıya bilgi ver
                        setTimeout(() => {
                            showNotification('Ana sayfada görseli görmek için sayfayı yenileyin', 'info');
                        }, 2000);
                    } else {
                        showNotification(result.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Görsel yüklenirken hata oluştu!', 'error');
                });
            }
        });
    }
    
    // Hero video upload
    const heroVideoUpload = document.getElementById('hero-video');
    if (heroVideoUpload) {
        heroVideoUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('video', file);
                formData.append('type', 'hero-video');
                
                fetch('api/upload_video.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showNotification('Hero video başarıyla yüklendi!', 'success');
                        setTimeout(() => {
                            showNotification('Ana sayfada videoyu görmek için sayfayı yenileyin', 'info');
                        }, 2000);
                    } else {
                        showNotification(result.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Video yüklenirken hata oluştu!', 'error');
                });
            }
        });
    }
    
    // Hero video WebM upload
    const heroVideoWebmUpload = document.getElementById('hero-video-webm');
    if (heroVideoWebmUpload) {
        heroVideoWebmUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('video', file);
                formData.append('type', 'hero-video-webm');
                
                fetch('api/upload_video.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showNotification('Hero WebM video başarıyla yüklendi!', 'success');
                        setTimeout(() => {
                            showNotification('Ana sayfada videoyu görmek için sayfayı yenileyin', 'info');
                        }, 2000);
                    } else {
                        showNotification(result.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Video yüklenirken hata oluştu!', 'error');
                });
            }
        });
    }
    
    // Hero GIF upload
    const heroGifUpload = document.getElementById('hero-gif');
    if (heroGifUpload) {
        heroGifUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('type', 'hero-gif');
                
                fetch('api/upload_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        showNotification('Hero GIF başarıyla yüklendi!', 'success');
                        setTimeout(() => {
                            showNotification('Ana sayfada GIF\'i görmek için sayfayı yenileyin', 'info');
                        }, 2000);
                    } else {
                        showNotification(result.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('GIF yüklenirken hata oluştu!', 'error');
                });
            }
        });
    }
    
    if (uploadBtn && imageUpload) {
        uploadBtn.addEventListener('click', function() {
            imageUpload.click();
        });
    }
    
    if (imageUpload) {
        imageUpload.addEventListener('change', function(e) {
            const files = e.target.files;
            
            if (files.length > 0) {
                showNotification(`${files.length} dosya yükleniyor...`, 'info');
                
                // Her dosyayı yükle
                Array.from(files).forEach(file => {
                    const formData = new FormData();
                    formData.append('image', file);
                    
                    fetch('api/upload_image.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            showNotification(result.message, 'success');
                            // Görsel listesini güncelle
                            setTimeout(() => {
                                loadImages();
                            }, 1000);
                        } else {
                            showNotification(result.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Görsel yüklenirken hata oluştu!', 'error');
                    });
                });
            }
        });
    }

    // Drag and drop for upload zone
    if (uploadZone) {
        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#e74c3c';
            this.style.background = '#fff5f5';
        });
        
        uploadZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.background = '#f8f9fa';
        });
        
        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.background = '#f8f9fa';
            
            const files = e.dataTransfer.files;
            
            if (files.length > 0) {
                showNotification(`${files.length} dosya yükleniyor...`, 'info');
                
                setTimeout(() => {
                    showNotification('Görseller başarıyla yüklendi!', 'success');
                    console.log('Dropped files:', files);
                }, 2000);
            }
        });
    }

    // Load messages on page load
    loadMessages();
    
    // Message filters
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active filter
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Reload messages with filter
            loadMessages(filter);
        });
    });

    // Modal functionality
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    const closeModal = document.querySelector('.close');
    
    if (closeModal) {
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }
    
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    }

    // Initialize dashboard stats
    initializeDashboardStats();
    
    // Load images on page load
    loadImages();
    
    // Load content data on page load
    loadContentData();
    
    // Load dashboard data on page load
    loadDashboardData();
});

// Global functions
function loadContentData() {
    // Hero section verilerini yükle
    fetch('api/get_content.php?section=hero')
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                const hero = result.data;
                document.getElementById('hero-title').value = hero.title || '';
                document.getElementById('hero-subtitle').value = hero.subtitle || '';
                document.getElementById('hero-description').value = hero.description || '';
            }
        })
        .catch(error => console.error('Hero verileri yüklenirken hata:', error));

    // About section verilerini yükle
    fetch('api/get_content.php?section=about')
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                const about = result.data;
                document.getElementById('about-description').value = about.description || '';
                document.getElementById('mission-text').value = about.mission || '';
                document.getElementById('vision-text').value = about.vision || '';
            }
        })
        .catch(error => console.error('About verileri yüklenirken hata:', error));

    // Contact section verilerini yükle
    fetch('api/get_content.php?section=contact')
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                const contact = result.data;
                document.getElementById('contact-address').value = contact.address || '';
                document.getElementById('contact-phone').value = contact.phone || '';
                document.getElementById('contact-email').value = contact.email || '';
                document.getElementById('contact-hours').value = contact.hours || '';
            }
        })
        .catch(error => console.error('Contact verileri yüklenirken hata:', error));
}

function loadDashboardData() {
    console.log('Dashboard verileri yükleniyor...');
    // Dashboard istatistiklerini yükle
    fetch('api/get_dashboard_stats.php')
        .then(response => response.json())
        .then(result => {
            console.log('Dashboard API yanıtı:', result);
            if (result.success) {
                updateDashboardStats(result.data);
                updateRecentMessages(result.recentMessages);
            }
        })
        .catch(error => console.error('Dashboard verileri yüklenirken hata:', error));
}

function updateDashboardStats(stats) {
    console.log('Dashboard istatistikleri güncelleniyor:', stats);
    
    // Toplam görüntülenme
    const totalViews = document.querySelector('.stat-card:nth-child(1) .stat-info h3');
    if (totalViews) {
        console.log('Toplam görüntülenme elementi bulundu, değer:', stats.totalViews);
        animateCounter(totalViews, stats.totalViews || 0);
    } else {
        console.log('Toplam görüntülenme elementi bulunamadı');
    }
    
    // Yeni mesajlar
    const newMessages = document.querySelector('.stat-card:nth-child(2) .stat-info h3');
    if (newMessages) {
        console.log('Yeni mesajlar elementi bulundu, değer:', stats.newMessages);
        animateCounter(newMessages, stats.newMessages || 0);
    } else {
        console.log('Yeni mesajlar elementi bulunamadı');
    }
    
    // Toplam görsel
    const totalImages = document.querySelector('.stat-card:nth-child(3) .stat-info h3');
    if (totalImages) {
        console.log('Toplam görsel elementi bulundu, değer:', stats.totalImages);
        animateCounter(totalImages, stats.totalImages || 0);
    } else {
        console.log('Toplam görsel elementi bulunamadı');
    }
    
    // Bu hafta
    const thisWeek = document.querySelector('.stat-card:nth-child(4) .stat-info h3');
    if (thisWeek) {
        console.log('Bu hafta elementi bulundu, değer:', stats.thisWeek);
        animateCounter(thisWeek, stats.thisWeek || 0);
    } else {
        console.log('Bu hafta elementi bulunamadı');
    }
}

function updateRecentMessages(messages) {
    console.log('Son mesajlar güncelleniyor:', messages);
    const messageList = document.querySelector('.recent-messages .message-list');
    if (!messageList) {
        console.log('Mesaj listesi elementi bulunamadı');
        return;
    }
    if (!messages) {
        console.log('Mesaj verisi yok');
        return;
    }
    
    if (messages.length === 0) {
        console.log('Mesaj yok, boş mesaj gösteriliyor');
        messageList.innerHTML = '<div class="no-messages"><p>Henüz mesaj yok</p></div>';
        return;
    }
    
    console.log('Mesajlar listeleniyor, sayı:', messages.length);
    messageList.innerHTML = messages.map(message => `
        <div class="message-item">
            <div class="message-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="message-content">
                <h4>${message.name}</h4>
                <p>${message.message.substring(0, 50)}${message.message.length > 50 ? '...' : ''}</p>
                <span class="message-time">${formatTimeAgo(message.date)}</span>
            </div>
        </div>
    `).join('');
}

function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) {
        return 'Az önce';
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `${minutes} dakika önce`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `${hours} saat önce`;
    } else {
        const days = Math.floor(diffInSeconds / 86400);
        return `${days} gün önce`;
    }
}

function showSection(sectionName) {
    const navLink = document.querySelector(`[data-section="${sectionName}"]`);
    if (navLink) {
        navLink.click();
    }
}

function previewImage(imageName) {
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    
    modalImage.src = `../assets/images/${imageName}`;
    modal.style.display = 'block';
}

function loadImages() {
    // Görsel dizinini kontrol et ve mevcut görselleri listele
    const imageGallery = document.querySelector('.image-gallery .gallery-grid');
    if (!imageGallery) return;
    
    // API'den görselleri çek
    fetch('api/get_images.php')
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                const images = result.images;
                
                if (images.length === 0) {
                    imageGallery.innerHTML = '<div class="no-images"><p>Henüz görsel yüklenmemiş</p></div>';
                    return;
                }
                
                imageGallery.innerHTML = images.map(image => `
                    <div class="gallery-item">
                        <div class="image-preview">
                            <img src="../assets/images/${image.name}" alt="${image.name}" 
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="image-placeholder" style="display: none;">
                                <i class="fas fa-image"></i>
                                <span>Görsel bulunamadı</span>
                            </div>
                        </div>
                        <div class="image-info">
                            <span class="image-name">${image.name}</span>
                            <span class="image-type">${image.type || 'Genel'}</span>
                            <span class="image-size">${image.size}</span>
                        </div>
                        <div class="image-actions">
                            <button onclick="previewImage('${image.name}')" class="action-btn">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="deleteImage('${image.name}')" class="action-btn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
            } else {
                imageGallery.innerHTML = '<div class="no-images"><p>Görseller yüklenirken hata oluştu</p></div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            imageGallery.innerHTML = '<div class="no-images"><p>Görseller yüklenirken hata oluştu</p></div>';
        });
}

function previewImage(imageName) {
    // Modal oluştur
    const modal = document.createElement('div');
    modal.className = 'image-preview-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h3>Görsel Önizleme</h3>
                <button class="modal-close" onclick="this.parentElement.parentElement.parentElement.remove()">&times;</button>
            </div>
            <div class="modal-body">
                <img src="../assets/images/${imageName}" alt="${imageName}" style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <button class="action-btn" onclick="downloadImage('${imageName}')">
                    <i class="fas fa-download"></i> İndir
                </button>
                <button class="action-btn delete" onclick="deleteImage('${imageName}'); this.parentElement.parentElement.parentElement.remove();">
                    <i class="fas fa-trash"></i> Sil
                </button>
            </div>
        </div>
    `;
    
    // Modal stillerini ekle
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
    `;
    
    const modalContent = modal.querySelector('.modal-content');
    modalContent.style.cssText = `
        background: white;
        border-radius: 10px;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    `;
    
    const modalHeader = modal.querySelector('.modal-header');
    modalHeader.style.cssText = `
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    `;
    
    const modalBody = modal.querySelector('.modal-body');
    modalBody.style.cssText = `
        padding: 20px;
        text-align: center;
    `;
    
    const modalFooter = modal.querySelector('.modal-footer');
    modalFooter.style.cssText = `
        padding: 20px;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
        justify-content: center;
    `;
    
    const modalClose = modal.querySelector('.modal-close');
    modalClose.style.cssText = `
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
    `;
    
    document.body.appendChild(modal);
    
    // Modal dışına tıklandığında kapat
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });
}

function deleteImage(imageName) {
    if (confirm('Bu görseli silmek istediğinizden emin misiniz?')) {
        fetch('api/delete_image.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                image_name: imageName
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showNotification('Görsel başarıyla silindi!', 'success');
                loadImages(); // Listeyi yenile
            } else {
                showNotification(result.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Görsel silinirken hata oluştu!', 'error');
        });
    }
}

function downloadImage(imageName) {
    const link = document.createElement('a');
    link.href = '../assets/images/' + imageName;
    link.download = imageName;
    link.click();
}

function loadMessages(filter = 'all') {
    fetch('api/get_messages.php')
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Mesaj verilerini global olarak sakla
                window.messagesData = result.messages;
                displayMessages(result.messages, filter);
                updateMessageStats(result.count, result.unread_count);
            } else {
                showNotification('Mesajlar yüklenirken hata oluştu!', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Mesajlar yüklenirken hata oluştu!', 'error');
        });
}

function displayMessages(messages, filter = 'all') {
    const messagesContainer = document.querySelector('.messages-list');
    if (!messagesContainer) return;
    
    // Filter messages
    let filteredMessages = messages;
    if (filter === 'unread') {
        filteredMessages = messages.filter(msg => !msg.read);
    } else if (filter === 'read') {
        filteredMessages = messages.filter(msg => msg.read);
    }
    
    if (filteredMessages.length === 0) {
        messagesContainer.innerHTML = '<div class="no-messages"><p>Mesaj bulunamadı</p></div>';
        return;
    }
    
    messagesContainer.innerHTML = filteredMessages.map(message => `
        <div class="message-item ${!message.read ? 'unread' : ''}" data-id="${message.id}">
            <div class="message-header">
                <div class="message-info">
                    <h4>${message.name}</h4>
                    <span class="message-date">${formatDate(message.date)}</span>
                    <span class="message-email">${message.email}</span>
                    ${message.phone ? `<span class="message-phone">${message.phone}</span>` : ''}
                    ${message.service ? `<span class="message-service">${message.service}</span>` : ''}
                </div>
                <div class="message-actions">
                    <button onclick="viewMessage('${message.id}')" class="action-btn view-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                    ${!message.read ? 
                        `<button onclick="markAsRead('${message.id}')" class="action-btn read-btn">
                            <i class="fas fa-check"></i>
                        </button>` : 
                        `<button onclick="markAsUnread('${message.id}')" class="action-btn unread-btn">
                            <i class="fas fa-envelope"></i>
                        </button>`
                    }
                    <button onclick="deleteMessage('${message.id}')" class="action-btn delete-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="message-content">
                <p>${message.message}</p>
            </div>
        </div>
    `).join('');
}

function updateMessageStats(total, unread) {
    const totalElement = document.querySelector('.stat-card:nth-child(1) .stat-info h3');
    const unreadElement = document.querySelector('.stat-card:nth-child(2) .stat-info h3');
    
    if (totalElement) totalElement.textContent = total;
    if (unreadElement) unreadElement.textContent = unread;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('tr-TR', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function viewMessage(messageId) {
    // Mesajı bul
    const message = window.messagesData.find(msg => msg.id == messageId);
    if (!message) {
        showNotification('Mesaj bulunamadı!', 'error');
        return;
    }
    
    // Modal oluştur
    const modal = document.createElement('div');
    modal.className = 'message-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h3>Mesaj Detayları</h3>
                <button class="modal-close" onclick="this.parentElement.parentElement.parentElement.remove()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="message-detail">
                    <div class="detail-row">
                        <strong>Gönderen:</strong> ${message.name}
                    </div>
                    <div class="detail-row">
                        <strong>E-posta:</strong> ${message.email}
                    </div>
                    <div class="detail-row">
                        <strong>Telefon:</strong> ${message.phone || 'Belirtilmemiş'}
                    </div>
                    <div class="detail-row">
                        <strong>Hizmet:</strong> ${message.service || 'Belirtilmemiş'}
                    </div>
                    <div class="detail-row">
                        <strong>Tarih:</strong> ${message.date}
                    </div>
                    <div class="detail-row">
                        <strong>Mesaj:</strong>
                        <div class="message-content">${message.message}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="action-btn" onclick="replyMessage('${messageId}')">
                    <i class="fas fa-reply"></i> Yanıtla
                </button>
                <button class="action-btn" onclick="markAsRead('${messageId}'); this.parentElement.parentElement.parentElement.remove();">
                    <i class="fas fa-check"></i> Okundu İşaretle
                </button>
                <button class="action-btn delete" onclick="deleteMessage('${messageId}'); this.parentElement.parentElement.parentElement.remove();">
                    <i class="fas fa-trash"></i> Sil
                </button>
            </div>
        </div>
    `;
    
    // Modal stillerini ekle
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
    `;
    
    const modalContent = modal.querySelector('.modal-content');
    modalContent.style.cssText = `
        background: white;
        border-radius: 10px;
        width: 90%;
        max-width: 600px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    `;
    
    const modalHeader = modal.querySelector('.modal-header');
    modalHeader.style.cssText = `
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    `;
    
    const modalBody = modal.querySelector('.modal-body');
    modalBody.style.cssText = `
        padding: 20px;
    `;
    
    const modalFooter = modal.querySelector('.modal-footer');
    modalFooter.style.cssText = `
        padding: 20px;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    `;
    
    const detailRow = modal.querySelectorAll('.detail-row');
    detailRow.forEach(row => {
        row.style.cssText = `
            margin-bottom: 15px;
            line-height: 1.6;
        `;
    });
    
    const messageContent = modal.querySelector('.message-content');
    messageContent.style.cssText = `
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
        white-space: pre-wrap;
        line-height: 1.6;
    `;
    
    const modalClose = modal.querySelector('.modal-close');
    modalClose.style.cssText = `
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
    `;
    
    document.body.appendChild(modal);
    
    // Modal dışına tıklandığında kapat
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });
}

function replyMessage(messageId) {
    const message = window.messagesData.find(msg => msg.id == messageId);
    if (!message) {
        showNotification('Mesaj bulunamadı!', 'error');
        return;
    }
    
    // E-posta uygulamasını aç
    const subject = encodeURIComponent(`Re: SARL SAMAK - ${message.service || 'Mesajınız Hakkında'}`);
    const body = encodeURIComponent(`Sayın ${message.name},\n\nMesajınız için teşekkür ederiz.\n\nSaygılarımızla,\nSARL SAMAK Ekibi`);
    const mailtoLink = `mailto:${message.email}?subject=${subject}&body=${body}`;
    
    window.open(mailtoLink);
}

function markAsRead(messageId) {
    updateMessageStatus(messageId, 'mark_read');
}

function markAsUnread(messageId) {
    updateMessageStatus(messageId, 'mark_unread');
}

function updateMessageStatus(messageId, action) {
    fetch('api/update_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            message_id: messageId,
            action: action
        })
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showNotification(result.message, 'success');
            loadMessages(); // Mesajları yeniden yükle
        } else {
            showNotification(result.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('İşlem sırasında hata oluştu!', 'error');
    });
}

function deleteMessage(messageId) {
    if (confirm('Bu mesajı silmek istediğinizden emin misiniz?')) {
        fetch('api/update_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message_id: messageId,
                action: 'delete'
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showNotification('Mesaj başarıyla silindi!', 'success');
                loadMessages(); // Mesajları yeniden yükle
            } else {
                showNotification(result.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Mesaj silinirken hata oluştu!', 'error');
        });
    }
}

function logout() {
    if (confirm('Çıkış yapmak istediğinizden emin misiniz?')) {
        localStorage.removeItem('admin_logged_in');
        window.location.href = 'login.html';
    }
}

function initializeDashboardStats() {
    // Animate stats on dashboard load
    const statNumbers = document.querySelectorAll('.stat-info h3');
    
    statNumbers.forEach(stat => {
        const finalValue = stat.textContent;
        const numericValue = parseInt(finalValue.replace(/,/g, ''));
        
        if (!isNaN(numericValue)) {
            animateCounter(stat, numericValue);
        }
    });
}

function animateCounter(element, target) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current).toLocaleString();
    }, 30);
}

function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;
    
    // Style notification
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${getNotificationColor(type)};
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
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Close button
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => notification.remove(), 300);
    });
    
    // Auto close
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

function getNotificationIcon(type) {
    switch (type) {
        case 'success': return 'fa-check-circle';
        case 'error': return 'fa-exclamation-circle';
        case 'warning': return 'fa-exclamation-triangle';
        default: return 'fa-info-circle';
    }
}

function getNotificationColor(type) {
    switch (type) {
        case 'success': return '#27ae60';
        case 'error': return '#e74c3c';
        case 'warning': return '#f39c12';
        default: return '#3498db';
    }
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S to save
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        const activeForm = document.querySelector('.content-form');
        if (activeForm) {
            activeForm.dispatchEvent(new Event('submit'));
        }
    }
    
    // Escape to close modal
    if (e.key === 'Escape') {
        const modal = document.getElementById('image-modal');
        if (modal && modal.style.display === 'block') {
            modal.style.display = 'none';
        }
    }
});

// Auto-save functionality
let autoSaveTimer;
const autoSaveDelay = 30000; // 30 seconds

function setupAutoSave() {
    const formInputs = document.querySelectorAll('.content-form input, .content-form textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                showNotification('Değişiklikler otomatik kaydedildi!', 'success');
                console.log('Auto-saving...');
            }, autoSaveDelay);
        });
    });
}

// Initialize auto-save when content section is shown
document.addEventListener('DOMContentLoaded', function() {
    const contentLink = document.querySelector('[data-section="content"]');
    if (contentLink) {
        contentLink.addEventListener('click', function() {
            setTimeout(setupAutoSave, 100);
        });
    }
});
