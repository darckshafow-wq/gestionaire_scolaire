// secretaire.js (Calendrier interactif)

let draggedMatiereId = null;

async function chargerMatieres() {
    const filiereId = document.getElementById('filiere-select').value;
    const container = document.getElementById('draggable-container');
    const listWrapper = document.getElementById('matieres-list');
    
    if (!filiereId) {
        listWrapper.style.display = 'none';
        return;
    }

    try {
        const response = await fetch(`/calendrier/api_matieres?filiere_id=${filiereId}`);
        const matieres = await response.json();
        
        container.innerHTML = '';
        if (matieres.length === 0) {
            container.innerHTML = '<p style="color:var(--text-muted);font-size:0.85rem;">Aucune matière trouvée.</p>';
        } else {
            matieres.forEach(m => {
                const div = document.createElement('div');
                div.className = 'matiere-item';
                div.draggable = true;
                div.innerHTML = `<i class="ph ph-books" style="font-size:1.2rem;color:var(--epi-blue);"></i> <span>${m.nom}</span>`;
                div.ondragstart = (e) => drag(e, m.id);
                container.appendChild(div);
            });
        }
        listWrapper.style.display = 'block';
    } catch (err) {
        console.error("Erreur chargement matières:", err);
    }
}

function drag(ev, matiereId) {
    draggedMatiereId = matiereId;
    ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.effectAllowed = "copy";
}

function allowDrop(ev) {
    ev.preventDefault();
    ev.currentTarget.classList.add('drag-over');
}

function dragLeave(ev) {
    ev.currentTarget.classList.remove('drag-over');
}

function drop(ev, jour) {
    ev.preventDefault();
    ev.currentTarget.classList.remove('drag-over');
    
    if (!draggedMatiereId) return;

    const filiereId = document.getElementById('filiere-select').value;
    
    // Ouvrir la modale
    document.getElementById('modal_filiere_id').value = filiereId;
    document.getElementById('modal_matiere_id').value = draggedMatiereId;
    document.getElementById('modal_jour').value = jour;
    document.getElementById('modal_jour_label').innerText = jour;
    
    // Pré-remplir la date en fonction du jour de la semaine actuel
    const today = new Date();
    const days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    const targetDayIndex = days.indexOf(jour);
    const currentDayIndex = today.getDay();
    
    let diff = targetDayIndex - currentDayIndex;
    if (diff < 0) diff += 7; // Prochaine occurrence de ce jour
    
    const targetDate = new Date(today);
    targetDate.setDate(today.getDate() + diff);
    
    document.getElementById('modal_date').value = targetDate.toISOString().split('T')[0];

    document.getElementById('coursModal').classList.add('show');
}

function closeModal() {
    document.getElementById('coursModal').classList.remove('show');
    document.getElementById('coursForm').reset();
    draggedMatiereId = null;
}

async function saveCours(ev) {
    ev.preventDefault();
    
    const data = {
        filiere_id: document.getElementById('modal_filiere_id').value,
        matiere_id: document.getElementById('modal_matiere_id').value,
        date_cours: document.getElementById('modal_date').value,
        heure_debut: document.getElementById('modal_heure_debut').value,
        heure_fin: document.getElementById('modal_heure_fin').value,
        professeur_id: document.getElementById('modal_prof_id').value,
        salle_id: document.getElementById('modal_salle_id').value,
    };

    try {
        const response = await fetch('/calendrier/api_save', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        if (result.success) {
            alert("Cours planifié avec succès !");
            window.location.reload();
        } else {
            alert("Erreur: " + result.error);
        }
    } catch (err) {
        alert("Une erreur de connexion est survenue.");
    }
}
