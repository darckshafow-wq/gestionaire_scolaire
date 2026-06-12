<?php
$etudiant = $etudiant ?? [];
$plannings = $plannings ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Mon Espace</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { background: #f0f4ff; }
        .mobile-header {
            background: linear-gradient(135deg, var(--epi-blue), var(--epi-navy));
            color: white;
            padding: 2.5rem 1.5rem 5rem;
        }
        .content-container {
            max-width: 650px;
            margin: -3.5rem auto 2rem;
            padding: 0 1rem;
        }
        .info-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            margin-bottom: 1.25rem;
        }
        .planning-item {
            border-left: 4px solid var(--epi-gold);
            padding: 1rem 1.25rem;
            background: white;
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
            margin-bottom: 0.75rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>
    <div class="mobile-header">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <p style="opacity: 0.75; font-size: 0.85rem; margin-bottom: 0.2rem; text-transform: uppercase; letter-spacing: 0.05em;">Mon Espace EPI</p>
                <h1 style="font-family: 'Outfit'; font-size: 1.75rem; margin-bottom: 0.1rem;">
                    <?= htmlspecialchars($etudiant['prenom'] ?? '') . ' ' . htmlspecialchars($etudiant['nom'] ?? '') ?>
                </h1>
                <p style="opacity: 0.7; font-size: 0.9rem;"><?= htmlspecialchars($etudiant['nom_filiere'] ?? 'Filière non définie') ?></p>
            </div>
            <a href="/etudiant/logout" style="color: rgba(255,255,255,0.7); background: rgba(255,255,255,0.1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                <i class="ph ph-sign-out" style="font-size: 1.25rem;"></i>
            </a>
        </div>
    </div>

    <div class="content-container">
        <!-- Statut d'inscription -->
        <div class="info-card" style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <p style="color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem;">Statut Inscription</p>
                <p style="font-weight: 600; font-size: 1rem; color: var(--text-main);"><?= htmlspecialchars($etudiant['annee_scolaire'] ?? '') ?></p>
            </div>
            <?php if ($etudiant['statut'] === 'inscrit'): ?>
                <div style="background: #dcfce7; color: #166534; padding: 0.5rem 1rem; border-radius: 20px; display: flex; align-items: center; gap: 0.4rem; font-weight: 600;">
                    <i class="ph-fill ph-check-circle"></i> Validé
                </div>
            <?php else: ?>
                <div style="background: #fef3c7; color: #b45309; padding: 0.5rem 1rem; border-radius: 20px; display: flex; align-items: center; gap: 0.4rem; font-weight: 600;">
                    <i class="ph-fill ph-clock"></i> <?= htmlspecialchars(ucfirst($etudiant['statut'] ?? 'En attente')) ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Emploi du temps -->
        <h3 style="font-family: 'Outfit'; font-size: 1.1rem; margin: 1.5rem 0 1rem; color: var(--text-main); display: flex; align-items: center; gap: 0.4rem;">
            <i class="ph-fill ph-calendar-check" style="color: var(--epi-blue);"></i> Mon Emploi du Temps
        </h3>

        <?php if (!empty($plannings)): ?>
            <?php foreach ($plannings as $p): ?>
                <div class="planning-item">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                        <strong style="color: var(--epi-blue);"><?= htmlspecialchars($p['matiere_nom']) ?></strong>
                        <span style="font-size: 0.85rem; color: var(--epi-gold); font-weight: 600; background: var(--epi-gold-light); padding: 0.2rem 0.6rem; border-radius: 6px;">
                            <?= date('H:i', strtotime($p['heure_debut'])) ?> - <?= date('H:i', strtotime($p['heure_fin'])) ?>
                        </span>
                    </div>
                    <div style="display: flex; gap: 1rem; font-size: 0.85rem; color: var(--text-muted);">
                        <span><i class="ph ph-calendar"></i> <?= date('d/m/Y', strtotime($p['date_cours'])) ?></span>
                        <span><i class="ph ph-door"></i> <?= htmlspecialchars($p['salle_nom']) ?></span>
                        <span><i class="ph ph-chalkboard-teacher"></i> Prof. <?= htmlspecialchars($p['prof_nom']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="info-card" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                <i class="ph ph-calendar-x" style="font-size: 3rem; opacity: 0.4; display: block; margin-bottom: 0.75rem;"></i>
                <p>Aucun cours planifié pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
