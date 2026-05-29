<?php
$admin_pseudo = $admin_pseudo ?? 'Admin';
$filiere      = $filiere ?? [];
$error        = $error ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro – Modifier une filière</title>
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
            <div class="header-left">
                <a href="/filieres" style="display:inline-flex;align-items:center;gap:0.4rem;color:var(--text-muted);font-size:0.9rem;padding:0.5rem 1rem;border:1px solid var(--border-color);border-radius:var(--radius-md);background:white;transition:all 0.2s;" onmouseover="this.style.borderColor='var(--epi-blue)';this.style.color='var(--epi-blue)';" onmouseout="this.style.borderColor='var(--border-color)';this.style.color='var(--text-muted)';">
                    <i class="ph ph-arrow-left"></i> Retour aux filières
                </a>
                <div class="greeting">
                    <h1>Modifier la filière</h1>
                    <p>Mettez à jour les informations de <strong><?= htmlspecialchars($filiere['nom'] ?? '') ?></strong></p>
                </div>
            </div>
        </header>

        <!-- Bannière info filière -->
        <div style="background:linear-gradient(135deg,var(--epi-blue),#1e40af);border-radius:var(--radius-lg);padding:1.75rem 2rem;margin-bottom:2rem;color:white;display:flex;align-items:center;gap:1.5rem;">
            <div style="width:64px;height:64px;border-radius:16px;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;font-family:'Outfit';font-size:1.4rem;font-weight:800;letter-spacing:1px;flex-shrink:0;">
                <?= htmlspecialchars($filiere['code'] ?? '?') ?>
            </div>
            <div>
                <p style="opacity:0.7;font-size:0.8rem;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.2rem;">Filière ID #<?= $filiere['id'] ?? '' ?></p>
                <h2 style="font-family:'Outfit';font-size:1.5rem;margin:0;"><?= htmlspecialchars($filiere['nom'] ?? '') ?></h2>
                <p style="opacity:0.8;font-size:0.9rem;margin-top:0.25rem;"><?= $filiere['duree_annees'] ?? '' ?> ans · <?= htmlspecialchars($filiere['niveau'] ?? '') ?></p>
            </div>
            <div style="margin-left:auto;">
                <?php if (($filiere['statut'] ?? '') === 'Active'): ?>
                    <span style="background:rgba(255,255,255,0.2);padding:0.4rem 1rem;border-radius:20px;font-size:0.85rem;font-weight:600;">✅ Active</span>
                <?php else: ?>
                    <span style="background:rgba(255,0,0,0.2);padding:0.4rem 1rem;border-radius:20px;font-size:0.85rem;font-weight:600;">⏸ Inactive</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Formulaire modification -->
        <div class="detail-card">
            <div class="detail-header">
                <h3 style="font-family:'Outfit';font-size:1.1rem;display:flex;align-items:center;gap:0.5rem;">
                    <i class="ph-fill ph-pencil" style="color:var(--epi-blue);"></i> Modifier les informations
                </h3>
            </div>

            <?php if ($error): ?>
                <div style="background:#fee2e2;border-left:4px solid #ef4444;color:#b91c1c;padding:1rem;border-radius:var(--radius-md);margin-bottom:1.5rem;display:flex;align-items:center;gap:0.5rem;">
                    <i class="ph-fill ph-warning-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/filiere_detail?id=<?= $filiere['id'] ?>" method="POST">
                <div class="grid-3">
                    <div class="form-group">
                        <label>Code <span style="color:#e00">*</span></label>
                        <input type="text" name="code" required maxlength="20"
                               value="<?= htmlspecialchars($filiere['code'] ?? '') ?>"
                               style="text-transform:uppercase;font-weight:700;letter-spacing:2px;">
                    </div>
                    <div class="form-group" style="grid-column:span 2;">
                        <label>Nom de la filière <span style="color:#e00">*</span></label>
                        <input type="text" name="nom" required
                               value="<?= htmlspecialchars($filiere['nom'] ?? '') ?>">
                    </div>
                    <div class="form-group" style="grid-column:span 3;">
                        <label>Description</label>
                        <textarea name="description" rows="3"
                                  style="width:100%;padding:1rem 1.25rem;border:2px solid var(--border-color);border-radius:var(--radius-md);font-family:inherit;font-size:0.95rem;resize:vertical;outline:none;background:#f8fafc;transition:border-color 0.2s;"
                                  onfocus="this.style.borderColor='var(--epi-blue)'" onblur="this.style.borderColor='var(--border-color)'"><?= htmlspecialchars($filiere['description'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Durée (années)</label>
                        <select name="duree_annees">
                            <?php foreach ([2,3,4,5] as $d): ?>
                                <option value="<?= $d ?>" <?= ($filiere['duree_annees'] ?? 3) == $d ? 'selected' : '' ?>><?= $d ?> ans</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Niveau</label>
                        <select name="niveau">
                            <?php foreach (['Licence','Master','BTS','DUT'] as $niv): ?>
                                <option value="<?= $niv ?>" <?= ($filiere['niveau'] ?? '') === $niv ? 'selected' : '' ?>><?= $niv ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut">
                            <option value="Active"   <?= ($filiere['statut'] ?? '') === 'Active'   ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= ($filiere['statut'] ?? '') === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <div style="height:1px;background:var(--border-color);margin:1.5rem 0;"></div>

                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <!-- Supprimer -->
                    <form action="/filiere_delete" method="POST" onsubmit="return confirm('Supprimer définitivement cette filière ?');">
                        <input type="hidden" name="id" value="<?= $filiere['id'] ?>">
                        <button type="submit" style="background:#fee2e2;color:#dc2626;border:none;cursor:pointer;padding:0.75rem 1.25rem;border-radius:var(--radius-md);font-size:0.9rem;display:inline-flex;align-items:center;gap:0.4rem;transition:background 0.2s;font-weight:500;">
                            <i class="ph ph-trash"></i> Supprimer cette filière
                        </button>
                    </form>
                    <!-- Sauvegarder -->
                    <div style="display:flex;gap:1rem;">
                        <a href="/filieres" class="btn-light" style="padding:0.75rem 1.25rem;border-radius:var(--radius-md);display:inline-flex;align-items:center;gap:0.4rem;">Annuler</a>
                        <button type="submit" class="btn" id="btn-save-filiere"><i class="ph ph-floppy-disk"></i> Enregistrer les modifications</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Infos système -->
        <div class="detail-card" style="margin-top:1.5rem;">
            <h3 style="font-family:'Outfit';font-size:1rem;margin-bottom:1rem;color:var(--text-muted);display:flex;align-items:center;gap:0.5rem;">
                <i class="ph ph-clock"></i> Informations système
            </h3>
            <div class="grid-2">
                <div class="info-group">
                    <div class="info-label">Date de création</div>
                    <div class="info-value"><?= isset($filiere['created_at']) ? date('d/m/Y H:i', strtotime($filiere['created_at'])) : '—' ?></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Dernière modification</div>
                    <div class="info-value"><?= isset($filiere['updated_at']) ? date('d/m/Y H:i', strtotime($filiere['updated_at'])) : '—' ?></div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php if (isset($_SESSION['snackbar'])): ?>
    <div id="snackbar" class="snackbar show">
        <i class="ph-bold ph-check-circle" style="font-size:1.2rem;margin-right:0.5rem;"></i>
        <?= htmlspecialchars($_SESSION['snackbar']) ?>
    </div>
    <?php unset($_SESSION['snackbar']); ?>
<?php endif; ?>

<script src="/assets/js/main.js"></script>
</body>
</html>
