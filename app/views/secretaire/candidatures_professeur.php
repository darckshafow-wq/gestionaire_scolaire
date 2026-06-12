<?php
$admin_pseudo = $admin_pseudo ?? 'Secrétaire';
$candidatures = $candidatures ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Candidatures Professeurs</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Candidatures Professeurs</h1>
                    <p>Consultez les demandes de poste en attente de validation par la Direction Générale.</p>
                </div>
            </header>

            <?php if (empty($candidatures)): ?>
                <div class="detail-card" style="text-align:center;padding:3rem;">
                    <i class="ph ph-check-circle" style="font-size:3rem;color:#16a34a;margin-bottom:1rem;display:block;"></i>
                    <h3>Aucune candidature</h3>
                    <p style="color:var(--text-muted);margin-top:.5rem;">Il n'y a pas de demande de poste en attente.</p>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Professeur</th>
                                <th>Spécialité</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date de demande</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($candidatures as $c): ?>
                                <tr>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:.75rem;">
                                            <div style="width:34px;height:34px;border-radius:50%;background:var(--epi-blue-light);color:var(--epi-blue);display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:.8rem;"><?= strtoupper(substr($c['nom'], 0, 1)) ?></div>
                                            <span style="font-weight:500;"><?= htmlspecialchars($c['nom'] . ' ' . $c['prenom']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($c['specialite'] ?? 'N/A') ?></td>
                                    <td style="font-size:.85rem;color:var(--text-muted);"><?= htmlspecialchars($c['email'] ?? '—') ?></td>
                                    <td style="font-size:.85rem;color:var(--text-muted);"><?= htmlspecialchars($c['telephone'] ?? '—') ?></td>
                                    <td style="font-size:.85rem;color:var(--text-muted);"><?= date('d/m/Y', strtotime($c['created_at'])) ?></td>
                                    <td>
                                        <span class="badge badge-red">En attente DG</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
