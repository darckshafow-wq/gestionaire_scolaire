<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Registre Étudiants</title>
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
                    <a href="/etudiants" class="nav-link active" title="Registre Étudiants"><i class="ph ph-users" style="font-size: 1.25rem;"></i> <span>Registre Étudiants</span></a>
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
                    <a href="/parametres" class="nav-link" title="Paramètres"><i class="ph ph-gear" style="font-size: 1.25rem;"></i> <span>Paramètres</span></a>
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
                    <h1>Registre des Étudiants</h1>
                    <p>Liste complète des élèves inscrits cette année.</p>
                </div>
            </header>

            <div class="card card-light" style="margin-bottom: 2rem; padding: 1.5rem;">
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div style="position: relative; flex: 1;">
                        <i class="ph ph-magnifying-glass" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1.25rem;"></i>
                        <input type="text" placeholder="Rechercher un étudiant (nom, prénom...)" style="width: 100%; padding: 0.875rem 1rem 0.875rem 3rem; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-family: 'Inter'; outline: none; transition: all 0.2s;">
                    </div>
                    <button class="btn" style="padding: 0.875rem 1.5rem;"><i class="ph ph-magnifying-glass"></i> Rechercher</button>
                    <a href="/inscriptions" class="btn" style="background: linear-gradient(135deg, var(--accent-sky), var(--primary-color)); padding: 0.875rem 1.5rem;"><i class="ph ph-plus"></i> Nouveau</a>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom & Prénom</th>
                            <th>Date de naissance</th>
                            <th>Tuteur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: var(--text-muted); font-family: monospace;">#101</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary-light); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem;">D</div>
                                    <span style="font-weight: 500;">Dupont Jean</span>
                                </div>
                            </td>
                            <td>14/05/2010</td>
                            <td style="color: var(--text-muted);">Marie Dupont</td>
                            <td>
                                <a href="/etudiant_detail" class="btn-light" style="padding: 0.35rem 0.75rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                    <i class="ph ph-eye"></i> Détails
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="color: var(--text-muted); font-family: monospace;">#102</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary-light); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem;">M</div>
                                    <span style="font-weight: 500;">Martin Sophie</span>
                                </div>
                            </td>
                            <td>28/02/2011</td>
                            <td style="color: var(--text-muted);">Paul Martin</td>
                            <td>
                                <a href="/etudiant_detail" class="btn-light" style="padding: 0.35rem 0.75rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                    <i class="ph ph-eye"></i> Détails
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <?php if (isset($_SESSION['snackbar'])): ?>
        <div id="snackbar" class="snackbar show">
            <i class="ph-bold ph-check-circle" style="font-size: 1.2rem; margin-right: 0.5rem; vertical-align: text-bottom;"></i>
            <?= htmlspecialchars($_SESSION['snackbar']) ?>
        </div>
    <?php unset($_SESSION['snackbar']); endif; ?>

    <script src="/assets/js/main.js"></script>
</body>
</html>
