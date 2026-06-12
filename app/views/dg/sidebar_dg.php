<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo" id="sidebar-logo-toggle">
        <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
        <span class="brand-font">EPI Management</span>
    </div>

    <div class="sidebar-section-title">Direction Générale</div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="/dg/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dg/dashboard') !== false ? 'active' : '' ?>">
                <i class="ph ph-squares-four" style="font-size:1.25rem;"></i><span>Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dg/professeurs" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dg/professeurs') !== false ? 'active' : '' ?>">
                <i class="ph ph-chalkboard-teacher" style="font-size:1.25rem;"></i><span>Corps Enseignant</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/dg/filieres" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dg/filieres') !== false ? 'active' : '' ?>">
                <i class="ph ph-books" style="font-size:1.25rem;"></i><span>Filières Académiques</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-section-title">Système</div>
    <ul class="nav-menu" style="flex:0;">
        <li class="nav-item">
            <a href="/logout_personnel" class="nav-link nav-link-danger">
                <i class="ph ph-sign-out" style="font-size:1.25rem;"></i><span>Déconnexion</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-profile">
        <div class="avatar" style="width:36px;height:36px;font-size:0.9rem;background:linear-gradient(135deg,var(--epi-gold),var(--epi-red));">
            <?= strtoupper(substr($admin_pseudo ?? 'D', 0, 1)) ?>
        </div>
        <div class="profile-info">
            <span class="profile-name"><?= htmlspecialchars($admin_pseudo ?? 'Directeur Général') ?></span>
            <span class="profile-role">Direction Générale</span>
        </div>
    </div>
</aside>
