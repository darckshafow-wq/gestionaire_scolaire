<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Portail Étudiant</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: linear-gradient(135deg, #e8eef8 0%, #f8fafc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .portal-container {
            max-width: 750px;
            width: 100%;
            text-align: center;
        }
        .choice-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 2.5rem;
        }
        .choice-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2.5rem 2rem;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        .choice-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
        }
        .choice-card.old::before { background: var(--epi-blue); }
        .choice-card.new::before { background: var(--epi-gold); }
        .choice-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        }
        .choice-card.old:hover { border-color: var(--epi-blue); }
        .choice-card.new:hover { border-color: var(--epi-gold); }
        .choice-icon { font-size: 3rem; margin-bottom: 1rem; display: block; }
        @media (max-width: 500px) {
            .choice-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="portal-container">
        <a href="/" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 2rem;">
            <i class="ph ph-arrow-left"></i> Retour à l'accueil
        </a>

        <div style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--epi-blue), var(--epi-navy)); color: var(--epi-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Outfit'; font-weight: bold; font-size: 1.2rem; margin: 0 auto 1.5rem;">EPI</div>
        <h1 style="font-family: 'Outfit'; color: var(--epi-blue); font-size: 2rem; margin-bottom: 0.5rem;">Portail Étudiant</h1>
        <p style="color: var(--text-muted);">Êtes-vous déjà inscrit ou souhaitez-vous soumettre votre candidature ?</p>

        <div class="choice-grid">
            <a href="/etudiant/login" class="choice-card old">
                <i class="ph-fill ph-student choice-icon" style="color: var(--epi-blue);"></i>
                <h3 style="font-family: 'Outfit'; color: var(--epi-blue); margin-bottom: 0.5rem;">Déjà inscrit</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Accédez à votre espace, votre emploi du temps et votre statut d'inscription.</p>
                <div style="margin-top: 1.5rem;">
                    <span style="background: var(--epi-blue-light); color: var(--epi-blue); padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Se connecter →</span>
                </div>
            </a>

            <a href="/etudiant/inscription" class="choice-card new">
                <i class="ph-fill ph-folder-plus choice-icon" style="color: var(--epi-gold);"></i>
                <h3 style="font-family: 'Outfit'; color: #92400e; margin-bottom: 0.5rem;">Nouvel étudiant</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Soumettez votre dossier de candidature avec vos documents. La secrétaire validera votre inscription.</p>
                <div style="margin-top: 1.5rem;">
                    <span style="background: var(--epi-gold-light); color: #92400e; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Déposer mon dossier →</span>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
