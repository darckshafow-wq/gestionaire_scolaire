<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Registre Étudiants</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span style="font-size: 1.5rem;">🏫</span> EduGest Pro
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="/etudiants" class="nav-link active">👥 Registre Étudiants</a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link">📄 Inscriptions</a></li>
                <li class="nav-item"><a href="/calendrier" class="nav-link">📅 Calendrier</a></li>
                <br>
                <li class="nav-item"><a href="/parametres" class="nav-link">⚙️ Paramètres</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link" style="color: #ef4444;">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <h1>Registre des Étudiants</h1>
                    <p>Liste complète des élèves inscrits cette année.</p>
                </div>
                <div class="profile-section">
                    <span style="font-weight: 500;">Admin</span>
                    <div class="avatar"></div>
                </div>
            </header>

            <div class="card" style="margin-bottom: 2rem; display: flex; gap: 1rem; align-items: center;">
                <input type="text" placeholder="Rechercher un étudiant (nom, prénom...)" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 6px; flex: 1;">
                <button class="btn">Rechercher</button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom & Prénom</th>
                            <th>Date de naissance</th>
                            <th>Tuteur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fausse boucle en attendant le backend -->
                        <tr>
                            <td>101</td>
                            <td style="font-weight: 500;">Dupont Jean</td>
                            <td>14/05/2010</td>
                            <td>Marie Dupont</td>
                            <td><a href="/etudiant_detail" class="btn-light" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Détails</a></td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td style="font-weight: 500;">Martin Sophie</td>
                            <td>28/02/2011</td>
                            <td>Paul Martin</td>
                            <td><a href="/etudiant_detail" class="btn-light" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Détails</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
