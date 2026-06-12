# Modèle Logique des Données (MLD)

Le MLD (Modèle Logique des Données) traduit le MCD en relations logiques (tables) prêtes à être implémentées dans un SGBD relationnel, en intégrant les clés primaires (PK) et les clés étrangères (#FK).

## Liste des Relations (Tables)

**1. `administrateurs`**
- `id` : INT (PK)
- `email` : VARCHAR(255)
- `pseudo` : VARCHAR(100)
- `password` : VARCHAR(255)
- `role` : ENUM('secretaire', 'dg')
- `created_at` : TIMESTAMP

**2. `filieres`**
- `id` : INT (PK)
- `code` : VARCHAR(20)
- `nom` : VARCHAR(150)
- `description` : TEXT
- `duree_annees` : INT
- `niveau` : VARCHAR(50)
- `statut` : ENUM('Active', 'Inactive')

**3. `matieres`**
- `id` : INT (PK)
- `#filiere_id` : INT (FK -> `filieres.id`)
- `nom` : VARCHAR(150)
- `volume_horaire` : INT
- `coefficient` : INT

**4. `professeurs`**
- `id` : INT (PK)
- `nom` : VARCHAR(100)
- `prenom` : VARCHAR(100)
- `email` : VARCHAR(255)
- `password` : VARCHAR(255)
- `telephone` : VARCHAR(20)
- `specialite` : VARCHAR(150)
- `accord_dg` : BOOLEAN (TINYINT)

**5. `salles`**
- `id` : INT (PK)
- `nom` : VARCHAR(50)
- `capacite` : INT
- `etat_dispo` : ENUM('Disponible', 'Indisponible', 'En maintenance')

**6. `etudiants`**
- `id` : INT (PK)
- `nom` : VARCHAR(100)
- `prenom` : VARCHAR(100)
- `email` : VARCHAR(255)
- `password` : VARCHAR(255)
- `tuteur_nom` : VARCHAR(150)
- `tuteur_contact` : VARCHAR(20)
- `date_naissance` : DATE
- `annee_scolaire` : VARCHAR(20)
- `statut` : ENUM('en attente', 'Validé', 'Refusé')
- `#filiere_id` : INT (FK -> `filieres.id`)
- `#created_by` : INT (FK -> `administrateurs.id`, NULLable)

**7. `planning_cours`**
- `id` : INT (PK)
- `#filiere_id` : INT (FK -> `filieres.id`)
- `#matiere_id` : INT (FK -> `matieres.id`)
- `#professeur_id` : INT (FK -> `professeurs.id`)
- `#salle_id` : INT (FK -> `salles.id`)
- `date_cours` : DATE
- `heure_debut` : TIME
- `heure_fin` : TIME
- `#created_by` : INT (FK -> `administrateurs.id`, NULLable)

**8. `notes`**
- `id` : INT (PK)
- `#etudiant_id` : INT (FK -> `etudiants.id`)
- `#matiere_id` : INT (FK -> `matieres.id`)
- `#professeur_id` : INT (FK -> `professeurs.id`)
- `valeur` : DECIMAL(5,2)
- `commentaire` : TEXT
- `date_evaluation` : DATE
