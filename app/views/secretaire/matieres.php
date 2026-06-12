<?php
$admin_pseudo = $admin_pseudo ?? 'Secrétaire';
$matieres_groupees = $matieres_groupees ?? [];
$filieres = $filieres ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Gestion des Matières</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/roles/secretaire.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Gestion des Matières</h1>
                    <p>Ajoutez et organisez les matières par filière.</p>
                </div>
            </header>

            <?php if (isset($_SESSION['snackbar'])): ?>
                <div style="background:#dcfce7;border-left:4px solid #16a34a;color:#166534;padding:1rem;border-radius:var(--radius-md);margin-bottom:1.5rem;">
                    <?= $_SESSION['snackbar'] ?>
                </div>
                <?php unset($_SESSION['snackbar']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['snackbar_error'])): ?>
                <div style="background:#fee2e2;border-left:4px solid #dc2626;color:#991b1b;padding:1rem;border-radius:var(--radius-md);margin-bottom:1.5rem;">
                    <?= $_SESSION['snackbar_error'] ?>
                </div>
                <?php unset($_SESSION['snackbar_error']); ?>
            <?php endif; ?>

            <div class="grid-2">
                <!-- FORMULAIRE AJOUT MATIERE -->
                <div class="detail-card">
                    <div class="detail-header">
                        <h3 style="font-family:'Outfit';font-size:1.1rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="ph-fill ph-book-open" style="color:var(--epi-blue);"></i> Ajouter une Matière
                        </h3>
                    </div>
                    <form action="/matieres/create" method="POST">
                        <div class="form-group">
                            <label>Filière <span style="color:#e00">*</span></label>
                            <select name="filiere_id" required>
                                <option value="">-- Sélectionner une filière --</option>
                                <?php foreach ($filieres as $f): ?>
                                    <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?> (<?= htmlspecialchars($f['code']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nom de la matière <span style="color:#e00">*</span></label>
                            <input type="text" name="nom" required placeholder="Ex: Mathématiques, Programmation Web...">
                        </div>
                        <div class="grid-2" style="gap:1rem;">
                            <div class="form-group">
                                <label>Volume Horaire <span style="color:#e00">*</span></label>
                                <input type="number" name="volume_horaire" required value="20" min="1">
                            </div>
                            <div class="form-group">
                                <label>Coefficient <span style="color:#e00">*</span></label>
                                <input type="number" name="coefficient" required value="1" min="1">
                            </div>
                        </div>
                        <button type="submit" class="btn" style="width:100%;margin-top:1rem;">
                            <i class="ph ph-plus-circle"></i> Enregistrer la matière
                        </button>
                    </form>
                </div>

                <!-- LISTE DES MATIERES PAR FILIERE -->
                <div class="detail-card">
                    <div class="detail-header">
                        <h3 style="font-family:'Outfit';font-size:1.1rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="ph-fill ph-list-dashes" style="color:var(--text-main);"></i> Matières Existantes
                        </h3>
                    </div>
                    
                    <div class="table-container" style="max-height:500px;overflow-y:auto;box-shadow:none;">
                        <?php if (empty($matieres_groupees)): ?>
                            <div style="text-align:center;padding:1.5rem;color:var(--text-muted);">
                                Aucune matière enregistrée.
                            </div>
                        <?php else: ?>
                            <?php foreach ($matieres_groupees as $filiere_nom => $data): ?>
                                <h4 style="background:#f8fafc;padding:0.75rem 1rem;font-size:0.95rem;color:var(--epi-blue);border-top:1px solid var(--border-color);border-bottom:1px solid var(--border-color);margin:0;">
                                    <?= htmlspecialchars($filiere_nom) ?>
                                </h4>
                                <table>
                                    <tbody>
                                        <?php foreach ($data['matieres'] as $m): ?>
                                            <tr>
                                                <td style="font-weight:500;font-size:0.9rem;"><?= htmlspecialchars($m['nom']) ?></td>
                                                <td style="font-size:0.8rem;color:var(--text-muted);"><i class="ph ph-clock"></i> <?= $m['volume_horaire'] ?>h</td>
                                                <td style="font-size:0.8rem;color:var(--text-muted);">Coef: <strong><?= $m['coefficient'] ?></strong></td>
                                                <td style="text-align:right;">
                                                    <form action="/matieres/delete" method="POST" style="margin:0;" onsubmit="return confirm('Supprimer cette matière ?');">
                                                        <input type="hidden" name="id" value="<?= $m['id'] ?>">
                                                        <input type="hidden" name="filiere_id" value="<?= $data['filiere_id'] ?>">
                                                        <button type="submit" style="background:none;border:none;color:#dc2626;cursor:pointer;" title="Supprimer">
                                                            <i class="ph ph-trash" style="font-size:1.1rem;"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
