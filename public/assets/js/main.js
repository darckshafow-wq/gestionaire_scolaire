document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-logo-toggle');

    if (sidebar && toggleBtn) {
        // Restaurer l'état depuis le localStorage
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
        }

        // Gérer le clic
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            const collapsedNow = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebar-collapsed', collapsedNow);
        });
    }

    // Gestion de la Snackbar (notifications)
    const snackbar = document.getElementById('snackbar');
    if (snackbar && snackbar.classList.contains('show')) {
        setTimeout(function(){ 
            snackbar.classList.remove('show');
        }, 4000);
    }
});
