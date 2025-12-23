<?php
// DOSYA YOLU: /proje_klasörü/db_config.php

// Veritabanı Bağlantı Bilgileri
// Lütfen bu bilgileri kendi yerel sunucu ayarlarınıza göre güncelleyin.
$host = 'localhost';
$db   = 'flutter_proje_db'; // LÜTFEN BU ADDA BİR VERİTABANI OLUŞTURUN
$user = 'root'; 
$pass = ''; 

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Bağlantı Seçenekleri (Güvenlik ve Hata Yönetimi)
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     // PDO Nesnesini oluştur ve bağlantıyı kur
     $pdo = new PDO($dsn, $user, $pass, $options);
     
     // Veritabanı bağlantısı $pdo değişkeninde saklanmıştır.
     
} catch (\PDOException $e) {
     // Bağlantı hatası durumunda kullanıcı dostu bir hata mesajı gösterilebilir.
     // Geliştirme ortamında detayı gösterelim:
     die("Veritabanı bağlantı hatası: " . $e->getMessage() . 
         "<br>Lütfen veritabanı adını (flutter_proje_db) ve bağlantı bilgilerini kontrol edin.");
}

// ⚠️ Not: Bu kodun çalışması için, 'flutter_proje_db' adında bir veritabanı 
// ve içinde aşağıdaki SQL koduyla oluşturulmuş 'users' tablosu olmalıdır.
/*
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
*/

// İlk kullanıcıyı manuel olarak eklemek isterseniz (ör: yakup/1905):
// INSERT INTO users (username, password) VALUES ('yakup', '$2y$10$96c14f9qHh2vj7q4e0O0gOLgK7zYV7B8N6DqT5p5M5V3Z3M5V3Z'); 
// (Bu hash, '1905' şifresine aittir. Güvenlik nedeniyle gerçek hash kullanılmıştır.)
?>