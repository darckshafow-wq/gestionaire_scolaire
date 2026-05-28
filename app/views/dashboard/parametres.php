<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Paramètres</title>
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
                <li class="nav-item"><a href="/calendrier" class="nav-link">📅 Calendrier</a></li>
                <br>
                <li class="nav-item"><a href="/parametres" class="nav-link active">⚙️ Paramètres</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link" style="color: #ef4444;">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Paramètres Système</h1>
                    <p>Configuration générale de l'application.</p>
                </div>
                <div class="profile-section">
                    <span style="font-weight: 500;">Admin</span>
                    <div class="avatar"></div>
                </div>
            </header>

            <div class="card">
                <h3>Informations de l'établissement</h3>
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                    <div>
                        <label>Nom de l'école</label><br>
                        <input type="text" name="ecole_nom" value="EduGest Institution" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                    </div>
                    <div>
                        <label>Année Scolaire Actuelle</label><br>
                        <input type="text" name="annee_actuelle" value="2026-2027" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                    </div>
                    <button type="submit" class="btn" style="width: fit-content;">Enregistrer les paramètres</button>
                </form>
            </div>
            
            <div class="card" style="margin-top: 2rem;">
                <h3>Sécurité (Changer le mot de passe)</h3>
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                    <div>
                        <label>Nouveau mot de passe</label><br>
                        <input type="password" name="password" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                    </div>
                    <button type="submit" class="btn" style="width: fit-content; background: #ef4444;">Mettre à jour la sécurité</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
