<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - L'excellence administrative</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .landing-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--bg-color) 0%, #e0e7ff 100%);
        }
        .landing-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 10%;
            position: relative;
            z-index: 10;
        }
        .landing-visual {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-indigo));
            position: relative;
            overflow: hidden;
            padding: 2rem;
        }
        /* Decoratifs */
        .landing-visual::before {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            top: -200px;
            right: -200px;
        }
        .mockup-window {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 600px;
            height: 400px;
            box-shadow: var(--shadow-hover);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .mockup-header {
            height: 40px;
            background: rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 0.5rem;
        }
        .mockup-dot {
            width: 12px; height: 12px; border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="landing-grid">
        <div class="landing-content">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 2rem;">
                <span style="font-size: 2rem; color: var(--primary-color);"><i class="ph-fill ph-graduation-cap"></i></span> 
                <span class="brand-font" style="font-size: 1.5rem;">EduGest Pro</span>
            </div>

            <div style="display: inline-block; padding: 0.5rem 1rem; background: var(--primary-light); color: var(--primary-color); border-radius: 50px; font-weight: 600; font-size: 0.85rem; margin-bottom: 1.5rem; border: 1px solid rgba(37, 99, 235, 0.1); width: fit-content;">
                🚀 Nouvelle version 2.0
            </div>
            
            <h1 style="font-size: 4rem; margin-bottom: 1.5rem; color: var(--text-main); line-height: 1.1;">
                Gérez votre établissement avec <span style="background: linear-gradient(135deg, var(--primary-color), var(--accent-indigo)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">élégance</span>.
            </h1>
            
            <p style="color: var(--text-muted); font-size: 1.125rem; margin-bottom: 3rem; line-height: 1.6; max-width: 500px;">
                Le système de gestion scolaire moderne conçu pour simplifier l'administration tout en offrant une expérience utilisateur exceptionnelle.
            </p>
            
            <div style="display: flex; gap: 1rem;">
                <a href="/login" class="btn" style="padding: 1rem 2.5rem; font-size: 1.1rem; border-radius: 50px;">
                    Portail Administrateur <i class="ph-bold ph-arrow-right"></i>
                </a>
                <a href="https://github.com/votre-repo" class="btn-light" style="padding: 1rem 2.5rem; font-size: 1.1rem; border-radius: 50px; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="ph ph-info"></i> En savoir plus
                </a>
            </div>
        </div>

        <div class="landing-visual">
            <div class="mockup-window">
                <div class="mockup-header">
                    <div class="mockup-dot" style="background: #ef4444;"></div>
                    <div class="mockup-dot" style="background: #f59e0b;"></div>
                    <div class="mockup-dot" style="background: #10b981;"></div>
                </div>
                <div style="padding: 2rem; display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="height: 30px; width: 40%; background: rgba(255,255,255,0.2); border-radius: 8px;"></div>
                    <div style="display: flex; gap: 1rem;">
                        <div style="height: 100px; flex: 1; background: rgba(255,255,255,0.1); border-radius: 12px;"></div>
                        <div style="height: 100px; flex: 1; background: rgba(255,255,255,0.1); border-radius: 12px;"></div>
                        <div style="height: 100px; flex: 1; background: rgba(255,255,255,0.1); border-radius: 12px;"></div>
                    </div>
                    <div style="height: 150px; width: 100%; background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px dashed rgba(255,255,255,0.2);"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>