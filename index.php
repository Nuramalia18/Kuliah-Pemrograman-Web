<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_note'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    if (!empty($title)) {
        $stmt = $pdo->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $content]);
        header("Location: index.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    $note_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
    $stmt->execute([$note_id, $_SESSION['user_id']]);
    header("Location: index.php");
    exit();
}

$search = $_GET['search'] ?? '';
if (!empty($search)) {
    $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? AND (title LIKE ? OR content LIKE ?) ORDER BY created_at DESC");
    $search_term = "%$search%";
    $stmt->execute([$_SESSION['user_id'], $search_term, $search_term]);
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyDiary - Catatan Harian</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    .search-icon-btn {
        background: var(--dark-card);
        border: 2px solid var(--dark-border);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        font-size: 1.1rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow);
        color: var(--text-light);
    }

    .light-mode .search-icon-btn {
        background: var(--light-card);
        border: 2px solid var(--light-border);
        color: var(--text-dark);
        box-shadow: var(--shadow-light);
    }

    .search-icon-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
    }

    .welcome-message {
        font-size: 1rem;
        color: var(--text-light);
        font-weight: 500;
    }

    .light-mode .welcome-message {
        color: var(--text-dark);
    }

    .notes-count {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: var(--shadow);
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

    .search-container {
        background: rgba(26, 26, 46, 0.95);
        backdrop-filter: blur(20px);
        padding: 1.5rem;
        margin: 1rem 0;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        display: none;
        gap: 1rem;
        align-items: center;
        border: 2px solid var(--dark-border);
        transition: var(--transition);
    }

    .light-mode .search-container {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .search-container.active {
        display: flex;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .search-box {
        flex: 1;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid var(--dark-border);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: var(--transition);
        background: var(--dark-card);
        color: var(--text-light);
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .light-mode .search-input {
        background: var(--light-card);
        color: var(--text-dark);
        border: 2px solid var(--light-border);
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2), inset 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .light-mode .search-input:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1), inset 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .search-input::placeholder {
        color: var(--text-muted);
    }

    .search-icon-inside {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .search-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: var(--radius);
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    .clear-search {
        background: var(--dark-border);
        color: var(--text-light);
        border: none;
        padding: 1rem 2rem;
        border-radius: var(--radius);
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .light-mode .clear-search {
        background: var(--light-border);
        color: var(--text-dark);
    }

    .clear-search:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Main Content */
    .main-content {
        padding: 2rem 0;
        min-height: calc(100vh - 200px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(26, 26, 46, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 2px solid var(--dark-border);
        transition: var(--transition);
    }

    .light-mode .empty-state {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .empty-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        opacity: 0.8;
    }

    .empty-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-light);
    }

    .light-mode .empty-title {
        color: var(--text-dark);
    }

    .empty-subtitle {
        font-size: 1.1rem;
        margin-bottom: 3rem;
        color: var(--text-muted);
    }

    .search-not-found {
        text-align: center;
        padding: 3rem 2rem;
        background: rgba(26, 26, 46, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 2px solid var(--dark-border);
        margin-bottom: 2rem;
        transition: var(--transition);
    }

    .light-mode .search-not-found {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .search-not-found-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: var(--text-muted);
    }

    .search-not-found-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-light);
    }

    .light-mode .search-not-found-title {
        color: var(--text-dark);
    }

    .search-not-found-text {
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .add-button-large {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        font-size: 2.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .add-button-large::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .add-button-large:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: var(--shadow-hover);
    }

    .add-button-large:hover::before {
        left: 100%;
    }

    .note-form {
        background: var(--dark-card);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow);
        margin-bottom: 2.5rem;
        display: none;
        border: 2px solid var(--dark-border);
        transition: var(--transition);
    }

    .light-mode .note-form {
        background: var(--light-card);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .note-form.active {
        display: block;
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .note-form h2 {
        margin-bottom: 1.5rem;
        color: var(--text-light);
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .light-mode .note-form h2 {
        color: var(--text-dark);
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-light);
        font-weight: 600;
    }

    .light-mode .form-label {
        color: var(--text-dark);
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 0.85rem;
        border: 2px solid var(--dark-border);
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s;
        background: var(--dark-surface);
        color: var(--text-light);
    }

    .light-mode .form-input, 
    .light-mode .form-textarea {
        background: var(--light-surface);
        color: var(--text-dark);
        border: 2px solid var(--light-border);
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .form-input::placeholder, .form-textarea::placeholder {
        color: var(--text-muted);
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
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
        box-shadow: var(--shadow-hover);
    }

    .btn-cancel {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
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
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        background: rgba(26, 26, 46, 0.95);
        backdrop-filter: blur(20px);
        padding: 1.5rem 2rem;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 2px solid var(--dark-border);
        transition: var(--transition);
    }

    .light-mode .content-header {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .content-title {
        color: var(--text-light);
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .add-button-small {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 1.8rem;
        cursor: button;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .add-button-small::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .add-button-small:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: var(--shadow-hover);
    }

    .add-button-small:hover::before {
        left: 100%;
    }

    /* Notes Grid */
    .notes-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .note-card {
        background: rgba(26, 26, 46, 0.95);
        backdrop-filter: blur(20px);
        padding: 1.5rem 2rem;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        position: relative;
        transition: var(--transition);
        border: 2px solid var(--dark-border);
        height: auto;
        min-height: auto;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 2rem;
        overflow: hidden;
    }

    .light-mode .note-card {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .note-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }

    .note-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary-color);
    }

    .light-mode .note-card:hover {
        box-shadow: var(--shadow-light-hover);
    }

    .note-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-light);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .light-mode .note-title {
        color: var(--text-dark);
    }

    .note-content {
        color: var(--text-muted);
        line-height: 1.6;
        font-size: 1rem;
        flex-grow: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin: 0;
    }

    .note-date {
        color: var(--text-muted);
        font-size: 0.9rem;
        min-width: 180px;
        text-align: right;
    }

    .date-created {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .date-updated {
        color: var(--primary-color);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-buttons {
        position: static;
        opacity: 1;
        display: flex;
        gap: 0.5rem;
    }

    .note-card:hover .action-buttons {
        opacity: 1;
    }

    .delete-btn {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        border: none;
        padding: 0.6rem 1rem;
        border-radius: 20px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }

    .delete-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
        background: linear-gradient(135deg, #ff5252, #e53935);
    }

    .note-link {
        text-decoration: none;
        color: inherit;
        display: block;
        flex-grow: 1;
    }

    .note-link:hover .note-title {
        color: var(--primary-color);
    }

    .note-link:hover .note-content {
        color: var(--text-light);
    }

    .light-mode .note-link:hover .note-content {
        color: var(--text-dark);
    }

    .search-info {
        background: rgba(26, 26, 46, 0.95);
        backdrop-filter: blur(20px);
        padding: 1.5rem;
        border-radius: var(--radius);
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
        border: 2px solid var(--dark-border);
        transition: var(--transition);
    }

    .light-mode .search-info {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid var(--light-border);
        box-shadow: var(--shadow-light);
    }

    .highlight {
        background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
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

        .notes-grid {
            grid-template-columns: 1fr;
        }

        .content-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .form-buttons {
            flex-direction: column;
        }

        .search-container {
            flex-direction: column;
        }

        .empty-title {
            font-size: 1.6rem;
        }

        .empty-icon {
            font-size: 4rem;
        }
    }

    @media (max-width: 480px) {
        .main-content {
            padding: 1rem 0;
        }

        .note-form {
            padding: 1.5rem;
        }

        .note-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .note-title {
            min-width: auto;
            max-width: none;
            white-space: normal;
        }
        
        .note-content {
            white-space: normal;
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .note-date {
            min-width: auto;
            text-align: left;
        }
        
        .note-link {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
            width: 100%;
        }
        
        .action-buttons {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
    }
</style>
</head>
<body>
    <div class="header">
        <h1 class="app-title">📚 MyDiary</h1>
        <div class="header-actions">
            <?php if (!empty($notes)): ?>
                <span class="notes-count"><?php echo count($notes); ?> Catatan</span>
            <?php endif; ?>
            <button class="theme-toggle" onclick="toggleTheme()">🌙</button>
            <button class="search-icon-btn" onclick="toggleSearch()">🔍</button>
            <span class="welcome-message">Halo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</span>
            <a href="logout.php" class="logout-btn">Keluar</a>
        </div>
    </div>

    <div class="search-container" id="searchContainer">
        <form method="GET" action="" id="searchForm" class="search-box">
            <span class="search-icon-inside">🔍</span>
            <input type="text" 
                   class="search-input" 
                   name="search" 
                   id="searchInput"
                   placeholder="Cari catatan berdasarkan judul atau isi..."
                   value="<?php echo htmlspecialchars($search); ?>">
        </form>
        <button type="submit" form="searchForm" class="search-btn">Cari</button>
        <?php if (!empty($search)): ?>
            <a href="index.php" class="clear-search">Hapus Pencarian</a>
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="main-content">
            <?php if (empty($notes)): ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">📝</div>
                    <h2 class="empty-title">Tidak ada catatan</h2>
                    <p class="empty-subtitle">Mulai menulis catatan pertama Anda</p>
                    
                    <!-- Large Add Button -->
                    <button class="add-button-large" onclick="showNoteForm()">+</button>
                </div>

                <!-- Updated Form for Adding Note - Matches edit.php style -->
                <div class="note-form" id="noteForm">
                    <h2>✏️ Catatan Baru</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="title" class="form-label">Judul Catatan:</label>
                            <input type="text" id="title" name="title" class="form-input"
                                   placeholder="Judul catatan Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="content" class="form-label">Isi Catatan:</label>
                            <textarea id="content" name="content" class="form-textarea"
                                      placeholder="Isi catatan Anda..."></textarea>
                        </div>
                        <div class="form-buttons">
                            <button type="submit" name="add_note" class="btn-save">Save</button>
                            <button type="button" class="btn-cancel" onclick="hideNoteForm()">Cancel</button>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <div>
                    <div class="content-header">
                        <h2 class="content-title">
                            <?php if (!empty($search)): ?>
                                📚 Hasil Pencarian
                            <?php else: ?>
                                📚 MyDiary
                            <?php endif; ?>
                        </h2>
                        <button class="add-button-small" onclick="showNoteForm()">+</button>
                    </div>

                    <!-- Search Info -->
                    <?php if (!empty($search)): ?>
                        <div class="search-info">
                            <span class="highlight">"<?php echo htmlspecialchars($search); ?>"</span>
                            (<?php echo count($notes); ?> catatan ditemukan)
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($search) && empty($notes)): ?>
                        <div class="search-not-found">
                            <div class="search-not-found-icon">🔍</div>
                            <h3 class="search-not-found-title">Pencarian tidak ditemukan</h3>
                            <p class="search-not-found-text">
                                Tidak ada catatan yang cocok dengan "<strong><?php echo htmlspecialchars($search); ?></strong>"
                            </p>
                            <a href="index.php" class="clear-search">Tampilkan Semua Catatan</a>
                        </div>
                    <?php endif; ?>

                    <div class="note-form" id="noteForm">
                        <h2>✏️ Catatan Baru</h2>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="title" class="form-label">Judul Catatan:</label>
                                <input type="text" id="title" name="title" class="form-input"
                                       placeholder="Judul catatan Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="content" class="form-label">Isi Catatan:</label>
                                <textarea id="content" name="content" class="form-textarea"
                                          placeholder="Isi catatan Anda..."></textarea>
                            </div>
                            <div class="form-buttons">
                                <button type="submit" name="add_note" class="btn-save">Save</button>
                                <button type="button" class="btn-cancel" onclick="hideNoteForm()">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <!-- Notes Grid -->
                    <div class="notes-grid">
                        <?php foreach ($notes as $note): ?>
                            <div class="note-card">
                                <div class="action-buttons">
                                    <button class="delete-btn" 
                                            onclick="confirmDelete('<?php echo $note['id']; ?>', '<?php echo htmlspecialchars($note['title']); ?>')">
                                        🗑️ Hapus
                                    </button>
                                </div>
                                
                                <a href="detail.php?id=<?php echo $note['id']; ?>" class="note-link">
                                    <div class="note-title"><?php echo htmlspecialchars($note['title']); ?></div>
                                    <div class="note-content">
                                        <?php 
                                        $content = htmlspecialchars($note['content']);
                                        if (strlen($content) > 150) {
                                            echo substr($content, 0, 150) . '...';
                                        } else {
                                            echo $content;
                                        }
                                        ?>
                                    </div>
                                </a>
                                
                                <div class="note-date">
                                    <?php if ($note['updated_at'] != $note['created_at']): ?>
                                        <div class="date-updated">
                                            ✏️ Diupdate: <?php echo date('d M Y H:i', strtotime($note['updated_at'])); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="date-created">
                                            📅 Dibuat: <?php echo date('d M Y H:i', strtotime($note['created_at'])); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const body = document.body;
            const themeToggle = document.querySelector('.theme-toggle');
            
            body.classList.toggle('light-mode');
            
            if (body.classList.contains('light-mode')) {
                themeToggle.innerHTML = '☀️';
                localStorage.setItem('theme', 'light');
            } else {
                themeToggle.innerHTML = '🌙';
                localStorage.setItem('theme', 'dark');
            }
        }

        function loadTheme() {
            const savedTheme = localStorage.getItem('theme');
            const themeToggle = document.querySelector('.theme-toggle');
            
            if (savedTheme === 'light') {
                document.body.classList.add('light-mode');
                themeToggle.innerHTML = '☀️';
            } else {
                document.body.classList.remove('light-mode');
                themeToggle.innerHTML = '🌙';
            }
        }

        function showNoteForm() {
            document.getElementById('noteForm').classList.add('active');
            document.getElementById('title').focus();
        }

        function hideNoteForm() {
            document.getElementById('noteForm').classList.remove('active');
        }

        function toggleSearch() {
            const searchContainer = document.getElementById('searchContainer');
            const searchInput = document.getElementById('searchInput');
            
            searchContainer.classList.toggle('active');
            
            if (searchContainer.classList.contains('active')) {
                setTimeout(() => {
                    searchInput.focus();
                }, 100);
            }
        }

        function confirmDelete(noteId, noteTitle) {
            const isLightMode = document.body.classList.contains('light-mode');
            
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                html: `Catatan "<strong>${noteTitle}</strong>" akan dihapus permanen`,
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
                    window.location.href = 'index.php?delete=' + noteId;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadTheme(); 
            
            const searchInput = document.getElementById('searchInput');
            if (searchInput && searchInput.value !== '') {
                document.getElementById('searchContainer').classList.add('active');
            }
    y
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        document.getElementById('searchForm').submit();
                    }
                });
            }
        });

        function highlightSearchTerms() {
            const searchTerm = '<?php echo htmlspecialchars($search); ?>';
            if (!searchTerm) return;
            
            const noteTitles = document.querySelectorAll('.note-title');
            const noteContents = document.querySelectorAll('.note-content');
            
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            
            noteTitles.forEach(title => {
                title.innerHTML = title.textContent.replace(regex, '<span class="highlight">$1</span>');
            });
            
            noteContents.forEach(content => {
                content.innerHTML = content.textContent.replace(regex, '<span class="highlight">$1</span>');
            });
        }
        document.addEventListener('DOMContentLoaded', highlightSearchTerms);

        document.addEventListener('click', function(event) {
            const searchContainer = document.getElementById('searchContainer');
            const searchIcon = document.querySelector('.search-icon-btn');
            
            if (searchContainer.classList.contains('active') && 
                !searchContainer.contains(event.target) && 
                !searchIcon.contains(event.target)) {
                searchContainer.classList.remove('active');
            }
        });
    </script>
</body>
</html>