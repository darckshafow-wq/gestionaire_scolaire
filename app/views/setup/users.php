<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Utilisateurs (Dev Seulement)</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { background: #f0f4ff; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .setup-container { background: white; padding: 2.5rem; border-radius: var(--radius-xl); box-shadow: 0 10px 30px rgba(0,0,0,0.1); max-width: 500px; width: 100%; }
    </style>
</head>
<body>
    <div class="setup-container">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 50px; height: 50px; background: var(--epi-blue-light); color: var(--epi-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1rem;">
                <i class="ph-bold ph-wrench"></i>
            </div>
            <h2 style="font-family: 'Outfit'; color: var(--epi-navy);">Création de Personnel</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Interface temporaire pour initialiser les accès.</p>
        </div>

        <?php if (isset($_SESSION['setup_success'])): ?>
            <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <i class="ph-bold ph-check-circle"></i> <?= $_SESSION['setup_success'] ?>
            </div>
            <?php unset($_SESSION['setup_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['setup_error'])): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <i class="ph-bold ph-warning-circle"></i> <?= $_SESSION['setup_error'] ?>
            </div>
            <?php unset($_SESSION['setup_error']); ?>
        <?php endif; ?>

        <form action="/setup_users/store" method="POST">
            <div class="form-group">
                <label>Type de compte</label>
                <select name="role" id="roleSelect" required onchange="toggleSpecialite()">
                    <option value="">-- Sélectionner le rôle --</option>
                    <option value="dg">Directeur Général (DG)</option>
                    <option value="secretaire">Secrétaire</option>
                    <option value="professeur">Professeur</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nom complet / Pseudo</label>
                <input type="text" name="nom" required placeholder="Ex: Jean Dupont">
            </div>

            <div class="form-group">
                <label>Email de connexion</label>
                <input type="email" name="email" required placeholder="email@epi.edu.ci">
            </div>

            <div class="form-group" id="specialiteGroup" style="display: none;">
                <label>Spécialité (Professeur uniquement)</label>
                <input type="text" name="specialite" placeholder="Ex: Informatique">
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn" style="width: 100%; margin-top: 1rem; padding: 0.9rem;">
                <i class="ph ph-user-plus"></i> Créer le compte
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; border-top: 1px solid var(--border-color); padding-top: 1rem;">
            <a href="/login_personnel" style="color: var(--epi-blue); text-decoration: none; font-size: 0.9rem; font-weight: 500;">
                Aller à la page de connexion <i class="ph ph-arrow-right"></i>
            </a>
        </div>
    </div>

    <script>
        function toggleSpecialite() {
            const role = document.getElementById('roleSelect').value;
            const group = document.getElementById('specialiteGroup');
            if (role === 'professeur') {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        }
    </script>
</body>
</html>
