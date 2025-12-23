<?php
// DOSYA YOLU: /proje_klasörü/register.php
session_start();
require_once 'db_config.php'; // Veritabanı bağlantısını dahil et

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($username) || empty($password) || empty($password_confirm)) {
        $error = 'Lütfen tüm alanları doldurun.';
    } elseif ($password !== $password_confirm) {
        $error = 'Şifreler eşleşmiyor.';
    } elseif (strlen($password) < 4) {
        $error = 'Şifre en az 4 karakter olmalıdır.';
    } else {
        try {
            // Kullanıcı adının zaten var olup olmadığını kontrol et
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() > 0) {
                $error = 'Bu kullanıcı adı zaten alınmış.';
            } else {
                // Şifreyi güvenli bir şekilde hashle
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Yeni kullanıcıyı veritabanına ekle
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->execute([$username, $hashed_password]);

                $success = 'Kayıt başarılı! Şimdi giriş yapabilirsiniz.';
                // Kullanıcıyı direkt olarak login sayfasına yönlendir
                header('Location: login.php?success=registered');
                exit;
            }
        } catch (\PDOException $e) {
            $error = 'Bir veritabanı hatası oluştu. Lütfen tekrar deneyin.';
            // Hata loglama (isteğe bağlı)
            // error_log($e->getMessage()); 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol | Flutter Proje Raporu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* login.php dosyasındaki stillerin aynısı kullanılacak */
        :root {
            --dark-blue: #0A192F; 
            --accent-blue: #0d47a1; 
            --light-text: #E5E9F0;
            --card-bg: #1A2E44;
            --error-red: #EF4444;
            --success-green: #10B981; /* Yeni eklendi */
        }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--dark-blue); 
            margin: 0;
            color: var(--light-text);
        }
        .login-container {
            background: var(--card-bg);
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 380px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .login-container h2 {
            color: var(--accent-blue);
            margin-bottom: 30px;
            font-weight: 600;
        }
        .login-container input {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid var(--dark-blue);
            border-radius: 8px;
            box-sizing: border-box;
            background-color: var(--dark-blue);
            color: var(--light-text);
            transition: border-color 0.3s;
        }
        .login-container input:focus {
            border-color: var(--accent-blue);
            outline: none;
        }
        .login-container button {
            width: 100%;
            padding: 14px;
            background-color: var(--accent-blue);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 17px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            margin-bottom: 15px; /* Yeni buton için boşluk */
        }
        .login-container button:hover {
            background-color: #0c4096;
            transform: translateY(-2px);
        }
        #error-message {
            color: var(--error-red);
            margin-top: 15px;
            font-size: 14px;
        }
        #success-message {
            color: var(--success-green);
            margin-top: 15px;
            font-size: 14px;
        }
        .link-text {
            color: #8892B0;
            font-size: 0.9em;
        }
        .link-text a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
        }
        .link-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>YENİ KULLANICI KAYIT</h2>
        <p style="margin-bottom: 30px; color: #8892B0;">Proje Raporuna Erişim İçin Hesap Oluşturun</p>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required value="<?php echo htmlspecialchars($username ?? ''); ?>">
            <input type="password" name="password" placeholder="Şifre (Min 4 karakter)" required>
            <input type="password" name="password_confirm" placeholder="Şifre Tekrar" required>
            <button type="submit">Kayıt Ol</button>
            <?php if ($error): ?>
                <p id="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        <p class="link-text">
            Zaten hesabınız var mı? <a href="login.php">Giriş Yap</a>
        </p>
    </div>
</body>
</html>