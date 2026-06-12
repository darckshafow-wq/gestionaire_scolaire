<?php
$admin_pseudo = $admin_pseudo ?? 'Secrétaire';
$current_path = $_SERVER['REQUEST_URI'];

function is_active($path, $current) {
    return strpos($current, $path) === 0 ? 'active' : '';
}
?>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo" id="sidebar-logo-toggle">
        <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
        <span class="brand-font">EPI Management</span>
    </div>
    
    <div class="sidebar-section-title">Gestion</div>
    <ul class="nav-menu">
        <li class="nav-item"><a href="/secretaire/dashboard" class="nav-link <?= $current_path == '/secretaire/dashboard' ? 'active' : '' ?>"><i class="ph ph-house" style="font-size:1.25rem;"></i><span>Vue d'ensemble</span></a></li>
        <li class="nav-item"><a href="/etudiants" class="nav-link <?= is_active('/etudiant', $current_path) ? 'active' : '' ?>"><i class="ph ph-users" style="font-size:1.25rem;"></i><span>Registre Étudiants</span></a></li>
        <li class="nav-item"><a href="/secretaire/dossiers" class="nav-link <?= is_active('/secretaire/dossiers', $current_path) ? 'active' : '' ?>"><i class="ph ph-folder-open" style="font-size:1.25rem;"></i><span>Dossiers (Nouveaux)</span></a></li>
        <li class="nav-item"><a href="/inscriptions" class="nav-link <?= is_active('/inscriptions', $current_path) ? 'active' : '' ?>"><i class="ph ph-file-text" style="font-size:1.25rem;"></i><span>Inscription Manuelle</span></a></li>
        <li class="nav-item"><a href="/secretaire/candidatures" class="nav-link <?= is_active('/secretaire/candidatures', $current_path) ? 'active' : '' ?>"><i class="ph ph-chalkboard-teacher" style="font-size:1.25rem;"></i><span>Candidatures Prof.</span></a></li>
        <li class="nav-item"><a href="/filieres" class="nav-link <?= is_active('/filiere', $current_path) ? 'active' : '' ?>"><i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières</span></a></li>
        <li class="nav-item"><a href="/matieres" class="nav-link <?= is_active('/matiere', $current_path) ? 'active' : '' ?>"><i class="ph ph-book-open" style="font-size:1.25rem;"></i><span>Matières</span></a></li>
        <li class="nav-item"><a href="/salles" class="nav-link <?= is_active('/salles', $current_path) ? 'active' : '' ?>"><i class="ph ph-door" style="font-size:1.25rem;"></i><span>Gestion des Salles</span></a></li>
        <li class="nav-item"><a href="/calendrier" class="nav-link <?= is_active('/calendrier', $current_path) ? 'active' : '' ?>"><i class="ph ph-calendar-check" style="font-size:1.25rem;"></i><span>Emploi du Temps</span></a></li>
    </ul>

    <div class="sidebar-section-title">Système</div>
    <ul class="nav-menu" style="flex:0;">
        <li class="nav-item"><a href="/parametres" class="nav-link <?= is_active('/parametres', $current_path) ? 'active' : '' ?>"><i class="ph ph-gear" style="font-size:1.25rem;"></i><span>Paramètres</span></a></li>
        <li class="nav-item"><a href="/logout_personnel" class="nav-link nav-link-danger"><i class="ph ph-sign-out" style="font-size:1.25rem;"></i><span>Déconnexion</span></a></li>
    </ul>

    <div class="sidebar-profile">
        <div class="avatar" style="width:36px;height:36px;font-size:.9rem;"><?= strtoupper(substr($admin_pseudo, 0, 1)) ?></div>
        <div class="profile-info">
            <span class="profile-name"><?= htmlspecialchars($admin_pseudo) ?></span>
            <span class="profile-role">Secrétariat</span>
        </div>
    </div>
</aside>
