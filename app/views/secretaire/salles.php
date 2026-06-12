<?php
$admin_pseudo = $admin_pseudo ?? 'Secrétaire';
$salles = $salles ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Gestion des Salles</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Gestion des Salles</h1>
                    <p>Enregistrez et gérez les salles de cours de l'établissement.</p>
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
                <!-- FORMULAIRE -->
                <div class="detail-card">
                    <div class="detail-header">
                        <h3 style="font-family:'Outfit';font-size:1.1rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="ph-fill ph-door" style="color:var(--epi-blue);"></i> Ajouter une Salle
                        </h3>
                    </div>
                    <form action="/salles/create" method="POST">
                        <div class="form-group">
                            <label>Nom de la salle <span style="color:#e00">*</span></label>
                            <input type="text" name="nom" required placeholder="Ex: Amphi A, Salle 101">
                        </div>
                        <div class="form-group">
                            <label>Capacité (Places) <span style="color:#e00">*</span></label>
                            <input type="number" name="capacite" required value="30" min="1">
                        </div>
                        <div class="form-group">
                            <label>État par défaut</label>
                            <select name="etat_dispo" required>
                                <option value="Disponible">Disponible (Fonctionnelle)</option>
                                <option value="Indisponible">Indisponible (Réservée/Autre)</option>
                                <option value="En maintenance">En maintenance (Défaut)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn" style="width:100%;margin-top:1rem;">
                            <i class="ph ph-plus-circle"></i> Enregistrer
                        </button>
                    </form>
                </div>

                <!-- LISTE DES SALLES -->
                <div class="detail-card">
                    <div class="detail-header">
                        <h3 style="font-family:'Outfit';font-size:1.1rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="ph-fill ph-list-dashes" style="color:var(--text-main);"></i> Liste des Salles
                        </h3>
                    </div>
                    
                    <div class="table-container" style="max-height:500px;overflow-y:auto;box-shadow:none;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Salle</th>
                                    <th>Capacité</th>
                                    <th>État</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($salles)): ?>
                                    <?php foreach ($salles as $s): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($s['nom']) ?></strong></td>
                                            <td><?= $s['capacite'] ?> places</td>
                                            <td>
                                                <form action="/salles/update_etat" method="POST" style="margin:0;">
                                                    <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                                    <select name="etat_dispo" onchange="this.form.submit()" style="padding:0.25rem;border-radius:4px;font-size:0.85rem;border:1px solid #ddd;background:<?= $s['etat_dispo'] === 'Disponible' ? '#dcfce7' : ($s['etat_dispo'] === 'En maintenance' ? '#fee2e2' : '#fef3c7') ?>;">
                                                        <option value="Disponible" <?= $s['etat_dispo'] === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                                                        <option value="Indisponible" <?= $s['etat_dispo'] === 'Indisponible' ? 'selected' : '' ?>>Indisponible</option>
                                                        <option value="En maintenance" <?= $s['etat_dispo'] === 'En maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="/salles/delete" method="POST" style="margin:0;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette salle ?');">
                                                    <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                                    <button type="submit" style="background:none;border:none;color:#dc2626;cursor:pointer;" title="Supprimer">
                                                        <i class="ph ph-trash" style="font-size:1.25rem;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" style="text-align:center;padding:1.5rem;color:var(--text-muted);">
                                            Aucune salle enregistrée.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
