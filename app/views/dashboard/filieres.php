<?php
$admin_pseudo = $admin_pseudo ?? 'Admin';
$filieres     = $filieres ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro – Filières</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
<div class="dashboard-layout">

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo" id="sidebar-logo-toggle">
            <img src="/assets/images/logo_epi.svg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
            <span class="brand-font">EPI Gest</span>
        </div>

        <div class="sidebar-section-title">Main</div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="/dashboard" class="nav-link" title="Vue d'ensemble"><i class="ph ph-house" style="font-size:1.25rem;"></i><span>Vue d'ensemble</span></a></li>
            <li class="nav-item"><a href="/etudiants" class="nav-link" title="Registre Étudiants"><i class="ph ph-users" style="font-size:1.25rem;"></i><span>Registre Étudiants</span></a></li>
            <li class="nav-item"><a href="/inscriptions" class="nav-link" title="Inscriptions"><i class="ph ph-file-text" style="font-size:1.25rem;"></i><span>Inscriptions</span></a></li>
            <li class="nav-item"><a href="/filieres" class="nav-link active" title="Filières"><i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières</span></a></li>
            <li class="nav-item"><a href="/calendrier" class="nav-link" title="Calendrier"><i class="ph ph-calendar-blank" style="font-size:1.25rem;"></i><span>Calendrier</span></a></li>
        </ul>

        <div class="sidebar-section-title">Système</div>
        <ul class="nav-menu" style="flex:0;">
            <li class="nav-item"><a href="/parametres" class="nav-link" title="Paramètres"><i class="ph ph-gear" style="font-size:1.25rem;"></i><span>Paramètres</span></a></li>
            <li class="nav-item"><a href="/logout" class="nav-link nav-link-danger" title="Déconnexion"><i class="ph ph-sign-out" style="font-size:1.25rem;"></i><span>Déconnexion</span></a></li>
        </ul>

        <div class="sidebar-profile">
            <div class="avatar" style="width:36px;height:36px;font-size:0.9rem;"><?= strtoupper(substr($admin_pseudo, 0, 1)) ?></div>
            <div class="profile-info">
                <span class="profile-name"><?= htmlspecialchars($admin_pseudo) ?></span>
                <span class="profile-role">Administrateur</span>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
        <header class="header">
            <div class="greeting">
                <h1>Gestion des Filières</h1>
                <p>Créez, modifiez et gérez les filières de l'établissement.</p>
            </div>
        </header>

        <!-- ===== ADD FILIERE CARD ===== -->
        <div class="detail-card" style="margin-bottom:2.5rem;">
            <h3 style="font-family:'Outfit';font-size:1.1rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:0.5rem;color:var(--text-main);">
                <i class="ph-fill ph-plus-circle" style="color:var(--epi-blue);"></i> Ajouter une nouvelle filière
            </h3>
            <form action="/filieres/create" method="POST">
                <div class="grid-3">
                    <div class="form-group">
                        <label>Code <span style="color:#e00">*</span></label>
                        <input type="text" name="code" required placeholder="Ex: INFO" maxlength="20" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group" style="grid-column:span 2;">
                        <label>Nom de la filière <span style="color:#e00">*</span></label>
                        <input type="text" name="nom" required placeholder="Ex: Informatique et Réseaux">
                    </div>
                    <div class="form-group" style="grid-column:span 3;">
                        <label>Description</label>
                        <textarea name="description" rows="2" placeholder="Présentation courte de la filière..." style="width:100%;padding:1rem 1.25rem;border:2px solid var(--border-color);border-radius:var(--radius-md);font-family:inherit;font-size:0.95rem;resize:vertical;outline:none;background:#f8fafc;transition:border-color 0.2s;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Durée (années)</label>
                        <select name="duree_annees">
                            <option value="2">2 ans</option>
                            <option value="3" selected>3 ans</option>
                            <option value="4">4 ans</option>
                            <option value="5">5 ans</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Niveau</label>
                        <select name="niveau">
                            <option value="Licence">Licence</option>
                            <option value="Master">Master</option>
                            <option value="BTS">BTS</option>
                            <option value="DUT">DUT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;margin-top:0.5rem;">
                    <button type="submit" class="btn" id="btn-add-filiere"><i class="ph ph-plus"></i> Créer la filière</button>
                </div>
            </form>
        </div>

        <!-- ===== FILIERES TABLE ===== -->
        <div class="section-title">
            <div>
                <i class="ph-fill ph-books" style="color:var(--epi-blue);margin-right:0.4rem;"></i>
                Liste des filières
                <span style="font-size:0.85rem;font-weight:400;color:var(--text-muted);margin-left:0.75rem;"><?= count($filieres) ?> filière(s)</span>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Nom de la filière</th>
                        <th>Niveau</th>
                        <th>Durée</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($filieres) > 0): ?>
                        <?php foreach ($filieres as $f): ?>
                            <tr>
                                <td>
                                    <span style="font-family:'Outfit';font-weight:700;font-size:0.85rem;background:var(--epi-blue-light);color:var(--epi-blue);padding:0.25rem 0.65rem;border-radius:6px;">
                                        <?= htmlspecialchars($f['code']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight:500;"><?= htmlspecialchars($f['nom']) ?></span>
                                    <?php if (!empty($f['description'])): ?>
                                        <p style="font-size:0.78rem;color:var(--text-muted);margin-top:0.2rem;"><?= htmlspecialchars(mb_strimwidth($f['description'], 0, 70, '…')) ?></p>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-blue"><?= htmlspecialchars($f['niveau']) ?></span></td>
                                <td style="color:var(--text-muted);"><?= $f['duree_annees'] ?> ans</td>
                                <td>
                                    <?php if ($f['statut'] === 'Active'): ?>
                                        <span class="badge badge-green">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-red">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="display:flex;gap:0.5rem;align-items:center;">
                                        <a href="/filiere_detail?id=<?= $f['id'] ?>"
                                           style="color:var(--epi-blue);font-weight:500;display:inline-flex;align-items:center;gap:0.25rem;padding:0.35rem 0.75rem;border-radius:6px;background:var(--epi-blue-light);font-size:0.85rem;transition:background 0.2s;">
                                            <i class="ph ph-pencil"></i> Modifier
                                        </a>
                                        <form action="/filiere_delete" method="POST" onsubmit="return confirm('Supprimer la filière «<?= htmlspecialchars($f['nom']) ?>» ?');" style="margin:0;">
                                            <input type="hidden" name="id" value="<?= $f['id'] ?>">
                                            <button type="submit" style="color:#dc2626;background:#fee2e2;border:none;cursor:pointer;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.85rem;display:inline-flex;align-items:center;gap:0.25rem;transition:background 0.2s;">
                                                <i class="ph ph-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;padding:3rem;color:var(--text-muted);">
                                <i class="ph ph-folder-open" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.5;"></i>
                                Aucune filière enregistrée.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Snackbar succès -->
<?php if (isset($_SESSION['snackbar'])): ?>
    <div id="snackbar" class="snackbar show">
        <i class="ph-bold ph-check-circle" style="font-size:1.2rem;margin-right:0.5rem;"></i>
        <?= htmlspecialchars($_SESSION['snackbar']) ?>
    </div>
    <?php unset($_SESSION['snackbar']); ?>
<?php endif; ?>

<!-- Snackbar erreur -->
<?php if (isset($_SESSION['snackbar_error'])): ?>
    <div id="snackbar" class="snackbar show" style="background:#ef4444;">
        <i class="ph-bold ph-warning-circle" style="font-size:1.2rem;margin-right:0.5rem;"></i>
        <?= htmlspecialchars($_SESSION['snackbar_error']) ?>
    </div>
    <?php unset($_SESSION['snackbar_error']); ?>
<?php endif; ?>

<script src="/assets/js/main.js"></script>
</body>
</html>
