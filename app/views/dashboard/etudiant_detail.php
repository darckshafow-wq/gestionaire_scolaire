<?php
/**
 * VUE : Détails de l'Étudiant avec Formulaire de Modification en Popup
 * Fichier : app/views/dashboard/etudiant_detail.php
 */
$admin_pseudo = $admin_pseudo ?? 'Admin';
$etudiant     = $etudiant ?? null;

// Sécurité : redirection si aucune donnée étudiant n'est reçue
if (!$etudiant) {
    header('Location: /etudiants');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Détails de <?= htmlspecialchars($etudiant['nom']) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* Styles pour l'intégration du Popup / Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
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
            max-width: 700px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-20px);
            transition: transform 0.25s ease;
            overflow-y: auto;
            max-height: 90vh;
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

        .btn-light {
            background: #f1f5f9;
            color: #334155;
            border: 1px solid var(--border-color);
            cursor: pointer;
            font-weight: 500;
            transition: background 0.2s;
        }
        .btn-light:hover {
            background: #e2e8f0;
        }

        /* Style de la zone d'upload de fichier */
        .file-upload-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed var(--border-color);
            padding: 0.65rem;
            border-radius: var(--radius-md);
            background: #f8fafc;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            text-align: center;
        }
        .file-upload-wrapper:hover {
            background: #f1f5f9;
            border-color: var(--primary-color);
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="dashboard-layout">
        <!-- ===== SIDEBAR ===== -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo" id="sidebar-logo-toggle">
                <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                <span class="brand-font">EPI Gest</span>
            </div>

            <div class="sidebar-section-title">Main</div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link" title="Vue d'ensemble"><i class="ph ph-house" style="font-size:1.25rem;"></i><span>Vue d'ensemble</span></a></li>
                <li class="nav-item"><a href="/etudiants" class="nav-link active" title="Registre Étudiants"><i class="ph ph-users" style="font-size:1.25rem;"></i><span>Registre Étudiants</span></a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link" title="Inscriptions"><i class="ph ph-file-text" style="font-size:1.25rem;"></i><span>Inscriptions</span></a></li>
                <li class="nav-item"><a href="/filieres" class="nav-link" title="Filières"><i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières</span></a></li>
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
                    <h1>Profil de l'étudiant</h1>
                    <p>Fiche détaillée et actions rapides.</p>
                </div>
            </header>

            <div class="detail-card">
                <div style="display: flex; gap: 2.5rem; align-items: flex-start;">
                    <!-- MODIFICATION : Gestion dynamique de la Photo de profil de l'étudiant -->
                    <div style="width: 140px; height: 140px; border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm); border: 1px solid var(--border-color); flex-shrink: 0; overflow: hidden; background: linear-gradient(135deg, var(--primary-light), white);">
                        <?php if (!empty($etudiant['photo']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $etudiant['photo'])): ?>
                            <img src="<?= htmlspecialchars($etudiant['photo']) ?>" alt="Photo de <?= htmlspecialchars($etudiant['nom']) ?>" style="width:100%; height:100%; object-fit:cover;">
                        <?php else: ?>
                            <span style="font-size: 3.5rem; font-weight: bold; color: var(--primary-color);">
                                <?= strtoupper(substr($etudiant['nom'], 0, 1)) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                            <div>
                                <h2 style="font-size: 2.25rem; margin-bottom: 0.5rem; color: var(--text-main); line-height: 1.1;">
                                    <?= htmlspecialchars($etudiant['nom'] . ' ' . ($etudiant['prenom'] ?? '')) ?>
                                </h2>
                                
                                <?php if (trim($etudiant['statut'] ?? '') === 'Inscrit'): ?>
                                    <span class="badge" style="background:#dcfce7; color:#15803d; font-weight:600; padding:0.25rem 0.65rem; border-radius:6px; display:inline-flex; align-items:center; gap:0.25rem;">
                                        <i class="ph-fill ph-check-circle"></i> Inscrit Actif
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background:#ffedd5; color:#c2410c; font-weight:600; padding:0.25rem 0.65rem; border-radius:6px; display:inline-flex; align-items:center; gap:0.25rem;">
                                        <i class="ph-bold ph-clock"></i> En attente
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div style="display: flex; gap: 0.75rem;">
                                <button type="button" class="btn-light" id="openEditModalBtn" style="padding: 0.5rem 1rem; display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 8px; border:1px solid var(--border-color);">
                                    <i class="ph ph-pencil-simple"></i> Modifier
                                </button>
                                <a href="/generer_pdf?id=<?= $etudiant['id'] ?>" class="btn" style="padding: 0.5rem 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 8px;">
                                    <i class="ph ph-file-pdf"></i> Générer Fiche
                                </a>
                            </div>
                        </div>
                        
                        <div style="height: 1px; background: var(--border-color); margin: 2rem 0;"></div>
                        
                        <div class="grid-2">
                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-books"></i> Filière d'étude</div>
                                <div class="info-value" style="color: var(--primary-color); font-weight: 600;">
                                    <?= !empty($etudiant['nom_filiere']) ? htmlspecialchars($etudiant['nom_filiere']) : 'Aucune filière assignée' ?>
                                </div>
                            </div>
                            
                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-calendar"></i> Année Scolaire</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['annee_scolaire']) ?></div>
                            </div>

                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-cake"></i> Date de naissance</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['date_naissance']) ?></div>
                            </div>

                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-envelope"></i> Email Contact</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['email'] ?: 'Non renseigné') ?></div>
                            </div>

                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-users"></i> Nom du Tuteur</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['tuteur_nom']) ?></div>
                            </div>

                            <div class="info-group">
                                <div class="info-label"><i class="ph ph-phone"></i> Contact Tuteur</div>
                                <div class="info-value"><?= htmlspecialchars($etudiant['tuteur_contact'] ?: 'Non renseigné') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ===== MODAL POPUP DE MODIFICATION ===== -->
    <div class="modal-overlay" id="editEtudiantModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 style="font-family:'Outfit';font-size:1.1rem;margin:0;display:flex;align-items:center;gap:0.5rem;color:var(--text-main);">
                    <i class="ph-bold ph-user-gear" style="color:var(--primary-color);"></i> Modifier les informations de l'étudiant
                </h3>
                <button class="btn-close-modal" id="closeEditModalBtn">&times;</button>
            </div>
            <div class="modal-body">
                <!-- MODIFICATION ESSENTIELLE : Ajout de enctype="multipart/form-data" pour la photo -->
                <form action="/modifier_etudiant_save" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">

                    <div class="grid-2" style="gap: 1.25rem;">
                        <div class="form-group">
                            <label>Nom <span style="color:#e00">*</span></label>
                            <input type="text" name="nom" required value="<?= htmlspecialchars($etudiant['nom']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Prénom <span style="color:#e00">*</span></label>
                            <input type="text" name="prenom" required value="<?= htmlspecialchars($etudiant['prenom'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>Email Contact</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($etudiant['email'] ?? '') ?>" placeholder="Ex: etudiant@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Date de naissance <span style="color:#e00">*</span></label>
                            <input type="date" name="date_naissance" required value="<?= htmlspecialchars($etudiant['date_naissance']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Nom du Tuteur <span style="color:#e00">*</span></label>
                            <input type="text" name="tuteur_nom" required value="<?= htmlspecialchars($etudiant['tuteur_nom']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Contact Tuteur <span style="color:#e00">*</span></label>
                            <input type="text" name="tuteur_contact" required value="<?= htmlspecialchars($etudiant['tuteur_contact']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Année Scolaire <span style="color:#e00">*</span></label>
                            <input type="text" name="annee_scolaire" required value="<?= htmlspecialchars($etudiant['annee_scolaire']) ?>" placeholder="Ex: 2025-2026">
                        </div>

                        <div class="form-group">
                            <label>Statut d'Inscription</label>
                            <select name="statut" style="width: 100%; padding: 0.65rem 1rem; border: 1px solid var(--border-color); border-radius: var(--radius-md); background: #fff; font-family: inherit; font-size: 0.95rem; outline:none;">
                                <option value="en attente" <?= trim($etudiant['statut'] ?? '') === 'en attente' ? 'selected' : '' ?>>En attente</option>
                                <option value="Inscrit" <?= trim($etudiant['statut'] ?? '') === 'Inscrit' ? 'selected' : '' ?>>Inscrit</option>
                            </select>
                        </div>

                        <!-- NOUVEAU CHAMP : MODIFIER LA PHOTO -->
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Mettre à jour la photo d'identité (Optionnel)</label>
                            <div class="file-upload-wrapper">
                                <i class="ph ph-upload-simple" id="modal-upload-icon" style="font-size: 1.2rem; margin-right: 0.5rem; color: var(--text-muted);"></i>
                                <span id="modal-upload-text" style="font-size: 0.875rem; color: var(--text-muted); font-weight: 500;">Remplacer la photo actuelle...</span>
                                <input type="file" name="photo" id="modal-photo-input" accept="image/png, image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end; margin-top:2rem; gap:0.75rem;">
                        <button type="button" class="btn-light" id="cancelEditModalBtn" style="padding: 0.65rem 1.25rem; border-radius: 8px;">Annuler</button>
                        <button type="submit" class="btn" style="padding: 0.65rem 1.25rem; border-radius: 8px;"><i class="ph ph-check"></i> Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ===== SNACKBAR ALERTS ===== -->
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
            const modal = document.getElementById('editEtudiantModal');
            const openBtn = document.getElementById('openEditModalBtn');
            const closeBtn = document.getElementById('closeEditModalBtn');
            const cancelBtn = document.getElementById('cancelEditModalBtn');

            function openModal() {
                modal.classList.add('show');
            }

            function closeModal() {
                modal.classList.remove('show');
            }

            openBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Écouteur pour changer le texte au choix d'une nouvelle photo
            document.getElementById('modal-photo-input').addEventListener('change', function(e) {
                const fileName = e.target.files[0] ? e.target.files[0].name : "Remplacer la photo actuelle...";
                const uploadText = document.getElementById('modal-upload-text');
                const uploadIcon = document.getElementById('modal-upload-icon');
                
                uploadText.innerText = fileName;
                if (e.target.files[0]) {
                    uploadText.style.color = "var(--primary-color)";
                    uploadIcon.style.color = "var(--primary-color)";
                    uploadIcon.className = "ph-bold ph-check-circle";
                }
            });
        });
    </script>
</body>
</html>