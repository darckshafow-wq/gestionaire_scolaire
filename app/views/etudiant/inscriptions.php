<?php
/**
 * VUE : Nouvelle Inscription
 * Fichier : app/views/dashboard/inscriptions.php
 */
$admin_pseudo = $admin_pseudo ?? 'Admin';
$error = $error ?? null;
$filieres = $filieres ?? []; // Liste des filières transmise par le contrôleur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Nouvelle Inscription</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        /* Style personnalisé pour le conteneur du select et de la photo */
        .custom-select-style {
            width: 100%; 
            padding: 0.875rem 1rem; 
            border: 1px solid var(--border-color); 
            border-radius: var(--radius-md); 
            font-family: 'Inter'; 
            background-color: white; 
            outline: none;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: border-color 0.2s;
        }
        .custom-select-style:focus {
            border-color: var(--primary-color);
        }
        .file-upload-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed var(--border-color);
            padding: 1rem;
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
        <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <!-- ===== MAIN CONTENT ===== -->
        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Nouvelle Inscription</h1>
                    <p>Enregistrez un nouvel étudiant dans le système.</p>
                </div>
            </header>

            <div class="inscription-wrapper">
                <div class="detail-card">
                    <?php if ($error): ?>
                        <div style="background-color:#fee2e2;color:#b91c1c;padding:1rem;border-radius:var(--radius-md);margin-bottom:1.5rem;display:flex;align-items:center;gap:0.5rem;border-left:4px solid #ef4444;">
                            <i class="ph-fill ph-warning-circle" style="font-size:1.25rem;"></i>
                            <?= htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <!-- CRUCIAL : Ajout de enctype pour autoriser le téléversement de la photo -->
                    <form action="/inscriptions" method="POST" enctype="multipart/form-data">
                        <h3 style="margin-bottom:1.5rem;color:var(--text-main);font-family:'Outfit';font-size:1.25rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="ph-fill ph-student" style="color:var(--primary-color);"></i> Informations de l'étudiant
                        </h3>

                        <div class="grid-2">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nom" required placeholder="Ex: Kouassi">
                            </div>
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="prenom" required placeholder="Ex: Jean-Marc">
                            </div>
                            <div class="form-group">
                                <label>Email (facultatif)</label>
                                <input type="email" name="email" placeholder="jean.kouassi@epi.edu.ci">
                            </div>
                            <div class="form-group">
                                <label>Année Scolaire</label>
                                <input type="text" name="annee_scolaire" value="2026-2027" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Filière</label>
                                <select name="filiere_id" required class="custom-select-style">
                                    <option value="" disabled selected>Choisir une filière...</option>
                                    <?php foreach ($filieres as $filiere): ?>
                                        <option value="<?= $filiere['id'] ?>"><?= htmlspecialchars($filiere['nom']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Date de naissance</label>
                                <input type="date" name="date_naissance" required>
                            </div>

                            <!-- NOUVEAU CHAMP : STATUT DE L'INSCRIPTION -->
                            <div class="form-group">
                                <label>Statut Initial du Dossier</label>
                                <select name="statut" class="custom-select-style">
                                    <option value="en attente" selected>En attente (Par défaut)</option>
                                    <option value="Inscrit">Inscrit (Dossier Validé)</option>
                                </select>
                            </div>

                            <!-- NOUVEAU CHAMP : PHOTO DE L'ÉTUDIANT -->
                            <div class="form-group">
                                <label>Photo d'identité (.png, .jpg)</label>
                                <div class="file-upload-wrapper" id="upload-box">
                                    <i class="ph ph-upload-simple" id="upload-icon" style="font-size: 1.25rem; margin-right: 0.5rem; color: var(--text-muted);"></i>
                                    <span id="upload-text" style="font-size: 0.875rem; color: var(--text-muted); font-weight: 500;">Choisir une photo...</span>
                                    <input type="file" name="photo" id="photo-input" accept="image/png, image/jpeg, image/jpg">
                                </div>
                            </div>
                        </div>

                        <div style="height:1px;background:var(--border-color);margin:2rem 0;"></div>

                        <h3 style="margin-bottom:1.5rem;color:var(--text-main);font-family:'Outfit';font-size:1.25rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="ph-fill ph-users" style="color:var(--primary-color);"></i> Informations du tuteur
                        </h3>

                        <div class="grid-2">
                            <div class="form-group">
                                <label>Nom du Tuteur</label>
                                <input type="text" name="tuteur_nom" required placeholder="Ex: Marie Kouassi">
                            </div>
                            <div class="form-group">
                                <label>Contact du Tuteur (Tél)</label>
                                <input type="text" name="tuteur_contact" required placeholder="+225 07 12 34 56 78">
                            </div>
                        </div>

                        <div style="margin-top:2rem;display:flex;justify-content:flex-end;gap:1rem;">
                            <button type="reset" class="btn-light" style="padding:0.75rem 1.25rem;border-radius:var(--radius-md); cursor: pointer;">Annuler</button>
                            <button type="submit" class="btn" id="btn-inscrire" style="background:linear-gradient(135deg, var(--primary-color), #1e40af); display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i class="ph ph-floppy-disk"></i> Enregistrer l'inscription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>

    <!-- Petit script JS pour afficher le nom du fichier sélectionné à l'écran -->
    <script>
        document.getElementById('photo-input').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : "Choisir une photo...";
            const uploadText = document.getElementById('upload-text');
            const uploadIcon = document.getElementById('upload-icon');
            
            uploadText.innerText = fileName;
            if (e.target.files[0]) {
                uploadText.style.color = "var(--primary-color)";
                uploadIcon.style.color = "var(--primary-color)";
                uploadIcon.className = "ph-bold ph-check-circle";
            }
        });
    </script>
</body>
</html>