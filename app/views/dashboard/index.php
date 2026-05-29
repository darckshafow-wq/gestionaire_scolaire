<?php
/**
 * VUE : Dashboard Principal
 */
$total_etudiants = $total_etudiants ?? 0;
$total_admins = $total_admins ?? 0;
$admin_pseudo = $admin_pseudo ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- Icônes pour le design premium (Phosphor Icons) -->
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
                    <a href="/dashboard" class="nav-link active" title="Vue d'ensemble"><i class="ph ph-house" style="font-size: 1.25rem;"></i> <span>Vue d'ensemble</span></a>
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
                 <li class="nav-item"><a href="/filieres" class="nav-link active" title="Filières"><i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières</span></a></li>
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
                <div class="avatar" style="width: 36px; height: 36px; font-size: 0.9rem;"><?= strtoupper(substr($admin_pseudo, 0, 1)) ?></div>
                <div class="profile-info">
                    <span class="profile-name"><?= htmlspecialchars($admin_pseudo) ?></span>
                    <span class="profile-role">Administrateur</span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Bonjour, <?= htmlspecialchars($admin_pseudo) ?> 👋</h1>
                    <p>Voici l'aperçu de votre établissement aujourd'hui.</p>
                </div>
            </header>

            <div class="cards-grid">
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3>Inscrire un Étudiant</h3>
                            <p style="opacity: 0.8; max-width: 200px;">Générer une nouvelle fiche d'inscription rapidement.</p>
                        </div>
                        <div style="padding: 0.5rem; background: rgba(255,255,255,0.2); border-radius: 12px;">
                            <i class="ph ph-user-plus" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="/inscriptions" class="btn-light" style="margin-top: 1rem;"><i class="ph-bold ph-plus"></i> Nouvelle Inscription</a>
                </div>
                
                <div class="card card-alt">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3>Effectif Total</h3>
                            <p style="opacity: 0.8;">Étudiants enregistrés</p>
                            <h2><?= $total_etudiants ?></h2>
                        </div>
                        <div style="padding: 0.5rem; background: rgba(255,255,255,0.2); border-radius: 12px;">
                            <i class="ph ph-student" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card card-light">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3>Administrateurs</h3>
                            <p>Personnel autorisé</p>
                            <h2 style="color: var(--text-main);"><?= $total_admins ?></h2>
                        </div>
                        <div style="padding: 0.5rem; background: var(--primary-light); color: var(--primary-color); border-radius: 12px;">
                            <i class="ph ph-shield-check" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-title">
                <div>Dernières Inscriptions</div>
                <a href="/etudiants" style="font-size: 0.875rem; color: var(--primary-color); font-weight: 500; font-family: 'Inter'; display: flex; align-items: center; gap: 0.25rem;">
                    Voir tout <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom & Prénom</th>
                            <th>Année Scolaire</th>
                            <th>Tuteur</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($etudiants) && count($etudiants) > 0): ?>
                            <?php foreach ($etudiants as $etudiant): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary-light); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem;">
                                                <?= strtoupper(substr($etudiant['nom'], 0, 1)) ?>
                                            </div>
                                            <span style="font-weight: 500;"><?= htmlspecialchars($etudiant['nom']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($etudiant['annee']) ?></td>
                                    <td style="color: var(--text-muted);"><?= htmlspecialchars($etudiant['tuteur']) ?></td>
                                    <td>
                                        <?php if ($etudiant['statut'] === 'Inscrit'): ?>
                                            <span class="badge badge-green">Inscrit</span>
                                        <?php else: ?>
                                            <span class="badge badge-blue"><?= htmlspecialchars($etudiant['statut']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/etudiant_detail?id=<?= htmlspecialchars($etudiant['id']) ?>" style="color: var(--primary-color); font-weight: 500; display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.5rem; border-radius: 6px; transition: background 0.2s;">
                                            <i class="ph ph-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    <i class="ph ph-folder-open" style="font-size: 2rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                                    Aucun étudiant trouvé.
                                </td>
                            </tr>
                        <?php endif; ?>
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