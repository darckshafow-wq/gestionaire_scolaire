<?php
$admin_pseudo = $admin_pseudo ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Calendrier</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
            <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo" id="sidebar-logo-toggle">
            <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
            <span class="brand-font">EPI Gest</span>
        </div>

        <div class="sidebar-section-title">Main</div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/dashboard" class="nav-link" title="Vue d'ensemble"><i class="ph ph-house" style="font-size:1.25rem;"></i><span>Vue d'ensemble</span></a></li>
            <li class="nav-item"><a href="/etudiants" class="nav-link" title="Registre Étudiants"><i class="ph ph-users" style="font-size:1.25rem;"></i><span>Registre Étudiants</span></a></li>
            <li class="nav-item"><a href="/inscriptions" class="nav-link" title="Inscriptions"><i class="ph ph-file-text" style="font-size:1.25rem;"></i><span>Inscriptions</span></a></li>
            <li class="nav-item"><a href="/filieres" class="nav-link" title="Filières"><i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières</span></a></li>
            <li class="nav-item"><a href="/calendrier" class="nav-link active" title="Calendrier"><i class="ph ph-calendar-blank" style="font-size:1.25rem;"></i><span>Calendrier</span></a></li>
        </ul>

        <div class="sidebar-section-title">Système</div>
        <ul class="nav-menu" style="flex:0;">
            <li class="nav-item"><a href="/parametres" class="nav-link" title="Paramètres"><i class="ph ph-gear" style="font-size:1.25rem;"></i><span>Paramètres</span></a></li>
            <li class="nav-item"><a href="/logout" class="nav-link nav-link-danger" title="Déconnexion"><i class="ph ph-sign-out" style="font-size:1.25rem;"></i><span>Déconnexion</span></a></li>
        </ul>

        <div class="sidebar-profile">
            <div class="avatar" style="width:36px;height:36px;font-size:0.9rem;"><?= strtoupper(substr($admin_pseudo, 0, 1)) ?></div>
            <div class="profile-info">
                <span class="profile-name"><?= htmlspecialchars($admin_pseudo) ?></span>
                <span class="profile-role">Administrateur</span>
            </div>
        </div>
    </aside>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Calendrier Scolaire</h1>
                    <p>Visualisez les événements et congés à venir.</p>
                </div>
            </header>

            <div class="detail-card" style="min-height: 400px; display: flex; align-items: center; justify-content: center; flex-direction: column; text-align: center;">
                <div style="width: 80px; height: 80px; background: var(--primary-light); color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="ph-fill ph-calendar-check" style="font-size: 2.5rem;"></i>
                </div>
                <h2 style="font-family: 'Outfit'; color: var(--text-main); margin-bottom: 0.5rem;">Module Calendrier</h2>
                <p style="color: var(--text-muted); max-width: 400px;">C'est ici que vous pourrez brancher une librairie comme FullCalendar pour gérer vos événements.</p>
                <button class="btn-light" style="margin-top: 1.5rem;"><i class="ph ph-plus"></i> Ajouter un événement rapide</button>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
