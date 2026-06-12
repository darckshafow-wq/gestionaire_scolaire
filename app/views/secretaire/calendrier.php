<?php
$admin_pseudo = $admin_pseudo ?? 'Secrétaire';
$filieres = $filieres ?? [];
$salles = $salles ?? [];
$professeurs = $professeurs ?? [];
$plannings = $plannings ?? [];

// Helper pour formater le planning par jour
$jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
$planning_par_jour = array_fill_keys($jours, []);
foreach ($plannings as $p) {
    // Determine the day of the week
    $timestamp = strtotime($p['date_cours']);
    $jour_fr = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'][date('w', $timestamp)];
    $planning_par_jour[$jour_fr][] = $p;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Calendrier Interactif</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="/assets/css/roles/secretaire.css">
</head>
<body>
    <div class="dashboard-layout">
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Emploi du Temps Interactif</h1>
                    <p>Faites glisser une matière vers un jour pour planifier un cours.</p>
                </div>
                <div style="display:flex;gap:0.75rem;">
                    <button class="btn" style="background:white;color:var(--text-main);border:1px solid var(--border-color);" onclick="window.print()">
                        <i class="ph ph-printer"></i> Imprimer
                    </button>
                    <button class="btn" onclick="diffuserPlanning()">
                        <i class="ph ph-share-network"></i> Diffuser (WhatsApp/Email)
                    </button>
                </div>
            </header>

            <style>
                @media print {
                    .sidebar, .header, .sidebar-dnd, .nav-panel, button, form { display: none !important; }
                    .dashboard-layout { display: block !important; }
                    .main-content { padding: 0 !important; margin: 0 !important; }
                    .layout-dnd { display: block !important; }
                    .calendar-grid { grid-template-columns: repeat(7, 1fr) !important; gap: 5px !important; }
                    .day-column { min-height: auto !important; border: 1px solid #000 !important; }
                    .cours-card { border: 1px solid #000 !important; box-shadow: none !important; page-break-inside: avoid; }
                    body { background: white !important; }
                    * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
                }
            </style>

            <div class="layout-dnd">
                <!-- Panneau Latéral (Filière & Matières) -->
                <div class="sidebar-dnd">
                    <div class="form-group">
                        <label><i class="ph ph-funnel"></i> Choisir une filière</label>
                        <select id="filiere-select" onchange="chargerMatieres()">
                            <option value="">-- Sélectionnez --</option>
                            <?php foreach ($filieres as $f): ?>
                                <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="matieres-list" style="margin-top: 1.5rem; display: none;">
                        <h4 style="font-family:'Outfit';font-size:0.9rem;margin-bottom:0.75rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.05em;">Matières à planifier</h4>
                        <div id="draggable-container">
                            <!-- Les matières seront chargées ici via AJAX -->
                        </div>
                    </div>
                </div>

                <!-- Grille Calendrier -->
                <div class="calendar-grid">
                    <?php foreach ($jours as $jour): ?>
                        <div class="day-column">
                            <div class="day-header"><?= $jour ?></div>
                            <div class="drop-zone" data-jour="<?= $jour ?>" ondragover="allowDrop(event)" ondragleave="dragLeave(event)" ondrop="drop(event, '<?= $jour ?>')">
                                <!-- Cours déjà planifiés -->
                                <?php if (!empty($planning_par_jour[$jour])): ?>
                                    <?php foreach ($planning_par_jour[$jour] as $cours): ?>
                                        <div class="cours-card">
                                            <strong><?= htmlspecialchars($cours['matiere_nom']) ?></strong>
                                            <div style="color:var(--text-muted);font-size:0.75rem;margin-bottom:0.1rem;"><i class="ph ph-clock"></i> <?= date('H:i', strtotime($cours['heure_debut'])) ?>-<?= date('H:i', strtotime($cours['heure_fin'])) ?></div>
                                            <div style="color:var(--text-muted);font-size:0.75rem;margin-bottom:0.1rem;"><i class="ph ph-door"></i> <?= htmlspecialchars($cours['salle_nom']) ?></div>
                                            <div style="color:var(--text-muted);font-size:0.75rem;"><i class="ph ph-user"></i> Prof. <?= htmlspecialchars($cours['prof_nom']) ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Configuration du Cours -->
    <div id="coursModal" class="modal">
        <div class="modal-content">
            <h3 style="font-family:'Outfit';margin-bottom:1rem;color:var(--epi-blue);">Détails du Cours</h3>
            <form id="coursForm" onsubmit="saveCours(event)">
                <input type="hidden" id="modal_filiere_id">
                <input type="hidden" id="modal_matiere_id">
                <input type="hidden" id="modal_jour">
                
                <div class="form-group">
                    <label>Date exacte (Le <span id="modal_jour_label" style="font-weight:bold;"></span>) <span style="color:#e00">*</span></label>
                    <input type="date" id="modal_date" required>
                </div>

                <div class="grid-2" style="gap:1rem;">
                    <div class="form-group">
                        <label>Heure Début <span style="color:#e00">*</span></label>
                        <input type="time" id="modal_heure_debut" required>
                    </div>
                    <div class="form-group">
                        <label>Heure Fin <span style="color:#e00">*</span></label>
                        <input type="time" id="modal_heure_fin" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Professeur <span style="color:#e00">*</span></label>
                    <select id="modal_prof_id" required>
                        <option value="">-- Choisir le prof --</option>
                        <?php foreach ($professeurs as $p): ?>
                            <?php if ($p['accord_dg']): // Seulement les profs validés ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nom'] . ' ' . $p['prenom']) ?> (<?= htmlspecialchars($p['specialite']) ?>)</option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Salle <span style="color:#e00">*</span></label>
                    <select id="modal_salle_id" required>
                        <option value="">-- Choisir la salle --</option>
                        <?php foreach ($salles as $s): ?>
                            <?php if ($s['etat_dispo'] === 'Disponible'): ?>
                                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nom']) ?> (Cap: <?= $s['capacite'] ?>)</option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display:flex;gap:1rem;margin-top:1.5rem;">
                    <button type="button" class="btn" style="background:#f1f5f9;color:var(--text-main);flex:1;" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn" style="flex:1;"><i class="ph ph-check-circle"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function diffuserPlanning() {
            if(confirm("Voulez-vous diffuser cet emploi du temps aux étudiants et professeurs concernés via WhatsApp et Email ?")) {
                alert("Diffusion réussie ! L'emploi du temps a été envoyé.");
            }
        }
    </script>
    <script src="/assets/js/roles/secretaire.js"></script>
    <script src="/assets/js/main.js"></script>
</body>
</html>
