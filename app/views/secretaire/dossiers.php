<?php
$admin_pseudo = $admin_pseudo ?? 'Secrétaire';
$dossiers     = $dossiers ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Dossiers en Attente</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Dossiers d'Inscription en Attente</h1>
                    <p>Examinez les candidatures et validez (ou refusez) les nouveaux étudiants.</p>
                </div>
            </header>

            <?php if (isset($_SESSION['snackbar'])): ?>
                <div style="background:#dcfce7;border-left:4px solid #16a34a;color:#166534;padding:1rem;border-radius:var(--radius-md);margin-bottom:1.5rem;">
                    <?= $_SESSION['snackbar'] ?>
                </div>
                <?php unset($_SESSION['snackbar']); ?>
            <?php endif; ?>

            <?php if (empty($dossiers)): ?>
                <div class="detail-card" style="text-align:center;padding:3rem;">
                    <i class="ph ph-check-circle" style="font-size:3rem;color:#16a34a;margin-bottom:1rem;display:block;"></i>
                    <h3>Tout est traité !</h3>
                    <p style="color:var(--text-muted);margin-top:.5rem;">Aucun dossier en attente.</p>
                </div>
            <?php else: ?>
                <?php foreach ($dossiers as $d): ?>
                    <div class="detail-card" style="margin-bottom:1.5rem;">
                        <div style="display:flex;gap:1.5rem;align-items:flex-start;flex-wrap:wrap;">
                            <!-- Photo -->
                            <div style="flex-shrink:0;">
                                <?php if ($d['photo_url']): ?>
                                    <img src="<?= htmlspecialchars($d['photo_url']) ?>" style="width:80px;height:80px;object-fit:cover;border-radius:var(--radius-md);border:2px solid var(--border-color);">
                                <?php else: ?>
                                    <div style="width:80px;height:80px;background:var(--epi-blue-light);color:var(--epi-blue);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:bold;font-family:'Outfit';">
                                        <?= strtoupper(substr($d['nom'], 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Infos -->
                            <div style="flex:1;">
                                <h3 style="font-family:'Outfit';margin-bottom:.5rem;"><?= htmlspecialchars($d['nom'] . ' ' . $d['prenom']) ?></h3>
                                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.5rem;font-size:.9rem;color:var(--text-muted);">
                                    <div><i class="ph ph-graduation-cap"></i> <?= htmlspecialchars($d['nom_filiere'] ?? 'N/A') ?></div>
                                    <div><i class="ph ph-calendar-blank"></i> <?= date('d/m/Y', strtotime($d['date_naissance'])) ?></div>
                                    <div><i class="ph ph-envelope"></i> <?= htmlspecialchars($d['email'] ?? '—') ?></div>
                                    <div><i class="ph ph-user"></i> Tuteur: <?= htmlspecialchars($d['tuteur_nom']) ?></div>
                                    <div><i class="ph ph-phone"></i> <?= htmlspecialchars($d['tuteur_contact']) ?></div>
                                    <div><i class="ph ph-clock"></i> Reçu le <?= date('d/m/Y H:i', strtotime($d['created_at'])) ?></div>
                                </div>

                                <!-- Document PDF -->
                                <?php if ($d['document_url']): ?>
                                    <div style="margin-top:1rem;">
                                        <a href="<?= htmlspecialchars($d['document_url']) ?>" target="_blank" style="display:inline-flex;align-items:center;gap:.4rem;background:#fee2e2;color:#dc2626;padding:.5rem 1rem;border-radius:var(--radius-md);text-decoration:none;font-size:.85rem;font-weight:600;">
                                            <i class="ph ph-file-pdf" style="font-size:1.1rem;"></i> Voir le dossier PDF
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Actions -->
                            <div style="display:flex;flex-direction:column;gap:.5rem;flex-shrink:0;">
                                <form action="/secretaire/valider_dossier" method="POST">
                                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                    <input type="hidden" name="action" value="accepter">
                                    <button type="submit" class="btn" style="width:100%;">
                                        <i class="ph ph-check-circle"></i> Accepter
                                    </button>
                                </form>
                                <form action="/secretaire/valider_dossier" method="POST" onsubmit="return confirm('Rejeter ce dossier ?');">
                                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                    <input type="hidden" name="action" value="rejeter">
                                    <button type="submit" style="width:100%;background:#fee2e2;color:#dc2626;border:none;cursor:pointer;padding:.75rem 1.5rem;border-radius:var(--radius-md);font-weight:500;display:flex;align-items:center;justify-content:center;gap:.4rem;">
                                        <i class="ph ph-x-circle"></i> Refuser
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
