<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Inscription Nouvel Étudiant</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { background: #f0f4ff; min-height: 100vh; padding: 2rem 1rem; }
        .form-container {
            max-width: 750px;
            margin: 0 auto;
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(135deg, var(--epi-blue), var(--epi-navy));
            padding: 2rem 2.5rem;
            color: white;
        }
        .form-body { padding: 2.5rem; }
        .section-label {
            font-family: 'Outfit';
            font-weight: 600;
            color: var(--epi-blue);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--epi-blue-light);
        }
        .file-drop-zone {
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8fafc;
        }
        .file-drop-zone:hover, .file-drop-zone.dragover {
            border-color: var(--epi-gold);
            background: var(--epi-gold-light);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <a href="/portail_etudiant" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1rem;">
                <i class="ph ph-arrow-left"></i> Retour au portail
            </a>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                    <i class="ph-fill ph-folder-plus"></i>
                </div>
                <div>
                    <h1 style="font-family: 'Outfit'; font-size: 1.5rem; margin-bottom: 0.25rem;">Dossier d'Inscription</h1>
                    <p style="opacity: 0.8; font-size: 0.9rem;">Remplissez le formulaire ci-dessous. Votre dossier sera examiné par le secrétariat.</p>
                </div>
            </div>
        </div>

        <div class="form-body">
            <?php if (isset($error)): ?>
                <div style="background: #fee2e2; border-left: 4px solid var(--epi-red); color: #991b1b; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="ph-fill ph-warning-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div style="background: #dcfce7; border-left: 4px solid #16a34a; color: #166534; padding: 1.5rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; text-align: center;">
                    <i class="ph-fill ph-check-circle" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    <strong>Dossier soumis avec succès !</strong><br>
                    <p style="margin-top: 0.5rem; font-size: 0.9rem;">Le secrétariat examinera votre dossier. Vous recevrez vos identifiants de connexion après validation.</p>
                </div>
            <?php else: ?>
            <form action="/etudiant/inscription" method="POST" enctype="multipart/form-data">

                <div class="section-label"><i class="ph ph-user"></i> Informations personnelles</div>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Nom <span style="color:#e00">*</span></label>
                        <input type="text" name="nom" required placeholder="Nom de famille">
                    </div>
                    <div class="form-group">
                        <label>Prénom <span style="color:#e00">*</span></label>
                        <input type="text" name="prenom" required placeholder="Prénom(s)">
                    </div>
                    <div class="form-group">
                        <label>Date de naissance <span style="color:#e00">*</span></label>
                        <input type="date" name="date_naissance" required>
                    </div>
                    <div class="form-group">
                        <label>Email personnel</label>
                        <input type="email" name="email" placeholder="votre.email@exemple.com">
                    </div>
                </div>

                <div class="section-label"><i class="ph ph-graduation-cap"></i> Informations académiques</div>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Filière souhaitée <span style="color:#e00">*</span></label>
                        <select name="filiere_id" required>
                            <option value="">-- Choisir --</option>
                            <?php foreach ($filieres ?? [] as $f): ?>
                                <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Année scolaire <span style="color:#e00">*</span></label>
                        <input type="text" name="annee_scolaire" required value="2025-2026" placeholder="Ex: 2025-2026">
                    </div>
                </div>

                <div class="section-label"><i class="ph ph-phone"></i> Contact du tuteur / parent</div>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Nom du tuteur <span style="color:#e00">*</span></label>
                        <input type="text" name="tuteur_nom" required placeholder="Nom complet du tuteur">
                    </div>
                    <div class="form-group">
                        <label>Contact du tuteur <span style="color:#e00">*</span></label>
                        <input type="text" name="tuteur_contact" required placeholder="Numéro de téléphone">
                    </div>
                </div>

                <div class="section-label"><i class="ph ph-files"></i> Documents requis</div>
                <div class="form-group">
                    <label>Photo d'identité (JPG/PNG) <span style="color:#e00">*</span></label>
                    <div class="file-drop-zone" onclick="document.getElementById('photo_upload').click()">
                        <i class="ph ph-image" style="font-size: 2rem; color: var(--text-muted);"></i>
                        <p style="margin: 0.5rem 0 0; color: var(--text-muted);" id="photo_label">Cliquez ou glissez votre photo ici</p>
                        <input type="file" id="photo_upload" name="photo_file" accept="image/*" style="display:none" onchange="document.getElementById('photo_label').textContent = this.files[0]?.name || 'Fichier sélectionné'">
                    </div>
                </div>
                <div class="form-group" style="margin-top: 1rem;">
                    <label>Dossier de candidature (PDF – Diplômes, Relevés, etc.) <span style="color:#e00">*</span></label>
                    <div class="file-drop-zone" onclick="document.getElementById('doc_upload').click()">
                        <i class="ph ph-file-pdf" style="font-size: 2rem; color: #dc2626;"></i>
                        <p style="margin: 0.5rem 0 0; color: var(--text-muted);" id="doc_label">Cliquez ou glissez votre dossier PDF ici</p>
                        <input type="file" id="doc_upload" name="document_file" accept=".pdf,image/*" style="display:none" onchange="document.getElementById('doc_label').textContent = this.files[0]?.name || 'Fichier sélectionné'">
                    </div>
                </div>

                <div style="height: 1px; background: var(--border-color); margin: 2rem 0;"></div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="/portail_etudiant" style="color: var(--text-muted); text-decoration: none; display: flex; align-items: center; gap: 0.4rem;"><i class="ph ph-arrow-left"></i> Annuler</a>
                    <button type="submit" class="btn" style="padding: 0.9rem 2rem;">
                        <i class="ph ph-paper-plane-tilt"></i> Soumettre mon dossier
                    </button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
