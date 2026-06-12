<?php
$prof_nom       = $prof_nom ?? 'Professeur';
$specialite     = $specialite ?? '';
$mes_cours      = $mes_cours ?? [];
$filieres       = $filieres ?? [];
$prochain_cours = $prochain_cours ?? null;

$jours_fr = ['Sun' => 'Dim', 'Mon' => 'Lun', 'Tue' => 'Mar', 'Wed' => 'Mer', 'Thu' => 'Jeu', 'Fri' => 'Ven', 'Sat' => 'Sam'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT – Espace Professeur</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/roles/professeur.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
<div class="dashboard-layout">

    <!-- COLONNE 1 : Sidebar principale EPI -->
    <?php include ROOT_PATH . '/app/views/professeur/sidebar.php'; ?>

    <main class="main-content">
        <header class="header" style="margin-bottom: 2rem;">
            <div class="greeting">
                <h1>Espace Professeur</h1>
                <p>Consultez votre emploi du temps et vos filières assignées.</p>
            </div>
        </header>

        <!-- Navigation par onglets (Horizontale) -->
        <nav class="horizontal-tabs">
            <a onclick="switchTab('planning', this)" class="tab-link active">
                <i class="ph ph-calendar-check" style="font-size:1.2rem;"></i>
                Emploi du temps
            </a>
            <a onclick="switchTab('filieres', this)" class="tab-link">
                <i class="ph ph-books" style="font-size:1.2rem;"></i>
                Mes Filières
                <?php if (!empty($filieres)): ?>
                    <span class="tab-badge" style="background:#dbeafe;color:var(--epi-blue);padding:0.15rem 0.5rem;border-radius:20px;font-size:0.75rem;font-weight:700;margin-left:0.5rem;"><?= count($filieres) ?></span>
                <?php endif; ?>
            </a>
        </nav>

        <!-- Prochain cours -->
        <?php if ($prochain_cours): ?>
        <div class="next-banner">
            <div>
                <p style="opacity:.8;font-size:.8rem;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.3rem;">
                    <i class="ph ph-alarm"></i> Prochain cours
                </p>
                <h2 style="font-family:'Outfit';font-size:1.4rem;margin-bottom:.2rem;"><?= htmlspecialchars($prochain_cours['matiere_nom']) ?></h2>
                <p style="opacity:.9;font-size:.9rem;">
                    <?= htmlspecialchars($prochain_cours['filiere_nom']) ?> ·
                    <?= date('d/m/Y', strtotime($prochain_cours['date_cours'])) ?> ·
                    <?= date('H:i', strtotime($prochain_cours['heure_debut'])) ?>–<?= date('H:i', strtotime($prochain_cours['heure_fin'])) ?>
                </p>
            </div>
            <div style="background:rgba(255,255,255,.2);padding:.65rem 1.25rem;border-radius:var(--radius-lg);font-size:.88rem;font-weight:600;white-space:nowrap;">
                <i class="ph ph-door"></i> <?= htmlspecialchars($prochain_cours['salle_nom']) ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon" style="background:var(--epi-blue-light);color:var(--epi-blue);width:50px;height:50px;display:flex;align-items:center;justify-content:center;border-radius:12px;font-size:1.5rem;"><i class="ph ph-calendar-dots"></i></div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;font-family:'Outfit';color:var(--epi-blue);"><?= count($mes_cours) ?></div>
                    <div style="font-size:.82rem;color:var(--text-muted);">Séances planifiées</div>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon" style="background:#fef3c7;color:#b45309;width:50px;height:50px;display:flex;align-items:center;justify-content:center;border-radius:12px;font-size:1.5rem;"><i class="ph ph-books"></i></div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;font-family:'Outfit';color:var(--epi-gold);"><?= count($filieres) ?></div>
                    <div style="font-size:.82rem;color:var(--text-muted);">Filière<?= count($filieres) > 1 ? 's' : '' ?> enseignée<?= count($filieres) > 1 ? 's' : '' ?></div>
                </div>
            </div>
        </div>

        <!-- ===== Onglet : Emploi du temps ===== -->
        <div id="tab-planning" class="tab-panel active">
            <div class="section-heading">
                <i class="ph-fill ph-calendar-check" style="color:var(--epi-blue);"></i>
                Mon Emploi du Temps
            </div>

            <?php if (empty($mes_cours)): ?>
                <div class="empty-state">
                    <i class="ph ph-calendar-x"></i>
                    <p>Aucun cours planifié</p>
                    <small>Vous n'avez pas de cours prévus pour le moment.</small>
                </div>
            <?php else: ?>
                <?php
                // Grouper les cours par date
                $cours_par_date = [];
                foreach ($mes_cours as $c) {
                    $cours_par_date[$c['date_cours']][] = $c;
                }
                ksort($cours_par_date);
                ?>

                <?php foreach ($cours_par_date as $date => $cours_jour): ?>
                    <?php
                        $ts = strtotime($date);
                        $jour_lettres = $jours_fr[date('D', $ts)];
                        $jour_chiffre = date('d', $ts);
                        $mois = date('m', $ts);
                    ?>
                    <div style="margin-bottom: 2rem;">
                        <h4 style="font-family:'Outfit';font-size:1.05rem;color:var(--text-main);margin-bottom:0.75rem;display:flex;align-items:center;gap:0.5rem;padding-bottom:0.4rem;border-bottom:1px solid var(--border-color);">
                            <span style="background:var(--epi-blue);color:white;padding:0.2rem 0.5rem;border-radius:6px;font-size:0.85rem;"><?= $jour_lettres ?> <?= $jour_chiffre ?>/<?= $mois ?></span>
                        </h4>
                        
                        <?php foreach ($cours_jour as $c): ?>
                            <div class="cours-card">
                                <div class="info">
                                    <strong><?= htmlspecialchars($c['matiere_nom']) ?></strong>
                                    <span><?= htmlspecialchars($c['filiere_nom']) ?> — <i class="ph-fill ph-door"></i> <?= htmlspecialchars($c['salle_nom']) ?></span>
                                </div>
                                <div class="timing">
                                    <div class="hours"><?= date('H:i', strtotime($c['heure_debut'])) ?> - <?= date('H:i', strtotime($c['heure_fin'])) ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ===== Onglet : Filières ===== -->
        <div id="tab-filieres" class="tab-panel">
            <div class="section-heading">
                <i class="ph-fill ph-books" style="color:var(--text-main);"></i>
                Filières enseignées
            </div>

            <?php if (empty($filieres)): ?>
                <div class="empty-state">
                    <i class="ph ph-folder-dashed"></i>
                    <p>Aucune filière assignée</p>
                    <small>Vous n'êtes assigné à aucune filière pour l'instant.</small>
                </div>
            <?php else: ?>
                <div class="grid-3" style="gap:1rem;">
                    <?php foreach ($filieres as $f): ?>
                        <div style="border:1px solid var(--border-color);border-radius:var(--radius-md);padding:1.25rem;background:white;transition:transform .2s;">
                            <div style="font-family:'Outfit';font-weight:700;font-size:1.1rem;margin-bottom:.3rem;color:var(--epi-blue);">
                                <?= htmlspecialchars($f['code']) ?>
                            </div>
                            <div style="font-weight:500;font-size:.9rem;color:var(--text-main);margin-bottom:.5rem;">
                                <?= htmlspecialchars($f['nom']) ?>
                            </div>
                            <div style="font-size:.8rem;color:var(--text-muted);">
                                <?= htmlspecialchars($f['niveau']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </main>
</div>

<script src="/assets/js/roles/professeur.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
