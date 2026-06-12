<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Paramètres</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="dashboard-layout">
            <!-- ===== SIDEBAR ===== -->
    <?php include ROOT_PATH . '/app/views/secretaire/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Paramètres Système</h1>
                    <p>Configuration générale de l'application.</p>
                </div>
            </header>

            <div class="grid-2">
                <div class="detail-card">
                    <h3 style="margin-bottom: 1.5rem; color: var(--text-main); font-family: 'Outfit'; font-size: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph-fill ph-buildings"></i> Établissement
                    </h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Nom de l'école</label>
                            <input type="text" name="ecole_nom" value="EPI Management Institution">
                        </div>
                        <div class="form-group">
                            <label>Année Scolaire Actuelle</label>
                            <input type="text" name="annee_actuelle" value="2026-2027">
                        </div>
                        <button type="submit" class="btn" style="margin-top: 1rem;"><i class="ph ph-floppy-disk"></i> Enregistrer</button>
                    </form>
                </div>
                
                <div class="detail-card">
                    <h3 style="margin-bottom: 1.5rem; color: var(--text-main); font-family: 'Outfit'; font-size: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph-fill ph-shield-check"></i> Sécurité
                    </h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Nouveau mot de passe</label>
                            <input type="password" name="password" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label>Confirmer le mot de passe</label>
                            <input type="password" name="password_confirm" placeholder="••••••••">
                        </div>
                        <button type="submit" class="btn" style="margin-top: 1rem; background: linear-gradient(135deg, #f43f5e, #e11d48);"><i class="ph ph-lock-key"></i> Mettre à jour</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/main.js"></script>
</body>
</html>
