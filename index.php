<?php 
// DOSYA YOLU: /proje_klasörü/index.php
// LÜTFEN BU KODU MEVCUT index.php İLE DEĞİŞTİRİN
require_once 'session_check.php'; 
require_once 'header.php';
?>

<header class="header-section">
    <h1>FLUTTER PLATFORM KANALLARI: <br> Native Entegrasyonun Derinlikleri</h1>
    <p style="font-size: 1.1em; max-width: 800px; margin: 20px auto 40px;">
        Mobil uygulamaların fonksiyonel gereksinimleri, günümüzde yalnızca bir kullanıcı arayüzü oluşturmaktan çok daha fazlasını gerektirir. Bu proje, Flutter’ın MethodChannel kullanarak iOS (Swift) ve Android (Kotlin) cihaz donanımlarına erişimini kapsamaktadır.
    </p>
    <a href="derin_mimari.php" style="padding: 12px 30px; background-color: var(--link-blue); color: white; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 10px rgba(0, 188, 212, 0.4);">Mimarinin İçine Dalın</a>
</header>

<section id="neden-arastirma" class="content-section">
    <h2>Neden Bu Araştırma? - Platform Sınırlamaları ve Donanım İhtiyacı</h2>
    <p style="font-size: 1.1em; border-left: 4px solid var(--primary-dark-blue); padding-left: 15px; margin-bottom: 30px;">
        Modern mobil uygulamalar sadece arayüzden ibaret değildir.Kamera, GPS, Jiroskop ve Pil gibi donanımlar, işletim sistemi çekirdeği tarafından yönetilir.Flutter, kendi render motoruna (Skia/Impeller) sahip olduğu için UI çiziminde bağımsızdır , ancak bu bağımsızlık, sistem API'lerine doğrudan erişimi engeller.
    </p>
    
    <div class="feature-grid">
        <div class="feature-box">
            <h3>Pil Yönetimi</h3>
            <p>Flutter, pil seviyesini kendi başına okuyamaz. Erişimin native kod aracılığıyla yönetilmesi gerekir.Pil seviyesine göre enerji tüketimi optimize edilebilir. Bu verinin çekilmesi, projenin temelini oluşturur.</p>
        </div>
        <div class="feature-box">
            <h3>Çevresel Sensörler</h3>
            <p>Işık sensörünü kendi başına kullanamaz. Jiroskop, manyetometre gibi sensörlere erişemez. Ortamdaki ışık seviyesine göre ekran davranışı değiştirilebilir.</p>
        </div>
        <div class="feature-box">
            <h3>Görüntüleme Donanımı</h3>
            <p>Kamera donanımına doğrudan ulaşamaz. Görüntü işleme ve konum tabanlı servisler native taraf aracılığıyla yönetilir. Bu, MethodChannel'ın sunduğu imkanların kapsamını gösterir.</p>
        </div>
    </div>
    
    <h3 style="margin-top: 40px; color: var(--primary-dark-blue);">MethodChannel'ın Kritik Rolü</h3>
    <p>Bu gibi platforma özgü kaynaklara erişebilmek için Flutter, **Platform Channels** adı verilen bir köprü mekanizması sağlar. Bu mekanizmanın en temel bileşeni **MethodChannel**’dır. Proje, bu köprü mekanizmasının analizini ve uygulamasını derinleştirmektedir.</p>
</section>

<section id="temel-kavramlar" class="content-section">
    <h2>Kuramsal Arka Plan ve Temel Bileşenler</h2>
    <p>Flutter uygulamaları, doğrudan işletim sistemi üzerinde çalışmaz; kendi rendering motoru ile UI çizer ve Dart kodunu kendi sanal makinesi üzerinde çalıştırır.</p>
    
    <div class="feature-grid">
        <div class="feature-box" style="background-color: #f4f7f6; border: 1px dashed #ccc;">
            <h3>Binary Messenger</h3>
            <p>Flutter Engine ile Native Platform arasında iletişimi, ham byte'lar üzerinden yapan temel mesajlaşma protokolüdür. Yüksek performanslı ve asenkron veri transferini sağlar.</p>
        </div>
        <div class="feature-box" style="background-color: #f4f7f6; border: 1px dashed #ccc;">
            <h3>Codec & Serileştirme</h3>
            <p>StandardMessageCodec, Dart objeleri ile Native objeleri arasındaki çeviriyi (marshaling) yönetir. Desteklenen tipler: int, double, String, Map ve List.</p>
        </div>
        <div class="feature-box" style="background-color: #f4f7f6; border: 1px dashed #ccc;">
            <h3>Thread Yönetimi</h3>
            <p>Native tarafta asenkron işlemler yürütülerek Main Thread (Ana İş Parçacığı) bloklanması engellenir. Bu, yüksek performans (60–120 FPS) korur.</p>
        </div>
    </div>
</section>

<?php 
require_once 'footer.php';
?>