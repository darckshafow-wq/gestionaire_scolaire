<?php
/**
 * VUE : Gestion des Filières avec Formulaire en Popup (Modal)
 * Fichier : app/views/filieres/index.php
 */
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
    <style>
        /* Styles spécifiques pour le Popup / Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6); /* Fond sombre flouté ou transparent */
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-container {
            background: #ffffff;
            width: 100%;
            max-width: 650px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-20px);
            transition: transform 0.25s ease;
            overflow: hidden;
        }

        .modal-overlay.show .modal-container {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .btn-close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .btn-close-modal:hover {
            color: #ef4444;
        }

        /* Bouton Ajouter principal */
        .btn-add-trigger {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--epi-blue, #0284c7);
            color: #fff;
            padding: 0.65rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-add-trigger:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
<div class="dashboard-layout">

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo" id="sidebar-logo-toggle">
            <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
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

    <main class="main-content">
        <header class="header">
            <div class="greeting">
                <h1>Gestion des Filières</h1>
                <p>Visualisez et gérez les différentes filières métiers de l'établissement.</p>
            </div>
        </header>

        <div class="section-title" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <div>
                <i class="ph-fill ph-books" style="color:var(--epi-blue);margin-right:0.4rem;"></i>
                Liste des filières
                <span style="font-size:0.85rem;font-weight:400;color:var(--text-muted);margin-left:0.75rem;"><?= count($filieres) ?> filière(s)</span>
            </div>
            <button class="btn-add-trigger" id="openModalBtn">
                <i class="ph-bold ph-plus"></i> Nouvelle Filière
            </button>
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

<div class="modal-overlay" id="filiereModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 style="font-family:'Outfit';font-size:1.1rem;margin:0;display:flex;align-items:center;gap:0.5rem;color:var(--text-main);">
                <i class="ph-fill ph-plus-circle" style="color:var(--epi-blue);"></i> Ajouter une nouvelle filière
            </h3>
            <button class="btn-close-modal" id="closeModalBtn">&times;</button>
        </div>
        <div class="modal-body">
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
                        <textarea name="description" rows="3" placeholder="Présentation courte de la filière..." style="width:100%;padding:1rem 1.25rem;border:2px solid var(--border-color);border-radius:var(--radius-md);font-family:inherit;font-size:0.95rem;resize:vertical;outline:none;background:#f8fafc;transition:border-color 0.2s;"></textarea>
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
                <div style="display:flex;justify-content:flex-end;margin-top:1.5rem;gap:0.75rem;">
                    <button type="button" class="btn" id="cancelModalBtn" style="background:#e2e8f0;color:#475569;border:none;">Annuler</button>
                    <button type="submit" class="btn" id="btn-add-filiere" style="background:var(--epi-blue);"><i class="ph ph-plus"></i> Créer la filière</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['snackbar'])): ?>
    <div id="snackbar" class="snackbar show">
        <i class="ph-bold ph-check-circle" style="font-size:1.2rem;margin-right:0.5rem;"></i>
        <?= htmlspecialchars($_SESSION['snackbar']) ?>
    </div>
    <?php unset($_SESSION['snackbar']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['snackbar_error'])): ?>
    <div id="snackbar" class="snackbar show" style="background:#ef4444;">
        <i class="ph-bold ph-warning-circle" style="font-size:1.2rem;margin-right:0.5rem;"></i>
        <?= htmlspecialchars($_SESSION['snackbar_error']) ?>
    </div>
    <?php unset($_SESSION['snackbar_error']); ?>
<?php endif; ?>

<script src="/assets/js/main.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('filiereModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelModalBtn');

        // Fonction pour ouvrir le Popup
        function openModal() {
            modal.classList.add('show');
        }

        // Fonction pour fermer le Popup
        function closeModal() {
            modal.classList.remove('show');
        }

        // Événements de clic
        openBtn.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        // Fermer le popup si l'utilisateur clique en dehors de la boîte blanche
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>
</body>
</html>