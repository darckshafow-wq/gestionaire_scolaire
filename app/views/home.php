<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Bienvenue</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: linear-gradient(135deg, var(--epi-blue-light) 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            font-family: 'Inter', sans-serif;
        }
        .landing-container {
            text-align: center;
            max-width: 800px;
            width: 100%;
        }
        .logo-container {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--epi-blue), var(--epi-navy));
            color: var(--epi-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: bold;
            font-family: 'Outfit';
            margin: 0 auto 2rem;
            box-shadow: 0 10px 25px rgba(0, 48, 135, 0.2);
        }
        .landing-title {
            font-family: 'Outfit';
            color: var(--epi-blue);
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .landing-subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .role-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: var(--radius-xl);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid transparent;
        }
        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border-color: var(--epi-blue);
        }
        .role-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        .icon-student {
            background: var(--epi-blue-light);
            color: var(--epi-blue);
        }
        .icon-staff {
            background: var(--epi-gold-light);
            color: var(--epi-gold);
        }
        .role-title {
            color: var(--text-main);
            font-family: 'Outfit';
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .role-desc {
            color: var(--text-muted);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <div class="logo-container">EPI</div>
        <h1 class="landing-title">EPI MANAGEMENT</h1>
        <p class="landing-subtitle">Plateforme globale de gestion académique et administrative</p>

        <div class="cards-grid">
            <a href="/portail_etudiant" class="role-card">
                <div class="role-icon icon-student">
                    <i class="ph-fill ph-student"></i>
                </div>
                <h2 class="role-title">Espace Étudiant</h2>
                <p class="role-desc">Accédez à votre emploi du temps ou soumettez votre dossier d'inscription.</p>
            </a>

            <a href="/login_personnel" class="role-card">
                <div class="role-icon icon-staff">
                    <i class="ph-fill ph-briefcase"></i>
                </div>
                <h2 class="role-title">Espace Personnel</h2>
                <p class="role-desc">Accès réservé à l'administration (Secrétariat, DG) et au corps professoral.</p>
            </a>
        </div>
    </div>
</body>
</html>