<?php
$prof_pseudo      = $prof_pseudo ?? 'Professeur';
$mes_classes      = $mes_classes ?? [];
$matiere_id       = $matiere_id ?? 0;
$matiere_actuelle = $matiere_actuelle ?? null;
$etudiants        = $etudiants ?? [];
$notes_existantes = $notes_existantes ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI MANAGEMENT – Notes & Étudiants</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="/assets/css/roles/professeur.css">
</head>
<body>
<div class="page-layout">

    <!-- COLONNE 1 : Sidebar principale EPI -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo" id="sidebar-logo-toggle">
            <img src="/assets/images/logo.jpg" alt="EPI Logo" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
            <span class="brand-font">EPI Management</span>
        </div>
        <div class="sidebar-section-title">Corps Enseignant</div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/professeur/dashboard" class="nav-link">
                    <i class="ph ph-house" style="font-size:1.25rem;"></i><span>Mon Espace</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/professeur/notes" class="nav-link active">
                    <i class="ph ph-exam" style="font-size:1.25rem;"></i><span>Notes & Étudiants</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-section-title">Système</div>
        <ul class="nav-menu" style="flex:0;">
            <li class="nav-item">
                <a href="/professeur/logout" class="nav-link nav-link-danger">
                    <i class="ph ph-sign-out" style="font-size:1.25rem;"></i><span>Déconnexion</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-profile">
            <div class="avatar" style="width:36px;height:36px;font-size:.9rem;background:linear-gradient(135deg,#0ea5e9,#2563eb);">
                <?= strtoupper(substr($prof_pseudo, 0, 1)) ?>
            </div>
            <div class="profile-info">
                <span class="profile-name">Prof. <?= htmlspecialchars($prof_pseudo) ?></span>
                <span class="profile-role">Enseignant</span>
            </div>
        </div>
    </aside>

    <!-- COLONNE 2 : Navigation secondaire (Matières) -->
    <nav class="nav-panel">
        <div class="nav-panel-title">Mes Classes</div>

        <?php if (!empty($mes_classes)): ?>
            <?php
            $filieres_groupes = [];
            foreach ($mes_classes as $c) {
                $filieres_groupes[$c['filiere_nom']][] = $c;
            }
            ?>
            <?php foreach ($filieres_groupes as $fil_nom => $matieres): ?>
                <div style="padding:.5rem 1.25rem .2rem;font-size:.75rem;font-weight:600;color:var(--text-muted);display:flex;align-items:center;gap:.35rem;">
                    <i class="ph ph-graduation-cap"></i> <?= htmlspecialchars($fil_nom) ?>
                </div>
                <?php foreach ($matieres as $m): ?>
                    <a href="/professeur/notes?matiere_id=<?= $m['id'] ?>"
                       class="matiere-nav-item <?= $matiere_id == $m['id'] ? 'active' : '' ?>">
                        <?= htmlspecialchars($m['nom']) ?>
                        <span class="coef">×<?= $m['coefficient'] ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="padding:1.5rem 1.25rem;font-size:.83rem;color:var(--text-muted);text-align:center;">
                <i class="ph ph-books" style="display:block;font-size:2rem;margin-bottom:.5rem;opacity:.3;"></i>
                Aucune classe assignée.
            </div>
        <?php endif; ?>
    </nav>

    <!-- COLONNE 3 : Contenu -->
    <div class="content-panel">

        <?php if (isset($_SESSION['snackbar'])): ?>
            <div style="background:#dcfce7;border-left:4px solid #16a34a;color:#166534;padding:1rem 1.25rem;border-radius:var(--radius-md);margin-bottom:1.5rem;display:flex;gap:.75rem;align-items:center;">
                <i class="ph ph-check-circle" style="font-size:1.2rem;"></i> <?= $_SESSION['snackbar'] ?>
            </div>
            <?php unset($_SESSION['snackbar']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['snackbar_error'])): ?>
            <div style="background:#fee2e2;border-left:4px solid #dc2626;color:#991b1b;padding:1rem;border-radius:var(--radius-md);margin-bottom:1.5rem;">
                <?= $_SESSION['snackbar_error'] ?>
            </div>
            <?php unset($_SESSION['snackbar_error']); ?>
        <?php endif; ?>

        <?php if ($matiere_actuelle): ?>
            <!-- En-tête de la matière sélectionnée -->
            <div style="background:linear-gradient(135deg,var(--epi-blue),#1d4ed8);border-radius:var(--radius-lg);padding:1.5rem 2rem;color:white;margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <p style="opacity:.75;font-size:.78rem;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.3rem;">Matière sélectionnée</p>
                    <h2 style="font-family:'Outfit';font-size:1.4rem;margin-bottom:.15rem;"><?= htmlspecialchars($matiere_actuelle['nom']) ?></h2>
                    <p style="opacity:.85;font-size:.85rem;"><?= htmlspecialchars($matiere_actuelle['filiere_nom']) ?> · Coefficient <?= $matiere_actuelle['coefficient'] ?></p>
                </div>
                <div style="background:rgba(255,255,255,.15);padding:.75rem 1.5rem;border-radius:var(--radius-lg);text-align:center;">
                    <div style="font-family:'Outfit';font-size:1.75rem;font-weight:700;line-height:1;"><?= count($etudiants) ?></div>
                    <div style="font-size:.78rem;opacity:.8;">étudiant<?= count($etudiants) > 1 ? 's' : '' ?></div>
                </div>
            </div>

            <?php if (!empty($etudiants)): ?>
            <form action="/professeur/notes/save" method="POST">
                <input type="hidden" name="matiere_id" value="<?= $matiere_actuelle['id'] ?>">

                <div class="notes-table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Étudiant</th>
                                <th style="text-align:center;">Note /20</th>
                                <th>Appréciation</th>
                                <th style="text-align:center;">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiants as $etu):
                                $n = $notes_existantes[$etu['id']] ?? null;
                                $note_val = $n ? (float)$n['valeur'] : null;
                                // Déterminer la couleur de la note
                                $color = '#94a3b8'; // gris = pas de note
                                if ($note_val !== null) {
                                    if ($note_val >= 14) $color = '#16a34a'; // vert
                                    elseif ($note_val >= 10) $color = '#b45309'; // orange
                                    else $color = '#dc2626'; // rouge
                                }
                            ?>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:.5rem;">
                                        <span class="etu-avatar"><?= strtoupper(substr($etu['nom'], 0, 1)) ?></span>
                                        <div>
                                            <div style="font-weight:600;font-size:.88rem;"><?= htmlspecialchars($etu['nom'] . ' ' . $etu['prenom']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <input type="number" class="note-input" step="0.25" min="0" max="20"
                                        name="notes[<?= $etu['id'] ?>]"
                                        value="<?= $note_val !== null ? $note_val : '' ?>"
                                        placeholder="—">
                                </td>
                                <td>
                                    <input type="text" class="comment-input"
                                        name="commentaires[<?= $etu['id'] ?>]"
                                        value="<?= htmlspecialchars($n['commentaire'] ?? '') ?>"
                                        placeholder="Appréciation...">
                                </td>
                                <td style="text-align:center;">
                                    <?php if ($note_val !== null): ?>
                                        <span class="note-badge" style="background:<?= $color ?>22;color:<?= $color ?>;">
                                            <?= number_format($note_val, 2) ?>/20
                                        </span>
                                    <?php else: ?>
                                        <span class="note-badge" style="background:#f1f5f9;color:#94a3b8;">Non noté</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn" style="margin-top:1.5rem;padding:.85rem 2rem;font-size:.95rem;">
                    <i class="ph ph-floppy-disk"></i> Enregistrer les notes
                </button>
            </form>
            <?php else: ?>
                <div class="empty-state">
                    <i class="ph ph-users"></i>
                    <p>Aucun étudiant validé</p>
                    <small>Il n'y a pas encore d'étudiants validés dans cette filière.</small>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <!-- Aucune matière sélectionnée -->
            <div class="empty-state">
                <i class="ph ph-arrow-left"></i>
                <p>Sélectionnez une matière</p>
                <small>Choisissez une matière dans le panneau de gauche pour afficher les étudiants et saisir les notes.</small>
            </div>
        <?php endif; ?>

    </div><!-- end content-panel -->
</div><!-- end page-layout -->

<script src="/assets/js/main.js"></script>
</body>
</html>
