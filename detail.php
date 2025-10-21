<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$note_id = $_GET['id'] ?? null;

if (!$note_id) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
$stmt->execute([$note_id, $_SESSION['user_id']]);
$note = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$note) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    if (!empty($title)) {
        $stmt = $pdo->prepare("UPDATE notes SET title = ?, content = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        $stmt->execute([$title, $content, $note_id, $_SESSION['user_id']]);
        
        // Ambil data terbaru
        $stmt = $pdo->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
        $stmt->execute([$note_id, $_SESSION['user_id']]);
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$created_date = date('l, d F Y', strtotime($note['created_at']));
$created_time = date('H:i', strtotime($note['created_at']));
$updated_date = date('l, d F Y', strtotime($note['updated_at']));
$updated_time = date('H:i', strtotime($note['updated_at']));
$char_count = strlen($note['content']);

$is_updated = $note['updated_at'] != $note['created_at'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($note['title']); ?> - MyDiary</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* CSS tetap sama seperti sebelumnya */
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
            --dark-bg: #0f0f23;
            --dark-surface: #1a1a2e;
            --dark-card: #16213e;
            --dark-border: #2d3748;
            --light-bg: #f8fafc;
            --light-surface: #ffffff;
            --light-card: #ffffff;
            --light-border: #e2e8f0;
            --text-light: #e2e8f0;
            --text-dark: #2d3748;
            --text-muted: #a0aec0;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.4);
            --shadow-light: 0 10px 25px rgba(0, 0, 0, 0.1);
            --shadow-light-hover: 0 15px 35px rgba(0, 0, 0, 0.15);
            --radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-surface) 100%);
            min-height: 100vh;
            color: var(--text-light);
            line-height: 1.6;
            transition: var(--transition);
        }

        body.light-mode {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--text-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(20px);
            padding: 1.2rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--dark-border);
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .light-mode .header {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid var(--light-border);
            box-shadow: var(--shadow-light);
        }

        .app-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: var(--dark-card);
            border: 2px solid var(--dark-border);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            color: var(--text-light);
        }

        .light-mode .theme-toggle {
            background: var(--light-card);
            border: 2px solid var(--light-border);
            color: var(--text-dark);
            box-shadow: var(--shadow-light);
        }

        .theme-toggle:hover {
            transform: translateY(-2px) rotate(180deg);
            box-shadow: var(--shadow-hover);
            background: var(--primary-color);
            color: white;
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
            color: var(--text-light);
            font-weight: 500;
        }

        .light-mode .welcome-message {
            color: var(--text-dark);
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

        .main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        .note-detail-card {
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 2px solid var(--dark-border);
            transition: var(--transition);
        }

        .light-mode .note-detail-card {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid var(--light-border);
            box-shadow: var(--shadow-light);
        }

        .note-header {
            padding: 2.5rem 2.5rem 1.5rem 2.5rem;
            border-bottom: 1px solid var(--dark-border);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            transition: var(--transition);
        }

        .light-mode .note-header {
            border-bottom: 1px solid var(--light-border);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        }

        .note-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-light);
            line-height: 1.3;
            word-wrap: break-word;
            overflow-wrap: break-word;
            border: 2px solid transparent;
            padding: 0.5rem;
            border-radius: 8px;
            transition: var(--transition);
            cursor: text;
            min-height: 60px;
            display: flex;
            align-items: center;
        }

        .light-mode .note-title {
            color: var(--text-dark);
        }

        .note-title.editing {
            border-color: var(--primary-color);
            background: var(--dark-surface);
        }

        .light-mode .note-title.editing {
            background: var(--light-surface);
        }

        .note-title-input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 2.2rem;
            font-weight: 700;
            color: inherit;
            font-family: inherit;
            resize: none;
            min-height: 60px;
            line-height: 1.3;
        }

        .note-content {
            padding: 2.5rem;
            min-height: 400px;
            transition: var(--transition);
        }

        .content-text {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.8;
            white-space: pre-line;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
            border: 2px solid transparent;
            padding: 1rem;
            border-radius: 8px;
            transition: var(--transition);
            cursor: text;
            min-height: 200px;
        }

        .light-mode .content-text {
            color: var(--text-dark);
        }

        .content-text.editing {
            border-color: var(--primary-color);
            background: var(--dark-surface);
            white-space: pre-wrap;
        }

        .light-mode .content-text.editing {
            background: var(--light-surface);
        }

        .content-textarea {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1.1rem;
            color: inherit;
            font-family: inherit;
            line-height: 1.8;
            resize: vertical;
            min-height: 400px;
        }

        .empty-content {
            color: var(--text-muted);
            font-style: italic;
            text-align: center;
            padding: 2rem;
        }

        .note-meta {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            font-size: 0.95rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .meta-row {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .char-count {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: auto;
        }

        .update-info {
            color: var(--primary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .last-updated {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-style: italic;
        }

        .edit-indicator {
            display: none;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .auto-save-status {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-style: italic;
        }

        .note-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem 2.5rem;
            background: rgba(40, 40, 40, 0.95);
            border-top: 1px solid var(--dark-border);
            transition: var(--transition);
        }

        .light-mode .note-actions {
            background: rgba(248, 249, 250, 0.95);
            border-top: 1px solid var(--light-border);
        }

        .action-left {
            display: flex;
            gap: 1rem;
        }

        .action-right {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.85rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            text-decoration: none;
            font-size: 0.95rem;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-save {
            background: linear-gradient(135deg,#764ba2, #f093fb 100%);
            color: white;
            display: none;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            display: none;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
            background: linear-gradient(135deg, #ff5252, #e53935);
        }

        .btn-share {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .btn-share:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

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

            .note-header {
                padding: 1.5rem 1.5rem 1rem 1.5rem;
            }

            .note-title {
                font-size: 1.8rem;
                min-height: 50px;
            }

            .note-title-input {
                font-size: 1.8rem;
                min-height: 50px;
            }

            .note-content {
                padding: 1.5rem;
                min-height: 300px;
            }

            .content-textarea {
                min-height: 300px;
            }

            .note-actions {
                padding: 1rem 1.5rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .action-left, .action-right {
                flex-wrap: wrap;
                justify-content: center;
            }

            .btn {
                flex: 1;
                min-width: 120px;
                justify-content: center;
            }

            .meta-row {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 1rem 0;
            }

            .note-title {
                font-size: 1.6rem;
            }

            .note-title-input {
                font-size: 1.6rem;
            }

            .content-text {
                font-size: 1rem;
            }

            .note-actions {
                flex-direction: column;
            }

            .action-left, .action-right {
                width: 100%;
                justify-content: center;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="app-title">MyDiary</h1>
        <div class="header-actions">
            <button class="theme-toggle" id="themeToggle">🌙</button>
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
            <form id="noteForm" method="POST" action="">
                <input type="hidden" name="title" id="titleInputHidden" value="<?php echo htmlspecialchars($note['title']); ?>">
                <div class="note-detail-card">
                    <div class="note-header">
                        <div class="note-title" id="titleDisplay" onclick="enableEdit('title')">
                            <?php echo htmlspecialchars($note['title']); ?>
                        </div>
                        <input type="text" name="title" id="titleInput" class="note-title-input" 
                               value="<?php echo htmlspecialchars($note['title']); ?>" 
                               style="display: none;"
                               oninput="handleTitleInput()">
                        <div class="note-meta">
                            <div class="meta-row">
                                <span class="date">📅 Dibuat: <?php echo $created_date; ?> pukul <?php echo $created_time; ?></span>
                            </div>
                            <?php if ($is_updated): ?>
                                <div class="meta-row">
                                    <span class="update-info">
                                        ✏️ Diupdate: <span id="updatedInfo"><?php echo $updated_date; ?> pukul <?php echo $updated_time; ?></span>
                                    </span>
                                    <span class="char-count"><span id="charCount"><?php echo $char_count; ?></span> karakter</span>
                                </div>
                            <?php else: ?>
                                <div class="meta-row">
                                    <span class="char-count"><span id="charCount"><?php echo $char_count; ?></span> karakter</span>
                                </div>
                            <?php endif; ?>
                            <div class="meta-row">
                                <span class="edit-indicator" id="editIndicator">
                                    <span class="editing-dot">●</span> Sedang mengedit...
                                </span>
                                <span class="auto-save-status" id="autoSaveStatus"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="note-content">
                        <div class="content-text" id="contentDisplay" onclick="enableEdit('content')">
                            <?php echo nl2br(htmlspecialchars($note['content'])); ?>
                        </div>
                        <textarea name="content" id="contentInput" class="content-textarea" 
                                  style="display: none;" 
                                  oninput="updateCharCount()"><?php echo htmlspecialchars($note['content']); ?></textarea>
                        
                        <?php if (empty($note['content'])): ?>
                            <div class="content-text empty-content" onclick="enableEdit('content')">
                                Klik untuk menambahkan konten...
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="note-actions">
                        <div class="action-left">
                            <button type="button" class="btn btn-edit" onclick="enableEdit('all')">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                Edit
                            </button>
                            
                            <button type="button" class="btn btn-save" id="saveBtn" onclick="saveChanges()">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                </svg>
                                Simpan
                            </button>
                            
                            <button type="button" class="btn btn-cancel" id="cancelBtn" onclick="cancelEdit()">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                                Batal
                            </button>
                        </div>
                        
                        <div class="action-right">
                            <button type="button" class="btn btn-share" onclick="shareNote()">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                                </svg>
                                Bagikan
                            </button>
                            
                            <button type="button" class="btn btn-delete" onclick="confirmDelete()">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    let isEditing = false;
    let originalTitle = '<?php echo addslashes($note['title']); ?>';
    let originalContent = '<?php echo addslashes($note['content']); ?>';
    let autoSaveTimer = null;
    const AUTO_SAVE_DELAY = 5000;
    let countdownInterval = null;
    let hasChanges = false;

    function enableEdit(field) {
        if (!isEditing) {
            isEditing = true;
            updateUI();
            showAutoSaveCountdown();
        }

        if (field === 'title' || field === 'all') {
            document.getElementById('titleDisplay').style.display = 'none';
            document.getElementById('titleInput').style.display = 'block';
            document.getElementById('titleInput').focus();
            document.getElementById('titleDisplay').classList.add('editing');
        }

        if (field === 'content' || field === 'all') {
            document.getElementById('contentDisplay').style.display = 'none';
            document.getElementById('contentInput').style.display = 'block';
            if (field === 'content' || field === 'all') {
                document.getElementById('contentInput').focus();
            }
            document.getElementById('contentDisplay').classList.add('editing');
        }

        hasChanges = false;
        setupAutoSave();
    }

    function cancelEdit() {
        isEditing = false;
        
        // Reset ke nilai asli
        document.getElementById('titleInput').value = originalTitle;
        document.getElementById('contentInput').value = originalContent;
        
        updateUI();
        hideEditFields();
        clearAutoSave();
        showAutoSaveStatus('Edit dibatalkan');
        
        setTimeout(() => {
            showAutoSaveStatus('');
        }, 2000);
    }

    function updateUI() {
        const editBtn = document.querySelector('.btn-edit');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const editIndicator = document.getElementById('editIndicator');

        if (isEditing) {
            editBtn.style.display = 'none';
            saveBtn.style.display = 'flex';
            cancelBtn.style.display = 'flex';
            editIndicator.style.display = 'flex';
        } else {
            editBtn.style.display = 'flex';
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            editIndicator.style.display = 'none';
        }
    }

    function hideEditFields() {
        document.getElementById('titleDisplay').style.display = 'flex';
        document.getElementById('titleInput').style.display = 'none';
        document.getElementById('contentDisplay').style.display = 'block';
        document.getElementById('contentInput').style.display = 'none';
        
        document.getElementById('titleDisplay').classList.remove('editing');
        document.getElementById('contentDisplay').classList.remove('editing');
        
        // Update display dengan nilai terbaru
        document.getElementById('titleDisplay').textContent = document.getElementById('titleInput').value;
        document.getElementById('contentDisplay').innerHTML = document.getElementById('contentInput').value.replace(/\n/g, '<br>');
    }

    function saveChanges() {
        if (!isEditing) return;

        const form = document.getElementById('noteForm');
        const formData = new FormData(form);
        
        showAutoSaveStatus('Menyimpan...');
        
        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                showAutoSaveStatus('Tersimpan!');
                updateTimestamp();
                
                // Update nilai original
                originalTitle = document.getElementById('titleInput').value;
                originalContent = document.getElementById('contentInput').value;
                
                hasChanges = false;
                
                // Keluar dari mode edit setelah berhasil disimpan
                setTimeout(() => {
                    isEditing = false;
                    updateUI();
                    hideEditFields();
                    clearAutoSave();
                    showAutoSaveStatus('');
                    // Refresh halaman untuk memastikan data terbaru
                    location.reload();
                }, 1000);
            } else {
                showAutoSaveStatus('Gagal menyimpan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAutoSaveStatus('Gagal menyimpan');
        });
    }

    function setupAutoSave() {
        clearAutoSave();
        
        autoSaveTimer = setTimeout(() => {
            if (isEditing && hasChanges) {
                saveChanges();
            } else if (isEditing) {
                setupAutoSave();
            }
        }, AUTO_SAVE_DELAY);
    }

    function clearAutoSave() {
        if (autoSaveTimer) {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = null;
        }
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }
    }

    function showAutoSaveCountdown() {
        const statusElement = document.getElementById('autoSaveStatus');
        let countdown = AUTO_SAVE_DELAY / 1000;
        
        countdownInterval = setInterval(() => {
            if (!isEditing) {
                clearInterval(countdownInterval);
                return;
            }
            
            countdown--;
            statusElement.textContent = `Auto-save dalam ${countdown} detik...`;
            statusElement.style.color = 'var(--primary-color)';
            
            if (countdown <= 0) {
                clearInterval(countdownInterval);
            }
        }, 1000);
    }

    function showAutoSaveStatus(message) {
        const statusElement = document.getElementById('autoSaveStatus');
        statusElement.textContent = message;
        
        if (message === 'Tersimpan!') {
            statusElement.style.color = '#10b981';
        } else if (message === 'Menyimpan...') {
            statusElement.style.color = 'var(--primary-color)';
        } else if (message === 'Gagal menyimpan') {
            statusElement.style.color = '#ef4444';
        } else {
            statusElement.style.color = 'var(--text-muted)';
        }
    }

    function handleTitleInput() {
        hasChanges = true;
        setupAutoSave();
    }

    function updateCharCount() {
        const content = document.getElementById('contentInput').value;
        const charCount = content.length;
        document.getElementById('charCount').textContent = charCount;
        
        hasChanges = true;
        setupAutoSave();
    }

    function updateTimestamp() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };
        const date = now.toLocaleDateString('id-ID', options);
        const time = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        document.getElementById('updatedInfo').textContent = `${date} pukul ${time}`;
    }

    function confirmDelete() {
        const isLightMode = document.body.classList.contains('light-mode');
        
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            html: `Catatan "<strong>${originalTitle}</strong>" akan dihapus permanen`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff6b6b',
            cancelButtonColor: '#667eea',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: isLightMode ? 'var(--light-card)' : 'var(--dark-card)',
            color: isLightMode ? 'var(--text-dark)' : 'var(--text-light)',
            backdrop: 'rgba(0, 0, 0, 0.7)'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?delete=<?php echo $note['id']; ?>';
            }
        });
    }
    
    function shareNote() {
        if (navigator.share) {
            navigator.share({
                title: originalTitle,
                text: originalContent.substring(0, 100) + '...',
                url: window.location.href
            })
            .then(() => console.log('Berhasil dibagikan'))
            .catch((error) => console.log('Error sharing:', error));
        } else {
            alert('Fitur bagikan tidak didukung di browser ini. Anda bisa menyalin URL secara manual.');
        }
    }

    // Theme functionality
    function toggleTheme() {
        const body = document.body;
        const themeToggle = document.getElementById('themeToggle');
        
        if (body.classList.contains('light-mode')) {
            body.classList.remove('light-mode');
            themeToggle.textContent = '🌙';
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.add('light-mode');
            themeToggle.textContent = '☀️';
            localStorage.setItem('theme', 'light');
        }
    }

    function loadTheme() {
        const savedTheme = localStorage.getItem('theme');
        const themeToggle = document.getElementById('themeToggle');
        
        if (savedTheme === 'light') {
            document.body.classList.add('light-mode');
            themeToggle.textContent = '☀️';
        } else {
            document.body.classList.remove('light-mode');
            themeToggle.textContent = '🌙';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadTheme();
        updateUI();
        updateCharCount();
        
        document.getElementById('themeToggle').addEventListener('click', toggleTheme);
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                saveChanges();
            }
            if (e.key === 'Escape') {
                cancelEdit();
            }
        });
    });
    </script>
</body>
</html>