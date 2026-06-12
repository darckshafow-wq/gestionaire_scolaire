<?php
$admin_pseudo    = $admin_pseudo ?? 'DG';
$prof_valides    = $prof_valides ?? 0;
$prof_en_attente = $prof_en_attente ?? 0;
$total_etudiants = $total_etudiants ?? 0;
$total_filieres  = $total_filieres ?? 0;
$filieres        = $filieres ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT - Dashboard DG</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/roles/dg.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
<div class="page-layout">

    <!-- COLONNE 1 : Sidebar -->
    <?php include ROOT_PATH . '/app/views/dg/sidebar_dg.php'; ?>

    <!-- COLONNE 2 : Navigation secondaire -->
    <nav class="nav-panel">
        <div class="nav-panel-title">Vue globale</div>
        
        <div class="nav-panel-item active">
            <i class="ph ph-squares-four" style="font-size:1.1rem;"></i>
            Tableau de bord
        </div>

        <div class="nav-divider"></div>
        <div class="nav-panel-title">Raccourcis</div>
        
        <a href="/dg/professeurs" class="nav-panel-item">
            <i class="ph ph-chalkboard-teacher" style="font-size:1.1rem;"></i>
            Corps Enseignant
        </a>
        <a href="/dg/filieres" class="nav-panel-item">
            <i class="ph ph-books" style="font-size:1.1rem;"></i>
            Filières
        </a>
    </nav>

    <!-- COLONNE 3 : Contenu principal -->
    <div class="content-panel">
        
        <div class="dashboard-header-card">
            <div>
                <p style="text-transform:uppercase;letter-spacing:0.05em;font-size:0.8rem;margin-bottom:0.5rem;opacity:0.7;">Supervision Générale</p>
                <h1>Bienvenue, <?= htmlspecialchars($admin_pseudo) ?></h1>
                <p>Vue globale sur les statistiques et l'état de l'établissement.</p>
            </div>
            <div style="background:rgba(255,255,255,0.15);padding:1rem;border-radius:50%;width:80px;height:80px;display:flex;align-items:center;justify-content:center;">
                <i class="ph ph-chart-line-up" style="font-size:2.5rem;"></i>
            </div>
        </div>

        <div class="section-heading">Indicateurs Clés</div>

        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon" style="background:#e0e7ff;color:#4f46e5;"><i class="ph ph-users"></i></div>
                <div>
                    <div class="kpi-val" style="color:var(--epi-blue);"><?= $total_etudiants ?></div>
                    <div class="kpi-label">Étudiants inscrits</div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background:#fef3c7;color:#b45309;"><i class="ph ph-books"></i></div>
                <div>
                    <div class="kpi-val" style="color:var(--epi-gold);"><?= $total_filieres ?></div>
                    <div class="kpi-label">Filières créées</div>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon" style="background:#dcfce7;color:#16a34a;"><i class="ph ph-chalkboard-teacher"></i></div>
                <div>
                    <div class="kpi-val" style="color:#16a34a;"><?= $prof_valides ?></div>
                    <div class="kpi-label">Professeurs validés</div>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon" style="background:#fee2e2;color:#dc2626;"><i class="ph ph-user-circle-plus"></i></div>
                <div>
                    <div class="kpi-val" style="color:#dc2626;"><?= $prof_en_attente ?></div>
                    <div class="kpi-label">Candidatures en attente</div>
                </div>
            </div>
        </div>

    </div><!-- end content-panel -->
</div><!-- end page-layout -->

<script src="/assets/js/roles/dg.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
