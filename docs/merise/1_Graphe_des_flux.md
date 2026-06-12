# Graphe des Flux (Modèle Conceptuel de Communication)

Le graphe des flux représente les échanges d'informations entre les différents acteurs (internes et externes) du système de gestion scolaire EPI Management.

## Acteurs du système
- **Acteurs externes :** Candidat / Nouvel Étudiant, Professeur (Candidat)
- **Acteurs internes :** Secrétaire, Directeur Général (DG), Étudiant (Validé), Professeur (Validé), Système

## Diagramme des Flux (Mermaid)

```mermaid
graph TD
    %% Acteurs
    CandidatEtudiant([Nouvel Étudiant])
    EtudiantValide([Étudiant Validé])
    CandidatProf([Professeur Postulant])
    Professeur([Professeur Validé])
    Secretaire([Secrétaire])
    DG([Directeur Général])
    Systeme((Système EPI Management))

    %% Flux d'information - Inscription Etudiant
    CandidatEtudiant -- "1. Demande d'inscription + Dossier" --> Systeme
    Systeme -- "2. Notifie nouvelle inscription" --> Secretaire
    Secretaire -- "3. Valide/Rejette le dossier" --> Systeme
    Systeme -- "4. Notifie statut (Accès accordé)" --> EtudiantValide

    %% Flux d'information - Candidature Professeur
    CandidatProf -- "5. Demande de poste + CV" --> Systeme
    Systeme -- "6. Notifie nouvelle candidature" --> DG
    DG -- "7. Valide/Rejette profil & Affecte mot de passe" --> Systeme
    Systeme -- "8. Notifie identifiants" --> Professeur

    %% Flux d'information - Gestion Académique (Secrétaire)
    Secretaire -- "9. Crée Filières, Matières, Salles" --> Systeme
    Secretaire -- "10. Planifie l'emploi du temps" --> Systeme

    %% Flux d'information - Professeur (Notes & Cours)
    Systeme -- "11. Consulte emploi du temps" --> Professeur
    Professeur -- "12. Saisit notes et appréciations" --> Systeme

    %% Flux d'information - Etudiant (Consultation)
    Systeme -- "13. Consulte emploi du temps et notes" --> EtudiantValide
    
    %% Flux d'information - DG (Supervision)
    Systeme -- "14. Consulte statistiques (Tableau de bord)" --> DG
```

## Description des Flux Principaux

1. **Processus d'Inscription (Flux 1 à 4) :**
   Un candidat soumet son dossier en ligne. Le Secrétaire analyse les informations. Si le dossier est validé, le compte de l'étudiant devient actif et il peut accéder à son portail.

2. **Processus de Recrutement Enseignant (Flux 5 à 8) :**
   Un candidat professeur s'inscrit sur la plateforme. Son profil reste inactif (statut "En attente") jusqu'à ce que le Directeur Général (DG) examine son dossier, valide sa candidature et lui génère un mot de passe pour accéder à son espace.

3. **Planification Académique (Flux 9 à 10) :**
   Le Secrétaire est l'architecte de la structure académique. Il configure les Salles, les Filières, les Matières, et gère l'emploi du temps via l'interface interactive (Drag & Drop).

4. **Saisie des Notes (Flux 11 à 12) :**
   Le Professeur se connecte, voit ses classes assignées (via l'emploi du temps), et saisit les notes de ses étudiants. 

5. **Consultation & Supervision (Flux 13 à 14) :**
   Les Étudiants se connectent pour voir leurs résultats scolaires et l'emploi du temps. Le DG dispose d'un tableau de bord global pour superviser l'ensemble des activités.
