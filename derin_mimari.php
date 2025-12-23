<?php 
// DOSYA YOLU: /proje_klasörü/derin_mimari.php
require_once 'session_check.php'; 
require_once 'header.php';
?>

<section class="content-section">
    <h2>Platform Kanalları Mimarisi ve Teknik Karşılaştırma </h2>
    <p style="font-size: 1.1em; border-left: 4px solid var(--primary-accent); padding-left: 15px; margin-bottom: 30px;">
        MethodChannel, Dart'ın işletim sistemi donanımına (iOS/Android API'ları) erişimini sağlayan kritik köprü mekanizmasıdır. Bu mimari, uygulamamızın native dünyaya açılan kapısını oluşturur.
    </p>

    <h3 style="margin-top: 40px; color: var(--bg-dark-header);">MethodChannel: Temel Bileşenler ve Protokol</h3>
    <p>İletişim, isimlendirilmiş bir kanal (Channel) üzerinden asenkron mesajlaşma sistemine dayanır. Bu, yüksek performans ve kararlılık için tasarlanmıştır.</p>
    
    <div class="feature-grid">
        <div class="feature-box" style="background-color: #f5f5f5;">
            <h3>Binary Messenger</h3>
            <p>Dart ve Native platform arasında ham byte transferini yöneten düşük seviyeli mesajlaşma katmanıdır. Tüm iletişim bu ikili format üzerinden gerçekleşir.</p>
        </div>
        <div class="feature-box" style="background-color: #f5f5f5;">
            <h3>StandardMessageCodec</h3>
            <p>Dart objeleri (`List`, `Map`, `int`) ile Native objeleri (Kotlin/Swift tipleri) arasındaki çeviriyi (marshalling) yöneten serileştirme aracıdır. Tip güvenliği kritik öneme sahiptir.</p>
        </div>
        <div class="feature-box" style="background-color: #f5f5f5;">
            <h3>Asenkron Threading</h3>
            <p>MethodChannel çağrıları, Native tarafta arka planda (Worker Thread) işlenir ve sonuç Dart'a geri gönderilir. Bu, uygulamanın **UI Thread'ini bloklamaz** ve akıcılığı korur.</p>
        </div>
    </div>

    <h3 style="margin-top: 60px; color: var(--bg-dark-header);">Native API Erişim Farkları ve Zorluklar</h3>
    <p>Projenin en zorlayıcı kısmı, her platformun kendine özgü donanım erişim kısıtlamalarını yönetmektir.</p>
    
    <div class="feature-grid">
        <div class="feature-box" style="background-color: #e8f5e9;">
            <h4 style="color: #43a047;">Android (Kotlin) - Erişilebilirlik</h4>
            <ul>
                <li>**Pil Seviyesi:** `BatteryManager` ile yüksek doğrulukta okunur.</li>
                <li>**Sensörler:** `SensorManager` ile ortam ışığına doğrudan erişim vardır.</li>
                <li>**Yönetim:** Daha az kısıtlama ile API'lara erişim sağlanır.</li>
            </ul>
        </div>
        <div class="feature-box" style="background-color: #ffebee;">
            <h4 style="color: #d32f2f;">iOS (Swift) - Kısıtlamalar</h4>
            <ul>
                <li>**Ortam Işığı:** Doğrudan erişim yasaktır. Çözüm olarak `AVFoundation` (Kamera API'ı) kullanılarak ışık değeri türetilmiştir.</li>
                <li>**Pil Seviyesi:** Okunmadan önce `UIDevice.isBatteryMonitoringEnabled = true` ile izleme modu açılmalıdır.</li>
            </ul>
        </div>
    </div>
    
    <h3 style="margin-top: 60px; color: var(--bg-dark-header);">Teknolojik Alternatifler: Channel Çeşitleri</h3>
    <div class="feature-grid" style="grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="feature-box" style="background-color: #e1f5fe;">
            <h4 style="color: #0288d1;">MethodChannel (Kullanılan)</h4>
            <p>Tek seferlik (tek yönlü veya çift yönlü) metot çağrısı ve değer döndürme için idealdir. Pil seviyesi ve tekil sorgular için uygundur.</p>
        </div>
        <div class="feature-box" style="background-color: #e8f5e9;">
            <h4 style="color: #43a047;">EventChannel (Gelecek Çalışma)</h4>
            <p>Sürekli, akıcı veri akışları (Stream) için kullanılır. Jiroskop, manyetometre gibi sürekli değişen sensör verileri için gereklidir.</p>
        </div>
    </div>
    
</section>

<?php 
require_once 'footer.php';
?>