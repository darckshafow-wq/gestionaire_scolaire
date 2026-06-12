<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Connexion Personnel</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: linear-gradient(135deg, var(--epi-blue) 0%, var(--epi-navy) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
            max-width: 900px;
            width: 100%;
        }
        .auth-left {
            background: linear-gradient(135deg, var(--epi-blue), var(--epi-navy));
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }
        .auth-right {
            padding: 3rem;
        }
        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.15);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        @media (max-width: 600px) {
            .auth-wrapper { grid-template-columns: 1fr; }
            .auth-left { display: none; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-left">
            <div style="margin-bottom: 2rem;">
                <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-family: 'Outfit'; font-size: 1.2rem; font-weight: bold; color: var(--epi-gold);">EPI</div>
                <h2 style="font-family: 'Outfit'; font-size: 2rem; margin-bottom: 0.5rem;">Espace Personnel</h2>
                <p style="opacity: 0.8;">Plateforme de gestion académique et administrative</p>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1rem;">
                <div class="role-badge"><i class="ph ph-shield-star"></i> Directeur Général</div>
                <div class="role-badge"><i class="ph ph-clipboard-text"></i> Secrétariat</div>
                <div class="role-badge"><i class="ph ph-chalkboard-teacher"></i> Corps Enseignant</div>
            </div>
            <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.2);">
                <a href="/" style="color: rgba(255,255,255,0.7); font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="ph ph-arrow-left"></i> Retour à l'accueil
                </a>
            </div>
        </div>

        <div class="auth-right">
            <h2 style="font-family: 'Outfit'; color: var(--epi-blue); font-size: 1.75rem; margin-bottom: 0.5rem;">Connexion</h2>
            <p style="color: var(--text-muted); margin-bottom: 2rem;">Entrez vos identifiants pour accéder à votre espace.</p>

            <?php if (isset($error)): ?>
                <div style="background: #fee2e2; border-left: 4px solid var(--epi-red); color: #991b1b; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="ph-fill ph-warning-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/login_personnel" method="POST">
                <div class="form-group">
                    <label>Email institutionnel</label>
                    <input type="email" name="email" required placeholder="prenom.nom@epi.edu.ci"
                        style="border-color: var(--epi-blue-light);">
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn" style="width: 100%; padding: 0.9rem; margin-top: 0.5rem; font-size: 1rem;">
                    <i class="ph ph-sign-in"></i> Accéder à mon espace
                </button>
            </form>
        </div>
    </div>
</body>
</html>
