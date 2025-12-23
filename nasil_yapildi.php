<?php 
// DOSYA YOLU: /proje_klasörü/nasil_yapildi.php
require_once 'session_check.php'; 
require_once 'header.php';
?>

<section class="content-section">
    <h2>Bu Proje Nasıl Hazırlandı? (Geliştirme Süreci ve Kılavuz)</h2>
    <p style="font-size: 1.1em; border-left: 4px solid var(--primary-accent); padding-left: 15px; margin-bottom: 30px;">
        Bu sunum sitesi, modern web geliştirme pratikleri kullanılarak inşa edilmiştir. Aşağıdaki adımlar, projenin temel mantığını, teknoloji yığınını ve kurulum sürecini detaylandırmaktadır.
    </p>

    <h3 style="margin-top: 40px; color: var(--bg-dark-header);">1. Kurulum ve Sunucu Ortamının Hazırlanması</h3>
    <p>Bu sitenin çalışması için bir PHP yorumlayıcısı ve Apache/Nginx sunucusuna ihtiyacınız vardır. (Örn: XAMPP, Laragon).</p>

    <div class="feature-grid" style="grid-template-columns: 1fr;">
        <div class="feature-box" style="background-color: #f5f5f5;">
            <h4 style="color: var(--primary-accent);">Adım Adım Kurulum</h4>
            <ol>
                <li>**Klasör Oluşturma:** XAMPP'teki `htdocs` veya Laragon'daki `www` klasörü içine `flutter-proje` adında bir dizin oluşturun.</li>
                <li>**Dosyaları Kopyalama:** `login.php`, `index.php`, `header.php`, `footer.php` ve diğer tüm `.php` dosyalarını bu dizine kopyalayın.</li>
                <li>**Test:** Tarayıcınızda `http://localhost/flutter-proje/login.php` adresine giderek giriş ekranının gelip gelmediğini kontrol edin.</li>
            </ol>
        </div>
    </div>

    <h3 style="margin-top: 60px; color: var(--bg-dark-header);">2. Teknoloji Yığını ve Nedenleri</h3>
    <p>Proje, platformlararası uyumluluk ve yüksek performans için modern bir teknoloji yığını üzerine inşa edilmiştir:</p>
    
    <div class="feature-grid" style="grid-template-columns: repeat(3, 1fr);">
        <div class="test-button" style="background-color: #e3f2fd; border-color: #bbdefb; padding: 25px;">
            <h4 style="color: #1a237e; margin-bottom: 5px;">PHP 8.x (Backend)</h4>
            <p style="font-size: 0.9em; margin: 0;">Sitenin omurgasını oluşturdu. **Oturum Yönetimi** (Session) ve **Modüler Dosya Yapısı** (header/footer çağırma) ile Template Engine mantığı sağlandı.</p>
        </div>
        <div class="test-button" style="background-color: #e8f5e9; border-color: #c8e6c9; padding: 25px;">
            <h4 style="color: #43a047;">CSS3 (Custom)</h4>
            <p style="font-size: 0.9em; margin: 0;">Hiçbir Framework kullanılmadan, saf CSS ile mobil uyumlu (responsive) ve kurumsal bir tema uygulandı. **Hover animasyonları** ile UI/UX kalitesi artırıldı.</p>
        </div>
        <div class="test-button" style="background-color: #fff8e1; border-color: #ffecb3; padding: 25px;">
            <h4 style="color: #ff6f00;">JavaScript (ES6)</h4>
            <p style="font-size: 0.9em; margin: 0;">Sanal demoların (Chart.js grafiği) simülasyonunu ve basit UI etkileşimlerini (butonların parlama efektleri) yönetti.</p>
        </div>
    </div>

    <h3 style="margin-top: 60px; color: var(--bg-dark-header);">3. Geliştirme Süreci ve Mimari (Kod Yönetimi)</h3>
    <p>Kod tekrarını önlemek ve bakımı kolaylaştırmak için modüler PHP tasarımı uygulandı:</p>
    
    <div class="feature-grid" style="grid-template-columns: 1fr;">
        <div class="feature-box" style="background-color: #f0f4c3;">
            <h4 style="color: var(--primary-accent);">Mimari Prensip: Sorumlulukların Ayrılması (Separation of Concerns)</h4>
            <ul>
                <li>**Oturum Kontrolü (`session_check.php`):** Yalnızca kullanıcının giriş durumunu kontrol etme sorumluluğu bu dosyaya verildi. Her sayfa içeriği göstermeden önce bu dosyayı çağırır.</li>
                <li>**Tasarım Şablonları (`header.php`, `footer.php`):** HTML başlangıç etiketleri, CSS ve navigasyon menüsü (`header.php`) ile kapanış etiketleri (`footer.php`) ayrıldı. Bu sayede, menüdeki bir değişikliği tek bir yerde yaptık.</li>
                <li>**İçerik Dosyaları (`index.php`, `kod_analizi.php` vb.):** Yalnızca sayfanın ana HTML içeriğini ve akademik metinleri tutar.</li>
            </ul>
        </div>
    </div>
    
    <h3 style="margin-top: 60px; color: var(--bg-dark-header);">4. Gelecek Çalışmalar ve Geliştirici Notları</h3>
    <p>Bu sunum sitesi üzerine, daha gelişmiş bir PHP altyapısı inşa edilebilir:</p>
    
    <div class="feature-grid" style="grid-template-columns: 1fr;">
        <div class="feature-box" style="background-color: #f0f4c3;">
            <h4 style="color: var(--primary-accent);">Önerilen Geliştirme Yönleri</h4>
            <ul>
                <li>**PHP MVC Dönüşümü:** Sitedeki URL'leri yönetmek için `index.php`'yi kullanarak bir **Router** sistemi eklemek.</li>
                <li>**Veritabanı Entegrasyonu:** Giriş bilgilerini kod içine yazmak yerine, MySQL veritabanından çekmek ve kalıcı kullanıcılar oluşturmak.</li>
            </ul>
        </div>
    </div>

</section>

<?php 
require_once 'footer.php';
?>