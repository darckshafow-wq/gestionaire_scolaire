<?php
/**
 * VUE : Dashboard Principal
 * Fichier : app/views/dashboard/index.php
 */
$total_etudiants = $total_etudiants ?? 0;
$total_admins = $total_admins ?? 0;
$admin_pseudo = $admin_pseudo ?? 'Admin';
$etudiants = $etudiants ?? [];
$filieres = $filieres ?? [];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
    <div class="dashboard-layout">
        
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo" id="sidebar-logo-toggle">
                <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                <span class="brand-font">EPI Gest</span>
            </div>

            <div class="sidebar-section-title">Main</div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link active" title="Vue d'ensemble"><i class="ph ph-house" style="font-size:1.25rem;"></i><span>Vue d'ensemble</span></a></li>
                <li class="nav-item"><a href="/etudiants" class="nav-link" title="Registre Étudiants"><i class="ph ph-users" style="font-size:1.25rem;"></i><span>Registre Étudiants</span></a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link" title="Inscriptions"><i class="ph ph-file-text" style="font-size:1.25rem;"></i><span>Inscriptions</span></a></li>
                <li class="nav-item"><a href="/filieres" class="nav-link" title="Filières"><i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières</span></a></li>
                <li class="nav-item"><a href="/calendrier" class="nav-link" title="Calendrier"><i class="ph ph-calendar-blank" style="font-size:1.25rem;"></i><span>Calendrier</span></a></li>
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
                    <a href="/inscriptions" class="btn-light" style="margin-top: 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;"><i class="ph-bold ph-plus"></i> Nouvelle Inscription</a>
                </div>
                
                <div class="card card-alt">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3>Effectif Total</h3>
                            <p style="opacity: 0.8;">Étudiants enregistrés</p>
                            <h2><?= (int)$total_etudiants ?></h2>
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
                            <h2 style="color: var(--text-main);"><?= (int)$total_admins ?></h2>
                        </div>
                        <div style="padding: 0.5rem; background: var(--primary-light); color: var(--primary-color); border-radius: 12px;">
                            <i class="ph ph-shield-check" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-title">
                <div>Dernières Inscriptions</div>
                <a href="/etudiants" style="font-size: 0.875rem; color: var(--primary-color); font-weight: 500; font-family: 'Inter'; display: flex; align-items: center; gap: 0.25rem; text-decoration: none;">
                    Voir tout <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            <div class="table-container" style="margin-bottom: 3rem;">
                <table>
                    <thead>
                        <tr>
                            <th>Nom & Prénom</th>
                            <th>Filière</th> 
                            <th>Année Scolaire</th>
                            <th>Statut</th> <th>Tuteur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($etudiants) > 0): ?>
                            <?php foreach ($etudiants as $etudiant): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary-light); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem;">
                                                <?= strtoupper(substr($etudiant['nom'] ?? 'E', 0, 1)) ?>
                                            </div>
                                            <span style="font-weight: 500;"><?= htmlspecialchars(($etudiant['nom'] ?? '') . ' ' . ($etudiant['prenom'] ?? '')) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($etudiant['nom_filiere'])): ?>
                                            <span class="badge badge-blue" style="font-weight: 600;">
                                                <?= htmlspecialchars($etudiant['nom_filiere']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge" style="background: #f3f4f6; color: #6b7280; font-size: 0.8rem;">
                                                Non assignée
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($etudiant['annee_scolaire'] ?? 'N/A') ?></td>
                                    
                                    <td>
                                        <form action="/etudiant_toggle_statut" method="POST" style="margin:0;">
                                            <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
                                            <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;" title="Cliquer pour basculer le statut">
                                                <?php 
                                                $statutDossier = trim($etudiant['statut'] ?? 'en attente');
                                                if ($statutDossier === 'Inscrit'): 
                                                ?>
                                                    <span class="badge" style="display:inline-flex; align-items:center; gap:0.25rem; background:#dcfce7; color:#15803d; font-weight:600; padding:0.25rem 0.65rem; border-radius:6px; font-size:0.8rem;">
                                                        <i class="ph-bold ph-check-circle" style="font-size:0.95rem;"></i> Inscrit
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge" style="display:inline-flex; align-items:center; gap:0.25rem; background:#ffedd5; color:#c2410c; font-weight:600; padding:0.25rem 0.65rem; border-radius:6px; font-size:0.8rem;">
                                                        <i class="ph-bold ph-clock" style="font-size:0.95rem;"></i> En attente
                                                    </span>
                                                <?php endif; ?>
                                            </button>
                                        </form>
                                    </td>

                                    <td style="color: var(--text-muted);"><?= htmlspecialchars($etudiant['tuteur_nom'] ?? 'Non renseigné') ?></td>
                                    <td>
                                        <a href="/etudiant_detail?id=<?= $etudiant['id'] ?>" style="color: var(--primary-color); font-weight: 500; display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.5rem; border-radius: 6px; transition: background 0.2s; text-decoration: none;">
                                            <i class="ph ph-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    <i class="ph ph-folder-open" style="font-size: 2rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                                    Aucun étudiant trouvé.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="section-title">
                <div>Statistiques par Filière</div>
                <a href="/filieres" style="font-size: 0.875rem; color: var(--primary-color); font-weight: 500; font-family: 'Inter'; display: flex; align-items: center; gap: 0.25rem; text-decoration: none;">
                    Gérer les filières <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID / Code</th>
                            <th>Nom de la Filière</th>
                            <th>Effectif Actuel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($filieres) > 0): ?>
                            <?php foreach ($filieres as $filiere): ?>
                                <tr>
                                    <td style="font-family: monospace; font-weight: bold; color: var(--text-muted);">
                                        #<?= htmlspecialchars($filiere['code'] ?? $filiere['id']) ?>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 32px; height: 32px; border-radius: 6px; background: var(--primary-light); color: var(--primary-color); display: flex; align-items: center; justify-content: center;">
                                                <i class="ph ph-books" style="font-size: 1.1rem;"></i>
                                            </div>
                                            <span style="font-weight: 600;"><?= htmlspecialchars($filiere['nom'] ?? 'Filière inconnue') ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php $effectif = (int)($filiere['total_etudiants'] ?? 0); ?>
                                        <span class="badge <?= $effectif > 0 ? 'badge-green' : 'badge-blue' ?>" style="font-weight: bold;">
                                            <?= $effectif ?> étudiant(s)
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    <i class="ph ph-books" style="font-size: 2rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                                    Aucune filière configurée ou active.
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

    <?php if (isset($_SESSION['snackbar_error'])): ?>
        <div id="snackbar" class="snackbar show" style="background:#ef4444;">
            <i class="ph-bold ph-warning-circle" style="font-size: 1.2rem; margin-right: 0.5rem; vertical-align: text-bottom;"></i>
            <?= htmlspecialchars($_SESSION['snackbar_error']) ?>
        </div>
    <?php unset($_SESSION['snackbar_error']); endif; ?>

    <script src="/assets/js/main.js"></script>
</body>

</html>