<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$note_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
$stmt->execute([$note_id, $_SESSION['user_id']]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) {
    $_SESSION['error'] = "Catatan tidak ditemukan!";
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    $errors = [];

    if (empty($title)) {
        $errors[] = "Judul catatan harus diisi!";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        if ($stmt->execute([$title, $content, $note_id, $_SESSION['user_id']])) {
            $_SESSION['success'] = "Catatan berhasil diupdate!";
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Terjadi kesalahan saat mengupdate catatan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan - MyDiary</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #667eea;
            --primary-dark: #5a6fd8;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.15);
            --radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 1.2rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .app-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .back-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .welcome-message {
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            background: linear-gradient(135deg, #ff5252, #e53935);
        }

        /* Main Content */
        .main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        /* Content Header */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 1.5rem 2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .content-title {
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Note Form */
        .note-form {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 2.5rem;
        }

        .note-form h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 600;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.85rem;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s;
            background: var(--bg-white);
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            height: 300px;
            resize: vertical;
            line-height: 1.5;
        }

        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-save {
            background: linear-gradient(135deg, #764ba2, #f093fb 100%);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-cancel {
            background: red;
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: red;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                padding: 1rem;
            }

            .header-actions {
                flex-wrap: wrap;
                justify-content: center;
            }

            .content-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .form-buttons {
                flex-direction: column;
            }

            .note-form {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="app-title">MyDiary</h1>
        <div class="header-actions">
            <span class="welcome-message">Halo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</span>
            <a href="index.php" class="back-btn">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                Kembali
            </a>
            <a href="logout.php" class="logout-btn">Keluar</a>
        </div>
    </div>

    <div class="container">
        <div class="main-content">
            <div class="content-header">
                <h2 class="content-title">✏️ Edit Catatan</h2>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
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

            <div class="note-form">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="title" class="form-label">Judul Catatan:</label>
                        <input type="text" id="title" name="title" class="form-input"
                               value="<?php echo htmlspecialchars($note['title']); ?>" 
                               placeholder="Judul catatan Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="content" class="form-label">Isi Catatan:</label>
                        <textarea id="content" name="content" class="form-textarea"
                                  placeholder="Isi catatan Anda..."><?php echo htmlspecialchars($note['content']); ?></textarea>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" class="btn-save">Save</button>
                        <a href="index.php" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>