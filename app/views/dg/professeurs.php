<?php
$admin_pseudo = $admin_pseudo ?? 'DG';
$candidats    = $candidats ?? [];
$personnel    = $personnel ?? [];
$nb_candidats = count($candidats);
$nb_personnel = count($personnel);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT – Corps Enseignant</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="/assets/css/roles/dg.css">
</head>
<body>
<div class="dashboard-layout">
    <?php include ROOT_PATH . '/app/views/dg/sidebar_dg.php'; ?>

    <main class="main-content">
        <header class="header" style="margin-bottom: 2rem;">
            <div class="greeting">
                <h1>Corps Enseignant</h1>
                <p>Gestion des candidatures et du personnel enseignant validé.</p>
            </div>
        </header>

        <!-- Navigation par onglets (Horizontale) -->
        <nav class="horizontal-tabs">
            <a onclick="switchTab('candidats', this)" class="tab-link active">
                <i class="ph ph-user-circle-plus" style="font-size:1.2rem;"></i>
                Candidats
                <span class="tab-badge" style="background:#fee2e2;color:#dc2626;"><?= count($candidats) ?></span>
            </a>
            <a onclick="switchTab('personnel', this)" class="tab-link">
                <i class="ph ph-chalkboard-teacher" style="font-size:1.2rem;"></i>
                Personnel
                <span class="tab-badge" style="background:#dcfce7;color:#16a34a;"><?= count($personnel) ?></span>
            </a>
        </nav>

        <!-- Notification succès/erreur -->
        <?php if (isset($_SESSION['snackbar'])): ?>
            <div style="background:#dcfce7;border-left:4px solid #16a34a;color:#166534;padding:1rem 1.25rem;border-radius:var(--radius-md);margin-bottom:1.5rem;display:flex;gap:.75rem;align-items:flex-start;">
                <i class="ph ph-check-circle" style="font-size:1.3rem;flex-shrink:0;margin-top:.1rem;"></i>
                <div><?= $_SESSION['snackbar'] ?></div>
            </div>
            <?php unset($_SESSION['snackbar']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['snackbar_error'])): ?>
            <div style="background:#fee2e2;border-left:4px solid #dc2626;color:#991b1b;padding:1rem 1.25rem;border-radius:var(--radius-md);margin-bottom:1.5rem;">
                <i class="ph ph-warning-circle"></i> <?= htmlspecialchars($_SESSION['snackbar_error']) ?>
            </div>
            <?php unset($_SESSION['snackbar_error']); ?>
        <?php endif; ?>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-box">
                <div class="icon-wrap" style="background:#dcfce7;color:#16a34a;"><i class="ph ph-chalkboard-teacher"></i></div>
                <div>
                    <div class="value" style="color:var(--epi-blue);"><?= $nb_personnel ?></div>
                    <div class="label">Personnel de l'école</div>
                </div>
            </div>
            <div class="stat-box">
                <div class="icon-wrap" style="background:#fee2e2;color:#dc2626;"><i class="ph ph-user-circle-plus"></i></div>
                <div>
                    <div class="value" style="color:var(--epi-red);"><?= $nb_candidats ?></div>
                    <div class="label">En attente de validation</div>
                </div>
            </div>
        </div>

        <!-- ===== ONGLET : CANDIDATS ===== -->
        <div id="tab-candidats" class="tab-panel active">
            <div class="section-heading">
                <i class="ph ph-user-circle-plus" style="color:var(--epi-red);"></i>
                Candidatures en attente de validation
            </div>

            <?php if (!empty($candidats)): ?>
                <?php foreach ($candidats as $c): ?>
                <div class="prof-card">
                    <div class="prof-avatar" style="background:#fee2e2;color:#dc2626;">
                        <?= strtoupper(substr($c['nom'], 0, 1)) ?>
                    </div>
                    <div class="prof-info">
                        <div class="name"><?= htmlspecialchars($c['nom'] . ' ' . $c['prenom']) ?></div>
                        <div class="sub">Candidat externe · non intégré</div>
                        <div class="prof-meta">
                            <span><i class="ph ph-graduation-cap"></i><?= htmlspecialchars($c['specialite'] ?? 'N/A') ?></span>
                            <span><i class="ph ph-envelope"></i><?= htmlspecialchars($c['email'] ?? '—') ?></span>
                            <span><i class="ph ph-phone"></i><?= htmlspecialchars($c['telephone'] ?? '—') ?></span>
                        </div>
                    </div>
                    <div class="prof-actions">
                        <form action="/dg/valider_prof" method="POST" onsubmit="return confirm('Admettre <?= addslashes(htmlspecialchars($c['nom'] . ' ' . $c['prenom'])) ?> et générer ses accès ?')">
                            <input type="hidden" name="id" value="<?= $c['id'] ?>">
                            <button type="submit" class="btn-accept"><i class="ph ph-check-circle"></i> Admettre</button>
                        </form>
                        <form action="/dg/rejeter_prof" method="POST" onsubmit="return confirm('Rejeter définitivement cette candidature ?')">
                            <input type="hidden" name="id" value="<?= $c['id'] ?>">
                            <button type="submit" class="btn-reject"><i class="ph ph-x-circle"></i> Rejeter</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="ph ph-check-circle"></i>
                    <p>Aucune candidature en attente</p>
                    <small>Toutes les candidatures reçues ont été traitées.</small>
                </div>
            <?php endif; ?>
        </div>

        <!-- ===== ONGLET : PERSONNEL VALIDÉ ===== -->
        <div id="tab-personnel" class="tab-panel">
            <div class="section-heading">
                <i class="ph ph-chalkboard-teacher" style="color:var(--epi-blue);"></i>
                Personnel enseignant de l'établissement
            </div>

            <?php if (!empty($personnel)): ?>
                <?php foreach ($personnel as $p): ?>
                <div class="prof-card">
                    <div class="prof-avatar" style="background:var(--epi-blue-light);color:var(--epi-blue);">
                        <?= strtoupper(substr($p['nom'], 0, 1)) ?>
                    </div>
                    <div class="prof-info">
                        <div class="name">Prof. <?= htmlspecialchars($p['nom'] . ' ' . $p['prenom']) ?></div>
                        <div class="sub">Personnel de l'école · Accès actif</div>
                        <div class="prof-meta">
                            <span><i class="ph ph-graduation-cap"></i><?= htmlspecialchars($p['specialite'] ?? 'N/A') ?></span>
                            <span><i class="ph ph-envelope"></i><?= htmlspecialchars($p['email'] ?? '—') ?></span>
                            <span><i class="ph ph-phone"></i><?= htmlspecialchars($p['telephone'] ?? '—') ?></span>
                            <span style="background:#dcfce7;color:#16a34a;border-color:#bbf7d0;"><i class="ph ph-check-circle"></i>Actif</span>
                        </div>
                    </div>
                    <div>
                        <span class="badge badge-green" style="font-size:.8rem;padding:.35rem .85rem;">Personnel</span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="ph ph-users"></i>
                    <p>Aucun enseignant dans le personnel</p>
                    <small>Admettez des candidats pour constituer le corps enseignant.</small>
                </div>
            <?php endif; ?>
        </div>

    </main>
</div>

<script src="/assets/js/roles/dg.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
