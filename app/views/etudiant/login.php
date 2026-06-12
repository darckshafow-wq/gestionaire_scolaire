<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Connexion Étudiant</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: linear-gradient(135deg, var(--epi-blue-light) 0%, #fff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .auth-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            width: 100%;
            max-width: 430px;
            box-shadow: 0 20px 40px rgba(0,48,135,0.08);
            border-top: 5px solid var(--epi-blue);
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <a href="/portail_etudiant" style="color: var(--text-muted); text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1.5rem;">
            <i class="ph ph-arrow-left"></i> Retour au portail
        </a>

        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 64px; height: 64px; background: var(--epi-blue-light); color: var(--epi-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; margin: 0 auto 1rem;">
                <i class="ph-fill ph-student"></i>
            </div>
            <h2 style="font-family: 'Outfit'; color: var(--epi-blue);">Accès Étudiant</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Connectez-vous avec vos identifiants</p>
        </div>

        <?php if (isset($error)): ?>
            <div style="background: #fee2e2; border-left: 4px solid var(--epi-red); color: #991b1b; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-size: 0.9rem;">
                <i class="ph-fill ph-warning-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/etudiant/login" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="votre.email@exemple.com">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn" style="width: 100%; margin-top: 0.5rem;">
                <i class="ph ph-sign-in"></i> Se connecter
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
            <p style="font-size: 0.9rem; color: var(--text-muted);">Pas encore inscrit ? <a href="/etudiant/inscription" style="color: var(--epi-blue); font-weight: 600;">Soumettre mon dossier</a></p>
        </div>
    </div>
</body>
</html>
