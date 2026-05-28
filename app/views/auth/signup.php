<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Inscription Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="centered-container">
        <div class="auth-card">
            <h2>Inscription Admin</h2>

            <!-- ✅ Affichage des erreurs -->
            <?php if (isset($error)): ?>
                <p style="color: #ef4444; background: #fef2f2; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>

            <!-- ✅ Le formulaire envoie en POST vers /signup (traité par AuthController@signup) -->
            <form action="/signup" method="POST">
                <div class="form-group">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" placeholder="Votre nom" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="admin@ecole.com" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="password_confirm" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn">Créer mon compte</button>
                <div style="margin-top: 1rem; text-align: center;">
                    <a href="/login" style="color: var(--primary-color); font-size: 0.9rem;">Déjà un compte ? Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>