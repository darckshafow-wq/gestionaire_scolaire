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
        <div class="auth-card">
            <h2>Connexion Admin</h2>

            <!-- ✅ Affichage des erreurs de connexion -->
            <?php if (isset($error)): ?>
                <p style="color: #ef4444; background: #fef2f2; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <!-- ✅ Le formulaire envoie en POST vers /login (traité par AuthController@login) -->
            <form action="/login" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="admin@ecole.com" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn">Se connecter</button>
                <div style="margin-top: 1rem; text-align: center;">
                    <!-- ⚠️ Lien vers signup — À SUPPRIMER EN PRODUCTION -->
                    <a href="/signup" style="color: var(--primary-color); font-size: 0.9rem;">Créer un compte admin</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>