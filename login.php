<?php
// DOSYA YOLU: /proje_klasörü/login.php - GÜNCELLENMİŞ VERİTABANI KODU
session_start();
require_once 'db_config.php'; // Veritabanı bağlantısını dahil et

$error = '';
$success_message = '';

// Eğer kullanıcı zaten giriş yapmışsa direkt ana sayfaya yönlendir
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

// Kayıt başarılı mesajını yakala
if (isset($_GET['success']) && $_GET['success'] == 'registered') {
    $success_message = 'Kayıt başarılı! Lütfen giriş yapın.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_username = $_POST['username'] ?? '';
    $input_password = $_POST['password'] ?? '';

    if (empty($input_username) || empty($input_password)) {
        $error = 'Lütfen kullanıcı adı ve şifreyi girin.';
    } else {
        try {
            // Kullanıcıyı veritabanından çek
            $stmt = $pdo->prepare("SELECT username, password FROM users WHERE username = ?");
            $stmt->execute([$input_username]);
            $user = $stmt->fetch();

            if ($user && password_verify($input_password, $user['password'])) {
                // Giriş başarılı: Oturumu ayarla
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                
                // Ana sayfa index.php'ye yönlendir
                header('Location: index.php');
                exit;
            } else {
                // Giriş başarısız
                $error = 'Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyin.';
            }
        } catch (\PDOException $e) {
            $error = 'Giriş yapılırken bir hata oluştu. Lütfen tekrar deneyin.';
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
    <title>Giriş | Flutter Proje Raporu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* login.php dosyasındaki stillerin aynısı kullanılacak */
        :root {
            --dark-blue: #0A192F; 
            --accent-blue: #0d47a1; 
            --light-text: #E5E9F0;
            --card-bg: #1A2E44;
            --error-red: #EF4444;
            --success-green: #10B981; 
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
            margin-bottom: 15px;
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
        <h2>FLUTTER INTEGRATION</h2>
        <p style="margin-bottom: 30px; color: #8892B0;">Proje Raporu Erişim Paneli</p>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
            
            <?php if ($success_message): ?>
                <p id="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <p id="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        <p class="link-text">
            Hesabınız yok mu? <a href="register.php">Kayıt Ol</a>
        </p>
    </div>
</body>
</html>