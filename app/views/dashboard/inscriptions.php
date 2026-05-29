<?php
/**
 * VUE : Nouvelle Inscription
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
    <title>EPI Gest - Nouvelle Inscription</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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
                <li class="nav-item"><a href="/inscriptions" class="nav-link active" title="Inscriptions"><i class="ph ph-file-text" style="font-size:1.25rem;"></i><span>Inscriptions</span></a></li>
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

                    <form action="/inscriptions" method="POST">
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
                                <select name="filiere_id" required style="width: 100%; padding: 0.875rem 1rem; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-family: 'Inter'; background-color: white; outline: none;">
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
</body>
</html>