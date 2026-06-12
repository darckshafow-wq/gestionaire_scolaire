# EPI Management : Rôles et Fonctions

Ce document définit les droits, prérogatives et fonctionnalités de chaque rôle au sein du système de gestion académique EPI Management. L'architecture de l'application repose sur la ségrégation des accès en fonction de 4 rôles principaux.

---

## 1. Directeur Général (DG)
**Niveau d'accès :** Supervision & Approbation Stratégique
Le DG est l'autorité supérieure de l'établissement. Il a une vue d'ensemble sur le bon fonctionnement de l'école et valide les recrutements.

### Fonctionnalités
- **Tableau de Bord Global :** Visualise les statistiques clés de l'établissement (nombre d'étudiants, filières actives, effectif enseignant).
- **Gestion du Corps Enseignant :**
  - Reçoit et consulte les candidatures des nouveaux professeurs.
  - Valide les profils pour les intégrer au personnel officiel.
  - Rejette les candidatures inappropriées.
- **Supervision Académique :** Consulte la liste de toutes les filières, leur niveau (Licence, Master) et leur statut.

---

## 2. Secrétaire
**Niveau d'accès :** Administration Opérationnelle & Académique
Le ou la secrétaire est la cheville ouvrière du système. Ce rôle gère l'infrastructure quotidienne (salles, filières) et la logistique des cours.

### Fonctionnalités
- **Tableau de Bord Administratif :** Vue sur l'état des inscriptions et l'occupation des salles.
- **Architecture Académique :**
  - **Filières :** Création, modification, suspension de filières.
  - **Matières :** Ajout de matières rattachées aux filières avec attribution du volume horaire et des **coefficients**.
- **Logistique :**
  - **Salles :** Gestion du parc immobilier (capacités, statuts de maintenance).
- **Emploi du Temps :**
  - Outil interactif interactif pour allouer des créneaux (salle, matière, professeur).
  - Gestion des conflits d'horaires.
- **Scolarité :**
  - Réception et traitement (validation/rejet) des dossiers d'inscription des nouveaux étudiants.

---

## 3. Professeur
**Niveau d'accès :** Pédagogique
L'enseignant interagit avec le système pour honorer ses cours et évaluer ses étudiants.

### Fonctionnalités
- **Candidature :** Processus initial d'inscription pour postuler (en attente de validation DG).
- **Tableau de Bord Pédagogique :**
  - Consulte son emploi du temps personnalisé.
  - Visualise la liste des filières et des classes qui lui sont assignées.
- **Évaluation :**
  - Sélectionne une de ses classes et saisit les notes sur 20 pour chaque étudiant.
  - Ajoute des appréciations textuelles.
  - Ces notes serviront au système pour le calcul automatisé de la moyenne pondérée.

---

## 4. Étudiant
**Niveau d'accès :** Consultation & Suivi Personnel
L'étudiant est l'utilisateur final du parcours éducatif. 

### Fonctionnalités
- **Portail d'Inscription :** Espace pour soumettre une nouvelle candidature à une filière.
- **Espace Personnel (Ancien/Validé) :**
  - **Tableau de bord :** Vue sur le prochain cours et les informations personnelles.
  - **Emploi du Temps :** Consulte le planning des cours rattaché à sa filière.
  - **Bulletins & Notes :** Consulte ses notes par matière (en fonction des évaluations effectuées par les professeurs) et sa moyenne globale calculée dynamiquement selon les coefficients.
