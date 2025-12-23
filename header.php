<?php 
// DOSYA YOLU: /proje_klasörü/header.php
// LÜTFEN SADECE <style> BLOKUNU BU KODLA DEĞİŞTİRİN
$username = $_SESSION['username'] ?? 'Kullanıcı';
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLUTTER INTEGRATION - Native Entegrasyon</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* *** YENİ: SAKİN VE PROFESYONEL RENK PALETİ *** */
        :root {
            --bg-main: #f0f3f6; /* Çok Açık Gri */
            --bg-dark-header: #29335C; /* Kurumsal Koyu Mavi */
            --primary-accent: #00A896; /* Sakin Turkuaz Vurgu */
            --text-dark: #222222;
            --text-light: #F5F5F5;
            --logout-red: #D9534F; /* Daha Mat Kırmızı */
            --card-bg: white;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }
        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 0; padding: 0; 
            background-color: var(--bg-main); 
            color: var(--text-dark); 
        }
        
        /* Navigasyon Stilleri */
        .navbar { 
            background-color: var(--bg-dark-header); 
            padding: 10px 0; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
        }
        .nav-links { 
            display: flex; 
            justify-content: center; 
            list-style: none; padding: 0; margin: 0; 
        }
        .nav-links li { margin: 0 10px; }
        .nav-links a { 
            color: var(--text-light); 
            text-decoration: none; 
            padding: 10px 15px; display: block; 
            font-weight: 600; font-size: 0.9em;
            transition: color 0.3s;
        }
        .nav-links a:hover { color: var(--primary-accent); }
        .logout-link { 
            color: white !important;
            background-color: var(--logout-red); 
            border-radius: 4px; 
            padding: 8px 15px !important; 
            font-weight: 700 !important;
        }
        .logout-link:hover { background-color: #c9302c; color: white !important; }
        .nav-links .active a { color: var(--primary-accent); } 

        /* Header / Hero Section */
        .header-section { 
            background-color: var(--bg-dark-header); 
            color: var(--text-light); 
            padding: 100px 20px; 
            text-align: center; 
            margin-bottom: 20px;
        }
        .header-section h1 { font-size: 2.5em; margin-bottom: 20px; }
        .header-section a {
            background-color: var(--primary-accent); /* Turkuaz Buton */
            color: white !important;
            box-shadow: 0 4px 10px rgba(0, 168, 150, 0.5);
            transition: background-color 0.3s;
        }
        .header-section a:hover {
            background-color: #008f7d;
        }
        
        /* İçerik ve Kutular */
        .content-section { 
            max-width: 1100px; 
            margin: 40px auto; padding: 30px; 
            background: var(--card-bg); 
            border-radius: 8px; 
            box-shadow: 0 4px 12px var(--shadow-color); 
        }
        .content-section h2 { 
            color: var(--bg-dark-header); 
            border-bottom: 2px solid #e0e0e0; 
            padding-bottom: 15px; 
            margin-top: 30px; 
        }
        .feature-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 30px; 
            margin-top: 30px; 
        }
        
        /* Kutu Etkileşimi */
        .feature-box { 
            background: #fff; 
            padding: 30px; 
            border-radius: 12px; 
            border: 1px solid #eee;
            box-shadow: 0 6px 15px var(--shadow-color);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; 
            cursor: default;
        }
        .feature-box:hover {
            transform: scale(1.03); 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-accent);
        }

        .feature-box h3 { 
            color: var(--bg-dark-header); 
            margin-top: 0; 
            font-size: 1.4em;
            border-bottom: 2px solid var(--primary-accent);
            padding-bottom: 5px;
        }
        .code-block { background-color: #272727; color: #f8f8f2; padding: 15px; border-radius: 5px; overflow-x: auto; margin: 20px 0; }
        
        /* RESPONSIVE AYARLAR (Aynı Kalır) */
        @media (max-width: 768px) {
            .nav-links { flex-direction: column; align-items: center; }
            .nav-links li { margin: 5px 0; }
            .header-section h1 { font-size: 1.8em; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><a href="index.php">GİRİŞ</a></li>
            <li class="<?php echo ($current_page == 'derin_mimari.php') ? 'active' : ''; ?>"><a href="derin_mimari.php">DERİN MİMARİ</a></li>
            <li class="<?php echo ($current_page == 'kod_analizi.php') ? 'active' : ''; ?>"><a href="kod_analizi.php">KOD ANALİZİ</a></li>
            <li class="<?php echo ($current_page == 'canli_demo.php') ? 'active' : ''; ?>"><a href="canli_demo.php">CANLI DEMO</a></li>
            <li class="<?php echo ($current_page == 'nasil_yapildi.php') ? 'active' : ''; ?>"><a href="nasil_yapildi.php">NASIL YAPILDI?</a></li>
            <li><a href="index.php?logout=true" class="logout-link">Çıkış Yap (<?php echo $username; ?>)</a></li>
        </ul>
    </nav>
    <main>