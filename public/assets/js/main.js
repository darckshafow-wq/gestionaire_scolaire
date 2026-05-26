document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('btn-action');
    if (btn) {
        btn.addEventListener('click', () => {
            alert('L\'application MVC est bien initialisée !');
        });
    }
});
