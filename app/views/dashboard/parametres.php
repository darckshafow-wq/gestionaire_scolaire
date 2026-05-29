<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Paramètres</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo" id="sidebar-logo-toggle">
                <span style="font-size: 2rem; color: var(--accent-indigo);"><i class="ph-fill ph-graduation-cap"></i></span> 
                <span class="brand-font">EduGest Pro</span>
            </div>
            
            <div class="sidebar-section-title">Main</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link" title="Vue d'ensemble"><i class="ph ph-house" style="font-size: 1.25rem;"></i> <span>Vue d'ensemble</span></a>
                </li>
                <li class="nav-item">
                    <a href="/etudiants" class="nav-link" title="Registre Étudiants"><i class="ph ph-users" style="font-size: 1.25rem;"></i> <span>Registre Étudiants</span></a>
                </li>
                <li class="nav-item">
                    <a href="/inscriptions" class="nav-link" title="Inscriptions"><i class="ph ph-file-text" style="font-size: 1.25rem;"></i> <span>Inscriptions</span></a>
                </li>
                <li class="nav-item">
                    <a href="/calendrier" class="nav-link" title="Calendrier"><i class="ph ph-calendar-blank" style="font-size: 1.25rem;"></i> <span>Calendrier</span></a>
                </li>
            </ul>

            <div class="sidebar-section-title">Système</div>
            <ul class="nav-menu" style="flex: 0;">
                <li class="nav-item">
                    <a href="/parametres" class="nav-link active" title="Paramètres"><i class="ph ph-gear" style="font-size: 1.25rem;"></i> <span>Paramètres</span></a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link nav-link-danger" title="Déconnexion"><i class="ph ph-sign-out" style="font-size: 1.25rem;"></i> <span>Déconnexion</span></a>
                </li>
            </ul>

            <div class="sidebar-profile">
                <div class="avatar" style="width: 36px; height: 36px; font-size: 0.9rem;">A</div>
                <div class="profile-info">
                    <span class="profile-name">Admin</span>
                    <span class="profile-role">Administrateur</span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Paramètres Système</h1>
                    <p>Configuration générale de l'application.</p>
                </div>
            </header>

            <div class="grid-2">
                <div class="detail-card">
                    <h3 style="margin-bottom: 1.5rem; color: var(--text-main); font-family: 'Outfit'; font-size: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph-fill ph-buildings"></i> Établissement
                    </h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Nom de l'école</label>
                            <input type="text" name="ecole_nom" value="EduGest Institution">
                        </div>
                        <div class="form-group">
                            <label>Année Scolaire Actuelle</label>
                            <input type="text" name="annee_actuelle" value="2026-2027">
                        </div>
                        <button type="submit" class="btn" style="margin-top: 1rem;"><i class="ph ph-floppy-disk"></i> Enregistrer</button>
                    </form>
                </div>
                
                <div class="detail-card">
                    <h3 style="margin-bottom: 1.5rem; color: var(--text-main); font-family: 'Outfit'; font-size: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph-fill ph-shield-check"></i> Sécurité
                    </h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Nouveau mot de passe</label>
                            <input type="password" name="password" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label>Confirmer le mot de passe</label>
                            <input type="password" name="password_confirm" placeholder="••••••••">
                        </div>
                        <button type="submit" class="btn" style="margin-top: 1rem; background: linear-gradient(135deg, #f43f5e, #e11d48);"><i class="ph ph-lock-key"></i> Mettre à jour</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
