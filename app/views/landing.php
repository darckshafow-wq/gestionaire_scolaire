<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI Management | Portail Académique</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        :root {
            --epi-blue: #003087;
            --epi-navy: #1a237e;
            --epi-green: #2ecc71;
            --bg-light: #f8fafc;
            --text-main: #0f172a;
        }

        body { margin: 0; font-family: 'Inter', sans-serif; background-color: var(--bg-light); color: var(--text-main); }

        /* Hero Section élégante */
        .hero {
            background: linear-gradient(135deg, var(--epi-blue), var(--epi-navy));
            color: #ffffff;
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 { font-family: 'Outfit', sans-serif; font-size: 3.5rem; margin-bottom: 1rem; }
        .hero p { font-size: 1.25rem; opacity: 0.9; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto; }

        .cta-button {
            background: var(--epi-green);
            color: white;
            padding: 16px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            transition: transform 0.2s, background 0.2s;
            display: inline-block;
        }
        .cta-button:hover { background: #27ae60; transform: translateY(-3px); }

        /* Grille de fonctionnalités */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            padding: 80px 10%;
        }

        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .feature-card:hover { transform: translateY(-10px); }
        .feature-icon { font-size: 3rem; color: var(--epi-blue); margin-bottom: 20px; }

        /* Footer institutionnel */
        footer {
            background-color: var(--text-main);
            color: #cbd5e1;
            padding: 60px 10%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        footer h3 { color: white; font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body>

    <section class="hero">
        <h1>EPI Management</h1>
        <p>L'excellence administrative au service de votre établissement. Un outil centralisé pour piloter vos filières et vos étudiants.</p>
        <a href="/login" class="cta-button">Accéder au portail</a>
    </section>

    <section class="features">
        <div class="feature-card">
            <i class="ph ph-database feature-icon"></i>
            <h3>Registre Numérique</h3>
            <p>Gestion sécurisée des dossiers étudiants.</p>
        </div>
        <div class="feature-card">
            <i class="ph ph-chart-line feature-icon"></i>
            <h3>Suivi des Filières</h3>
            <p>Analyse précise des effectifs par cursus.</p>
        </div>
        <div class="feature-card">
            <i class="ph ph-file-text feature-icon"></i>
            <h3>Gestion Automatisée</h3>
            <p>Production rapide de fiches et documents.</p>
        </div>
    </section>

    <footer>
        <div>
            <h3>EPI Management</h3>
            <p>Système de gestion scolaire v1.0</p>
        </div>
        <div>
            <h3>Navigation</h3>
            <p>Support technique</p>
        </div>
        <div>
            <h3>Contact</h3>
            <p>Yamoussoukro, CI</p>
        </div>
    </footer>

</body>
</html>