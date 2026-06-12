# Modèle Conceptuel des Traitements (MCT)

Le Modèle Conceptuel des Traitements décrit les actions menées par le système en réponse à des événements externes, sans se soucier de qui fait quoi ni comment.

## Processus 1 : Inscription d'un Étudiant

```mermaid
flowchart TD
    E1(Nouvelle demande d'inscription) --> OP1
    OP1[Opération : Analyse du Dossier Etudiant]
    OP1 --> R1A(Dossier Incomplet / Rejeté)
    OP1 --> R1B(Dossier Valide)
    R1B --> OP2[Opération : Activation du Compte]
    OP2 --> R2(Compte Étudiant Actif)
```

**Règles d'émission :**
- L'opération "Analyse du Dossier" est déclenchée lors de la réception d'une inscription.
- L'opération "Activation du Compte" est déclenchée si le statut d'analyse est "Validé".

## Processus 2 : Validation d'un Professeur

```mermaid
flowchart TD
    E2(Nouvelle candidature Professeur) --> OP3
    OP3[Opération : Examen du Profil DG]
    OP3 --> R3A(Profil Rejeté)
    OP3 --> R3B(Profil Approuvé)
    R3B --> OP4[Opération : Attribution d'Accès]
    OP4 --> R4(Compte Professeur Actif)
```

**Règles d'émission :**
- Le DG reçoit les candidatures en attente.
- L'approbation d'un profil déclenche l'attribution d'un mot de passe et l'ouverture des accès.

## Processus 3 : Planification des Cours

```mermaid
flowchart TD
    E3(Début de semaine / Besoin de cours) --> OP5
    OP5[Opération : Création de l'Emploi du Temps]
    OP5 --> R5A(Conflit détecté: Salle ou Professeur occupé)
    OP5 --> R5B(Créneau libre)
    R5B --> OP6[Opération : Enregistrement du Cours]
    OP6 --> R6(Cours Planifié et Notifié)
```

**Règles d'émission :**
- Le système vérifie la disponibilité de la Salle et du Professeur pour l'heure indiquée.
- Si le créneau est disponible, le cours est enregistré dans `planning_cours`.

## Processus 4 : Évaluation (Saisie des Notes)

```mermaid
flowchart TD
    E4(Période d'évaluation terminée) --> OP7
    OP7[Opération : Saisie des Notes par le Professeur]
    OP7 --> R7A(Notes manquantes ou invalides)
    OP7 --> R7B(Notes correctement saisies)
    R7B --> OP8[Opération : Calcul des Moyennes]
    OP8 --> R8(Bulletins / Moyennes Disponibles)
```

**Règles d'émission :**
- Le professeur saisit les notes pour les matières qu'il enseigne.
- Le calcul de la moyenne de l'étudiant tient compte du coefficient (`coefficient`) de chaque matière.
