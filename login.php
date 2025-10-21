<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $errors = [];

    if (empty($username) || empty($password)) {
        $errors[] = "Username dan password harus diisi!";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Username atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyDiary</title>  
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 420px;
        }
        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 600;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.85rem;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .show-password-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 0.5rem;
            cursor: pointer;
        }
        .show-password-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        .show-password-label {
            color: #555;
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }
        .show-password-container:hover .show-password-label {
            color: #667eea;
        }
        button[type="submit"] {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 0.5rem;
        }
        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 0.85rem;
            border-radius: 8px;
            margin-bottom: 1.2rem;
            border: 1px solid #f5c6cb;
            font-size: 0.9rem;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 0.85rem;
            border-radius: 8px;
            margin-bottom: 1.2rem;
            border: 1px solid #c3e6cb;
            font-size: 0.9rem;
        }
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.95rem;
        }
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .app-title {
            text-align: center;
            color: #666;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="app-title">MyDiary</div>
        <h1>Masuk ke MyDiary</h1>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                       placeholder="Masukkan username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" 
                       placeholder="Masukkan password" required>
                
                <div class="show-password-container" onclick="togglePassword()">
                    <input type="checkbox" id="showPassword" class="show-password-checkbox">
                    <label for="showPassword" class="show-password-label">Tampilkan Password</label>
                </div>
            </div>
            
            <button type="submit">Masuk</button>
        </form>
        
        <div class="register-link">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');
            const showPasswordLabel = document.querySelector('.show-password-label');
            
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
                showPasswordLabel.textContent = 'Sembunyikan Password';
            } else {
                passwordInput.type = 'password';
                showPasswordLabel.textContent = 'Tampilkan Password';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const showPasswordContainer = document.querySelector('.show-password-container');
            const showPasswordCheckbox = document.getElementById('showPassword');
            
            showPasswordContainer.addEventListener('click', function(e) {
                if (e.target !== showPasswordCheckbox) {
                    showPasswordCheckbox.checked = !showPasswordCheckbox.checked;
                }
                togglePassword();
            });
        });
    </script>
</body>
</html> 