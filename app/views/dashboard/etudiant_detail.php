<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Détails Étudiant</title>
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
                <li class="nav-item"><a href="/etudiants" class="nav-link active">👥 Registre Étudiants</a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link">📄 Inscriptions</a></li>
                <li class="nav-item"><a href="/calendrier" class="nav-link">📅 Calendrier</a></li>
                <br>
                <li class="nav-item"><a href="/parametres" class="nav-link">⚙️ Paramètres</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link" style="color: #ef4444;">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Profil de l'étudiant</h1>
                    <p>Fiche détaillée et actions rapides.</p>
                </div>
                <div class="profile-section">
                    <span style="font-weight: 500;">Admin</span>
                    <div class="avatar"></div>
                </div>
            </header>

            <div class="card" style="display: grid; grid-template-columns: 150px 1fr; gap: 2rem; align-items: start;">
                <div style="background: #e2e8f0; width: 150px; height: 150px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 3rem; color: #94a3b8;">👤</span>
                </div>
                
                <div>
                    <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">Jean Dupont</h2>
                    <span class="badge badge-green" style="margin-bottom: 1rem; display: inline-block;">Inscrit Actif</span>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">Date de naissance</p>
                            <p style="font-weight: 500;">14 Mai 2010</p>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">Année Scolaire</p>
                            <p style="font-weight: 500;">2026-2027</p>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">Nom du Tuteur</p>
                            <p style="font-weight: 500;">Marie Dupont</p>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">Contact Tuteur</p>
                            <p style="font-weight: 500;">+33 6 12 34 56 78</p>
                        </div>
                        <div>
                            <p style="color: var(--text-muted); font-size: 0.875rem;">Email Contact</p>
                            <p style="font-weight: 500;">jean.dupont@example.com</p>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                        <button class="btn">Générer Fiche PDF</button>
                        <button class="btn" style="background: var(--bg-color); color: var(--text-color); border: 1px solid var(--border-color);">Modifier le profil</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
