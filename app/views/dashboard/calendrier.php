<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Calendrier</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span style="font-size: 1.5rem;">🏫</span> EduGest Pro
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="/etudiants" class="nav-link">👥 Registre Étudiants</a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link">📄 Inscriptions</a></li>
                <li class="nav-item"><a href="/calendrier" class="nav-link active">📅 Calendrier</a></li>
                <br>
                <li class="nav-item"><a href="/parametres" class="nav-link">⚙️ Paramètres</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link" style="color: #ef4444;">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Calendrier Scolaire</h1>
                    <p>Visualisez les événements et congés à venir.</p>
                </div>
                <div class="profile-section">
                    <span style="font-weight: 500;">Admin</span>
                    <div class="avatar"></div>
                </div>
            </header>

            <div class="card" style="min-height: 400px; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                <h2 style="color: var(--text-muted); margin-bottom: 1rem;">Intégration d'un module Calendrier (à faire)</h2>
                <p>C'est ici que vous pourrez brancher une librairie comme FullCalendar.</p>
            </div>
        </main>
    </div>
</body>
</html>
