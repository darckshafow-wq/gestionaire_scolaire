<?php
$admin_pseudo = $admin_pseudo ?? 'DG';
$filieres     = $filieres ?? [];
$total_filieres = count($filieres);
$actives = count(array_filter($filieres, fn($f) => $f['statut'] === 'Active'));
$inactives = $total_filieres - $actives;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT – Filières Académiques</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/roles/dg.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
<div class="page-layout">

    <!-- COLONNE 1 : Sidebar principale -->
    <?php include ROOT_PATH . '/app/views/dg/sidebar_dg.php'; ?>

    <!-- COLONNE 2 : Panneau de navigation secondaire (onglets verticaux) -->
    <nav class="nav-panel">
        <div class="nav-panel-title">Filières Académiques</div>

        <div class="nav-panel-item active">
            <i class="ph ph-books" style="font-size:1.1rem;"></i>
            Liste des Filières
        </div>

        <div class="nav-divider"></div>
        <div class="nav-panel-title">Raccourcis</div>

        <a href="/dg/dashboard" class="nav-panel-item">
            <i class="ph ph-squares-four" style="font-size:1.1rem;"></i>
            Tableau de bord
        </a>
        <a href="/dg/professeurs" class="nav-panel-item">
            <i class="ph ph-chalkboard-teacher" style="font-size:1.1rem;"></i>
            Corps Enseignant
        </a>
    </nav>

    <!-- COLONNE 3 : Contenu principal -->
    <div class="content-panel">

        <div class="dashboard-header-card">
            <div>
                <p style="text-transform:uppercase;letter-spacing:0.05em;font-size:0.8rem;margin-bottom:0.5rem;opacity:0.7;">Vue d'ensemble</p>
                <h1>Filières Académiques</h1>
                <p>Consultez la liste des filières enseignées au sein de l'établissement.</p>
            </div>
            <div style="background:rgba(255,255,255,0.15);padding:1rem;border-radius:50%;width:80px;height:80px;display:flex;align-items:center;justify-content:center;">
                <i class="ph ph-books" style="font-size:2.5rem;"></i>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-box">
                <div class="icon-wrap" style="background:var(--epi-blue-light);color:var(--epi-blue);"><i class="ph ph-check-circle"></i></div>
                <div>
                    <div class="value" style="color:var(--epi-blue);"><?= $actives ?></div>
                    <div class="label">Filières actives</div>
                </div>
            </div>
            <div class="stat-box">
                <div class="icon-wrap" style="background:#fee2e2;color:#dc2626;"><i class="ph ph-pause-circle"></i></div>
                <div>
                    <div class="value" style="color:var(--epi-red);"><?= $inactives ?></div>
                    <div class="label">Filières inactives</div>
                </div>
            </div>
        </div>

        <div class="section-heading">Détail des filières</div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom de la Filière</th>
                        <th>Niveau</th>
                        <th>Durée</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($filieres)): ?>
                        <?php foreach ($filieres as $f): ?>
                        <tr>
                            <td>
                                <span style="font-family:'Outfit';font-weight:700;font-size:.9rem;background:var(--epi-blue-light);color:var(--epi-blue);padding:.2rem .6rem;border-radius:6px;">
                                    <?= htmlspecialchars($f['code']) ?>
                                </span>
                            </td>
                            <td style="font-weight:500;"><?= htmlspecialchars($f['nom']) ?></td>
                            <td><?= htmlspecialchars($f['niveau']) ?></td>
                            <td><?= $f['duree_annees'] ?> an<?= $f['duree_annees'] > 1 ? 's' : '' ?></td>
                            <td>
                                <?php if ($f['statut'] === 'Active'): ?>
                                    <span class="badge badge-green">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-red">Inactive</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;padding:2.5rem;color:var(--text-muted);">
                                <i class="ph ph-books" style="font-size:2rem;opacity:.3;display:block;margin-bottom:.5rem;"></i>
                                Aucune filière disponible.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="/assets/js/roles/dg.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
