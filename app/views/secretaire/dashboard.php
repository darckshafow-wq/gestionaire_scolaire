<?php
$admin_pseudo      = $admin_pseudo ?? 'Secrétaire';
$total_etudiants   = $total_etudiants ?? 0;
$dossiers_attente  = $dossiers_attente ?? 0;
$total_filieres    = $total_filieres ?? 0;
$total_profs       = $total_profs ?? 0;
$derniers_dossiers = $derniers_dossiers ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Secrétariat</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Bonjour, <?= htmlspecialchars($admin_pseudo) ?> 👋</h1>
                    <p>Gestion des dossiers, des filières et du planning académique.</p>
                </div>
            </header>

            <div class="cards-grid">
                <div class="card">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                        <div><h3>Étudiants</h3><p style="opacity:.8">Total</p><h2><?= $total_etudiants ?></h2></div>
                        <div style="padding:.5rem;background:rgba(255,255,255,.2);border-radius:12px;"><i class="ph ph-users" style="font-size:1.5rem;"></i></div>
                    </div>
                </div>
                <div class="card" style="background:linear-gradient(135deg,#dc2626,#b91c1c);">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                        <div><h3>Dossiers en attente</h3><p style="opacity:.8">À traiter</p><h2><?= $dossiers_attente ?></h2></div>
                        <div style="padding:.5rem;background:rgba(255,255,255,.2);border-radius:12px;"><i class="ph ph-clock" style="font-size:1.5rem;"></i></div>
                    </div>
                </div>
                <div class="card card-alt">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                        <div><h3>Filières</h3><p style="opacity:.8">Actives</p><h2><?= $total_filieres ?></h2></div>
                        <div style="padding:.5rem;background:rgba(255,255,255,.2);border-radius:12px;"><i class="ph ph-books" style="font-size:1.5rem;"></i></div>
                    </div>
                </div>
                <div class="card card-light">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                        <div><h3>Professeurs</h3><p>Personnel</p><h2><?= $total_profs ?></h2></div>
                        <div style="padding:.5rem;background:var(--epi-blue-light);color:var(--epi-blue);border-radius:12px;"><i class="ph ph-chalkboard-teacher" style="font-size:1.5rem;"></i></div>
                    </div>
                </div>
            </div>

            <?php if (!empty($derniers_dossiers)): ?>
            <div class="section-title"><div>Derniers Dossiers Reçus</div><a href="/secretaire/dossiers" style="font-size:.9rem;color:var(--epi-blue);">Voir tous →</a></div>
            <div class="table-container">
                <table>
                    <thead><tr><th>Étudiant</th><th>Filière</th><th>Date</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php foreach ($derniers_dossiers as $d): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($d['nom'] . ' ' . $d['prenom']) ?></strong></td>
                                <td><?= htmlspecialchars($d['nom_filiere'] ?? 'N/A') ?></td>
                                <td style="font-size:.85rem;color:var(--text-muted);"><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                                <td><a href="/secretaire/dossiers" style="color:var(--epi-blue);font-size:.85rem;font-weight:600;">Examiner →</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </main>
    </div>

    <?php if (isset($_SESSION['snackbar'])): ?>
        <div id="snackbar" class="snackbar show"><?= $_SESSION['snackbar'] ?></div>
        <?php unset($_SESSION['snackbar']); ?>
    <?php endif; ?>
    <script src="/assets/js/main.js"></script>
</body>
</html>
