<?php
/**
 * VUE : Dashboard Principal
 * 
 * Variables disponibles (passées par DashboardController@index) :
 *   - $admin_pseudo    : Pseudo de l'admin connecté
 *   - $total_etudiants : Nombre total d'étudiants
 *   - $total_admins    : Nombre d'administrateurs actifs
 *   - $etudiants       : Tableau des derniers étudiants inscrits
 * 
 * 🔧 TODO : Les données sont actuellement factices, elles viendront de la DB
 */
$total_etudiants = $total_etudiants ?? 0;
$total_admins = $total_admins ?? 0;
$admin_pseudo = $admin_pseudo ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGest Pro - Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="dashboard-layout">
        <!-- ============================================ -->
        <!-- SIDEBAR - Menu de navigation latéral         -->
        <!-- ✅ Les liens pointent vers les vraies routes  -->
        <!-- ============================================ -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span style="font-size: 1.5rem;">🏫</span> EduGest Pro
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link active">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="/etudiants" class="nav-link">👥 Registre Étudiants</a></li>
                <li class="nav-item"><a href="/inscriptions" class="nav-link">📄 Inscriptions</a></li>
                <li class="nav-item"><a href="/calendrier" class="nav-link">📅 Calendrier</a></li>
                <br>
                <li class="nav-item"><a href="/parametres" class="nav-link">⚙️ Paramètres</a></li>
                <li class="nav-item"><a href="/logout" class="nav-link" style="color: #ef4444;">🚪 Déconnexion</a></li>
            </ul>
        </aside>

        <!-- ============================================ -->
        <!-- CONTENU PRINCIPAL                            -->
        <!-- ============================================ -->
        <main class="main-content">
            <!-- Header avec salutation dynamique -->
            <header class="header">
                <div class="greeting">
                    <!-- ✅ Affiche le pseudo de l'admin connecté depuis la session -->
                    <h1>Bonjour, <?= htmlspecialchars($admin_pseudo) ?></h1>
                    <p>Voici l'aperçu de votre établissement aujourd'hui.</p>
                </div>
                <div class="profile-section">
                    <span style="font-weight: 500;"><?= htmlspecialchars($admin_pseudo) ?></span>
                    <div class="avatar"></div>
                </div>
            </header>

            <!-- ============================================ -->
            <!-- CARTES STATISTIQUES                          -->
            <!-- 🔧 TODO : Données à charger depuis la DB    -->
            <!-- ============================================ -->
            <div class="cards-grid">
                <div class="card">
                    <h3>Inscrire un Étudiant</h3>
                    <p>Ouvrir le formulaire d'inscription rapide et générer une fiche PDF.</p>
                    <!-- ✅ Lien vers la page d'inscription -->
                    <a href="/inscriptions" class="btn-light">Nouvelle Inscription ↗</a>
                </div>
                <div class="card card-alt">
                    <h3>Effectif Total</h3>
                    <p>Aperçu rapide du nombre d'étudiants enregistrés dans la base.</p>
                    <!-- ✅ Affiche le total dynamique -->
                    <h2 style="font-size: 2rem; margin-top: 0.5rem;"><?= $total_etudiants ?> Étudiants</h2>
                </div>
                <div class="card">
                    <h3>Administrateurs</h3>
                    <p>Gestion du personnel autorisé sur le système.</p>
                    <h2 style="font-size: 2rem; margin-top: 0.5rem;"><?= $total_admins ?> Actifs</h2>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- TABLEAU : Dernières Inscriptions             -->
            <!-- ✅ FAIT : Boucle PHP dynamique sur $etudiants -->
            <!-- 🔧 TODO : Charger depuis Etudiant::getLatest() -->
            <!-- ============================================ -->
            <div class="section-title">
                Dernières Inscriptions
                <a href="/etudiants" style="font-size: 0.875rem; color: var(--primary-color);">Voir tout ➔</a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom & Prénom</th>
                            <th>Année Scolaire</th>
                            <th>Tuteur</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($etudiants) && count($etudiants) > 0): ?>
                            <?php foreach ($etudiants as $etudiant): ?>
                                <tr>
                                    <td style="font-weight: 500;"><?= htmlspecialchars($etudiant['nom']) ?></td>
                                    <td><?= htmlspecialchars($etudiant['annee']) ?></td>
                                    <td><?= htmlspecialchars($etudiant['tuteur']) ?></td>
                                    <td>
                                        <?php if ($etudiant['statut'] === 'Inscrit'): ?>
                                            <span class="badge badge-green">Inscrit</span>
                                        <?php else: ?>
                                            <span class="badge badge-blue"><?= htmlspecialchars($etudiant['statut']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <!-- 🔧 TODO : Ajouter ?id=XXX pour charger le bon étudiant -->
                                    <td><a href="/etudiant_detail" style="color: var(--primary-color);">👁️ Voir</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">Aucun étudiant trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>