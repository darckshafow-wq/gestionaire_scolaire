<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Détails de <?= htmlspecialchars($etudiant['nom']) ?></title>
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
                    <h1>Profil de l'étudiant</h1>
                    <p>Fiche détaillée et actions rapides.</p>
                </div>
            </header>

            <div class="detail-card">
                <div style="display: flex; gap: 2.5rem; align-items: flex-start;">
                    <div style="background: linear-gradient(135deg, var(--primary-light), white); width: 140px; height: 140px; border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm); border: 1px solid var(--border-color); flex-shrink: 0;">
                        <i class="ph-fill ph-user" style="font-size: 4rem; color: var(--primary-color);"></i>
                    </div>
                    
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                            <div>
                                <h2 style="font-size: 2.25rem; margin-bottom: 0.5rem; color: var(--text-main); line-height: 1.1;"><?= htmlspecialchars($etudiant['nom']) ?></h2>
                                <?php if ($etudiant['statut'] === 'Inscrit'): ?>
                                    <span class="badge badge-green" style="display: inline-flex; align-items: center; gap: 0.25rem;"><i class="ph-fill ph-check-circle"></i> Inscrit Actif</span>
                                <?php else: ?>
                                    <span class="badge badge-blue"><?= htmlspecialchars($etudiant['statut']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div style="display: flex; gap: 0.75rem;">
                                <a href="/modifier_etudiant.php?id=<?= $etudiant['id'] ?>" class="btn-light" style="padding: 0.5rem 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 8px;">
                                    <i class="ph ph-pencil-simple"></i> Modifier
                                </a>
                                <a href="/generer_pdf.php?id=<?= $etudiant['id'] ?>" class="btn" style="padding: 0.5rem 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 8px;">
                                    <i class="ph ph-file-pdf"></i> Générer Fiche
                                </a>
                            </div>
                        </div>
                        
                        <div style="height: 1px; background: var(--border-color); margin: 2rem 0;"></div>
                        
                        <div class="grid-2">
                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-cake"></i> Date de naissance</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['date_naissance']) ?></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-calendar"></i> Année Scolaire</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['annee_scolaire']) ?></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-users"></i> Nom du Tuteur</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['tuteur_nom']) ?></div>
                            </div>
                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-phone"></i> Contact Tuteur</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['tuteur_contact'] ?? 'Non renseigné') ?></div>
                            </div>
                            <div class="info-group" style="grid-column: span 2;">
                                <div class="info-label"><i class="ph ph-envelope"></i> Email Contact</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['email'] ?? 'Non renseigné') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>