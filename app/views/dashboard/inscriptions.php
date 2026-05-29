<!DOCTYPE html>
<html lang="fr">
<!-- TODO:
- Améliorer le style des messages d'erreur et de succès
- Ajouter une validation côté client plus robuste
-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Nouvel Inscription</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span style="font-size: 1.5rem;">🏫</span> EduGest Pro
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="/etudiants" class="nav-link">👥 Registre Étudiants</a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link active">📄 Inscriptions</a></li>
                <li class="nav-item"><a href="/calendrier" class="nav-link">📅 Calendrier</a></li>
                <br>
                <li class="nav-item"><a href="/parametres" class="nav-link">⚙️ Paramètres</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link" style="color: #ef4444;">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Nouvelle Inscription</h1>
                    <p>Enregistrez un nouvel étudiant dans le système.</p>
                </div>
                <div class="profile-section">
                    <span style="font-weight: 500;">Admin</span>
                    <div class="avatar"></div>
                </div>
            </header>

            <div class="card">
                <?php if (isset($error)): ?>
                    <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label>Nom de l'étudiant</label><br>
                            <input type="text" name="nom" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                        </div>
                        <div>
                            <label>Prénom de l'étudiant</label><br>
                            <input type="text" name="prenom" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label>Email (facultatif)</label><br>
                            <input type="email" name="email" style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                        </div>
                        <div>
                            <label>Année Scolaire</label><br>
                            <input type="text" name="annee_scolaire" value="2026-2027" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                        </div>
                    </div>
                    <div>
                        <label>Date de naissance</label><br>
                        <input type="date" name="date_naissance" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                    </div>
                    <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 1rem 0;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label>Nom du Tuteur</label><br>
                            <input type="text" name="tuteur_nom" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                        </div>
                        <div>
                            <label>Contact du Tuteur (Tél)</label><br>
                            <input type="text" name="tuteur_contact" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
                        </div>
                    </div>
                    <button type="submit" class="btn" style="margin-top: 1rem;">Enregistrer l'inscription</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>