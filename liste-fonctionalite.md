# listes des fonctionnalitées et des pages


## Côté Public:

**Pages :**

Nom page | code page | adresse | description| fonctionnalités présentes
-|-|-|-|-
Accueil|P-001|`/`|Page d'accueil du site. De la les utilisateur et l'admin peuvent naviger entre les page.| Abbonement NewsLetters - Barre de navigation
Produits|P-010|`/produits`|Page ou l'utilisateur peut consulter le catalogue des produits avec tout ce qui est rattaché| Navigation dans les produits - détails - recettes

**Fonctionnalité :**

Nom Fonct.| code fonct. | description | présent dans:
-|-|-|-
Abbonement NewsLetters| FP-01| l'utilisateur dois pouvoir inscrire son mail pour s'abboner à la newletters. | P-001
Barre de navigation | FP-02 | L'utilisateur doit pouvoir se déplacer dans le site grâce à la barre de navigation| toutes

## Côté Admin:

**Pages :**

Nom page | code page | adresse | description| fonctionnalités présentes
-|-|-|-|
Board|A-001|/admin/board|Tableau de bord de l'interface admin|
set-arrival|A-011|/admin/arrival/set| Page de mise a jours de la liste des produit de l'arrivage en cours| ajouter, modifier et supprimer des produits - ajout des packing

**Fonctionnalité :**

Nom Fonct.| code fonct. | description | présent dans:
-|-|-|-
Ajouter, modifier et supprimer des produits| FA-01| crud pour les produits de l'arrivage en cours| A-011
Ajouter, modifier et supprimer des packing | FA-02| crud pour les packing de l'arrivage en cours| A-011