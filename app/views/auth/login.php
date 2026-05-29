<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="centered-container">
        <!-- Decoration background -->
        <div style="position: absolute; top: 10%; right: 10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: 10%; left: 10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%); border-radius: 50%;"></div>
        
        <div class="auth-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary-light), white); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; box-shadow: var(--shadow-sm); border: 1px solid var(--border-color); margin-bottom: 1rem;">
                    🏫
                </div>
                <h2 style="margin-bottom: 0.5rem; font-family: 'Outfit';">Bienvenue</h2>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Connectez-vous à votre espace administrateur</p>
            </div>

            <?php if (isset($error)): ?>
                <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500;">
                    ⚠️ <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="form-group">
                    <label>Adresse e-mail</label>
                    <input type="email" name="email" placeholder="admin@etablissement.com" required>
                </div>
                <div class="form-group">
                    <div style="display: flex; justify-content: space-between;">
                        <label>Mot de passe</label>
                        <a href="#" style="font-size: 0.8rem; color: var(--primary-color); font-weight: 500;">Oublié ?</a>
                    </div>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn" style="width: 100%; padding: 0.875rem; font-size: 1rem; margin-top: 1rem;">
                    Se connecter
                </button>
                <div style="margin-top: 2rem; text-align: center;">
                    <a href="/signup" style="color: var(--text-muted); font-size: 0.9rem; font-weight: 500; transition: color 0.2s;">
                        Créer un compte admin <span style="font-size: 0.8rem;">↗</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>