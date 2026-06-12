<?php
$admin_pseudo = $admin_pseudo ?? 'DG';
$professeurs = $professeurs ?? [];
$total_admins = $total_admins ?? 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Dashboard DG</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo" id="sidebar-logo-toggle">
                <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                <span class="brand-font">EPI MANAGEMENT</span>
            </div>

            <div class="sidebar-section-title">Direction</div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dg_dashboard" class="nav-link active" title="Supervision DG"><i class="ph ph-shield-star" style="font-size:1.25rem;"></i><span>Supervision DG</span></a></li>
            </ul>

            <div class="sidebar-section-title">Système</div>
            <ul class="nav-menu" style="flex:0;">
                <li class="nav-item"><a href="/parametres" class="nav-link" title="Paramètres"><i class="ph ph-gear" style="font-size:1.25rem;"></i><span>Paramètres</span></a></li>
                <li class="nav-item"><a href="/logout" class="nav-link nav-link-danger" title="Déconnexion"><i class="ph ph-sign-out" style="font-size:1.25rem;"></i><span>Déconnexion</span></a></li>
            </ul>

            <div class="sidebar-profile">
                <div class="avatar" style="width:36px;height:36px;font-size:0.9rem;background:linear-gradient(135deg, var(--epi-gold), var(--epi-red));"><?= strtoupper(substr($admin_pseudo, 0, 1)) ?></div>
                <div class="profile-info">
                    <span class="profile-name"><?= htmlspecialchars($admin_pseudo) ?></span>
                    <span class="profile-role">Directeur Général</span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Supervision de l'établissement 👋</h1>
                    <p>Validation et contrôle global du personnel et des opérations.</p>
                </div>
            </header>

            <div class="cards-grid">
                <div class="card card-alt">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3>Total Personnel Validé</h3>
                            <p style="opacity: 0.8;">Professeurs actifs</p>
                            <h2><?= count(array_filter($professeurs, fn($p) => $p['accord_dg'] == 1)) ?></h2>
                        </div>
                        <div style="padding: 0.5rem; background: rgba(255,255,255,0.2); border-radius: 12px;">
                            <i class="ph ph-chalkboard-teacher" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card card-light">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3>Professeurs en attente</h3>
                            <p>Nécessitent validation DG</p>
                            <h2 style="color: #dc2626;"><?= count(array_filter($professeurs, fn($p) => $p['accord_dg'] == 0)) ?></h2>
                        </div>
                        <div style="padding: 0.5rem; background: #fee2e2; color: #dc2626; border-radius: 12px;">
                            <i class="ph ph-warning-circle" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-title">
                <div>Validation du Personnel Enseignant</div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Professeur</th>
                            <th>Spécialité</th>
                            <th>Contact</th>
                            <th>Statut DG</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($professeurs) > 0): ?>
                            <?php foreach ($professeurs as $prof): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--epi-blue-light); color: var(--epi-blue); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem;">
                                                <?= strtoupper(substr($prof['nom'], 0, 1)) ?>
                                            </div>
                                            <span style="font-weight: 500;"><?= htmlspecialchars($prof['nom'] . ' ' . $prof['prenom']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($prof['specialite'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($prof['telephone'] ?? 'N/A') ?></td>
                                    <td>
                                        <?php if ($prof['accord_dg'] == 1): ?>
                                            <span class="badge badge-green">Validé</span>
                                        <?php else: ?>
                                            <span class="badge badge-red">En attente</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($prof['accord_dg'] == 0): ?>
                                            <form action="/dg_validate_prof" method="POST" style="margin:0;">
                                                <input type="hidden" name="id" value="<?= $prof['id'] ?>">
                                                <button type="submit" class="btn" style="padding: 0.25rem 0.75rem; font-size: 0.8rem;"><i class="ph ph-check"></i> Valider</button>
                                            </form>
                                        <?php else: ?>
                                            <span style="color:var(--text-muted); font-size:0.9rem;">Opérationnel</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                    <i class="ph ph-users-three" style="font-size: 2rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                                    Aucun professeur enregistré.
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
