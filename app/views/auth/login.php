<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI Gest – Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="centered-container">
        <!-- Decorative blobs -->
        <div style="position:absolute;top:8%;right:8%;width:320px;height:320px;background:radial-gradient(circle,rgba(0,48,135,0.18) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>
        <div style="position:absolute;bottom:8%;left:8%;width:420px;height:420px;background:radial-gradient(circle,rgba(204,0,0,0.10) 0%,transparent 70%);border-radius:50%;pointer-events:none;"></div>

        <div class="auth-card">
            <!-- Logo EPI -->
            <div style="text-align:center;margin-bottom:2rem;">
                <img src="/assets/images/logo_epi.svg" alt="Logo EPI"
                     style="width:90px;height:90px;border-radius:50%;border:3px solid var(--epi-blue-light);box-shadow:0 4px 20px rgba(0,48,135,0.18);margin-bottom:1rem;display:inline-block;">
                <h2 style="margin-bottom:0.25rem;font-family:'Outfit';">Bienvenue</h2>
                <p style="color:var(--text-muted);font-size:0.9rem;">Connectez-vous à votre espace administrateur</p>
                <p style="font-size:0.78rem;color:var(--epi-red);font-weight:600;letter-spacing:0.05em;margin-top:0.25rem;">ÉCOLE POLYTECHNIQUE INTERNATIONALE</p>
            </div>

            <?php if (isset($error)): ?>
                <div style="background:#fef2f2;border-left:4px solid #ef4444;color:#b91c1c;padding:1rem;border-radius:6px;margin-bottom:1.5rem;font-size:0.9rem;font-weight:500;">
                    ⚠️ <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <div class="form-group">
                    <label>Adresse e-mail</label>
                    <input type="email" name="email" id="email" placeholder="admin@epi.edu.ci" required>
                </div>
                <div class="form-group">
                    <div style="display:flex;justify-content:space-between;">
                        <label>Mot de passe</label>
                        <a href="#" style="font-size:0.8rem;color:var(--epi-blue);font-weight:500;">Oublié ?</a>
                    </div>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>
                <button type="submit" id="btn-login" class="btn" style="width:100%;padding:0.875rem;font-size:1rem;margin-top:1rem;background:linear-gradient(135deg,var(--epi-blue),#1e40af);">
                    Se connecter
                </button>
                <div style="margin-top:2rem;text-align:center;">
                    <a href="/signup" style="color:var(--text-muted);font-size:0.9rem;font-weight:500;transition:color 0.2s;">
                        Créer un compte admin <span style="font-size:0.8rem;">↗</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>