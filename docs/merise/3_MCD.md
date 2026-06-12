# Modèle Conceptuel des Données (MCD)

Le MCD permet de représenter la structure des données du système d'information de manière abstraite.

## Entités et Associations (Diagramme ER)

```mermaid
erDiagram
    ADMINISTRATEUR {
        int id PK
        string email
        string pseudo
        string password
        string role "dg ou secretaire"
    }

    PROFESSEUR {
        int id PK
        string nom
        string prenom
        string email
        string password
        string telephone
        string specialite
        boolean accord_dg
    }

    ETUDIANT {
        int id PK
        string nom
        string prenom
        string email
        string password
        string tuteur_nom
        string tuteur_contact
        date date_naissance
        string annee_scolaire
        string statut "en attente, Validé, Refusé"
    }

    FILIERE {
        int id PK
        string code
        string nom
        string description
        int duree_annees
        string niveau
        string statut "Active ou Inactive"
    }

    MATIERE {
        int id PK
        string nom
        int volume_horaire
        int coefficient
    }

    SALLE {
        int id PK
        string nom
        int capacite
        string etat_dispo
    }

    NOTE {
        int id PK
        float valeur
        string commentaire
        date date_evaluation
    }

    COURS {
        int id PK
        date date_cours
        time heure_debut
        time heure_fin
    }

    %% Relations
    ETUDIANT }|--|| FILIERE : "S'inscrit_dans"
    FILIERE ||--|{ MATIERE : "Contient"
    
    COURS }|--|| FILIERE : "Concerne"
    COURS }|--|| MATIERE : "Porte_sur"
    COURS }|--|| PROFESSEUR : "Est_enseigne_par"
    COURS }|--|| SALLE : "Se_deroule_dans"

    NOTE }|--|| ETUDIANT : "Appartient_a"
    NOTE }|--|| MATIERE : "Evalue_sur"
    NOTE }|--|| PROFESSEUR : "Attribuee_par"

    ADMINISTRATEUR ||--o{ ETUDIANT : "Valide (created_by)"
    ADMINISTRATEUR ||--o{ COURS : "Planifie (created_by)"
```

## Description des Associations

1. **S'inscrit_dans** : Un étudiant est rattaché à une et une seule filière. Une filière peut accueillir plusieurs étudiants (1,N).
2. **Contient** : Une filière est composée d'une ou plusieurs matières. Une matière appartient à une filière spécifique (1,1).
3. **Planification (Cours)** : Un cours est le croisement (association) entre une Filière, une Matière, un Professeur, une Salle, et des créneaux horaires.
4. **Évaluation (Note)** : Une note est attribuée à un Étudiant, pour une Matière donnée, par un Professeur donné.
