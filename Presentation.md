# Dossier de fake

### I. Présentation du projet global
![logo](/home/kuk666/programation/MGS/code/iroise_peche/commande/img/LOGO-IROISE.png  "iroisepeche")
**Iroise pêche** est un site web qui comprent une interface admin et un côté pulique (qui n'est pas encore développer).

Le principe de fonctionnement de l'entreprise est le suivant.

Le vendredi, le PO à connaisance des produits de la mer Breton qui seront disponible. 
Le samedi, cette liste est envoyer par mail à tous les clients. 
Il y as ensuite deux rappel, le lundi et le mardi, ou mercredi selon les produits.
Les clients envoient la liste des produit qu'il souhaite et les quantités.
Le mercredi soir les commandes sont closent. Elle seront ensuite livré le samedi, soit une semaine après le premier envoi.

**Le site côté client :**

Le site côté client est simple:

- une page d'acceuil avec inscription à la news letters.
- une section avec des idées de recettes et conseil de préparation pour chaque produit.
- une page avec la liste des produits de l'arrivage de la semaine.

**Côté Admin :**

- un système d'autentification (pas encore développer)
- un board pour naviger dans l'outil (pas encore développer)
- une interface pour programmer l'envoit des mails.
- **une interface pour édité la liste des produits pour un nouvel arrivage**

C'est cette dernière qui est la cible de cette présentation.

### II. Les contraintes

Différente contrainte ont guidé mes choix technologique.

Voici pour commencer la liste des technologie qui entre en jeu pour le projet:

- Tout le projet est dans le framework PHP Laravel. 
- Les composants front sont en Vue.js car il est intégré de base dans Laravel et que c'est un très bon choix pour faire des petits éléments dynamique que l'on peut facilement intégré dans un framework back.
- un outil externe, prestataire pour les campagnes d'email: **SendInBlue** . (la communication se fait via une API, on peut programer une campagne et gérer son contenu etc..).
- un outil pour la rédaction des mails: **mjml**. Une contrainte est ajouté pour les mail car beaucoup de client service de messagerie ne sont pas capable d'interprété le HTML5. Pour avoir un rendu mail qui soit responsive et simple à créer et maintenir, le framework **mjml** est tout addapté. Pour lui deux solution existe, la CLI et une API Distante avec autentification.
- Le moteur de templating PHP **Blade**, qui est intégré à Laravel.
- L'ORM Eloquent qui est l'ORM de Laravel.

Pour la page qui est présenté ici, il ne sera utiliser que Vue.js, Controleur et Model de Laravel.

### III. Description des fonctionalités de la page

**Liste des fonctionnalités front:**

Fonctionnalité|avancement|détail
-|-|-
Créer un produit|3/3 Terminé|Un bouton permet d'afficher le formulaire pour créer un produit.
Créer un packing|3/3 Terminé|Un bouton permet d'afficher le formulaire pour créer un packing.
Valider un packing|3/3 Terminé|Un bouton permet de valider le formulaire. La validité du formulaire sera vérifier et les donnée seront ajouté à l'objet de sortie global.
Valider un produit|3/3 Terminé|Un bouton permet de valider le formulaire. La validité du formulaire sera vérifier et les donnée seront ajouté à l'objet de sortie global.
Modifier un produit|0/3 En attente|Un icon de modification permet de modifier un produit déjà validé.
Modifier un packing|0/3 En attente|Un icon de modification permet de modifier un packing déjà validé.
Valider le liste final de tout les produits|3/3 Terminé| Un bouton permet de valider la liste finale des produits de l'arrivage. Un ensemble de donné formaté est envoyer au serveur en POST.

**Liste des fonctionnalité back:**

Fonctionnalité|avancement|détail
-|-|-
Récupérer les données en BDD et les formater|3/3 Terminé|Récupérer les données en BDD et les formater pour les passer en propriété de mon composant Vue. Ces données sont néssécaire pour la construction des formulaires et par conséquent doivent être immuable. 
Interpréter du mjml| 0/3 En attente| Interpréter du mjml pour créer un rendu pour des preview d'élément du mail. Ainsi chaque produit est tel qu'il sera dans le mail.
Récupérer les données finale et les inserer en BDD|3/3 Terminé|Récupérer les données finale emise par le composant front, les parser puis après les avoir vérifier elle sont insérées en BDD.

### IV. Processus de création de la page

Il as fallut commencer par **maquetter** cette page. Pour cela il as fallut concevoir le formulaire. 
Je dois répondre à plusieur contrainte qui sont une facilité d'utilisation optimisé, une imposibilité de faire des erreurs, des fautes d'orthographes, d'envoyer des données incohérentes.

J'ai donc choisi comme élement principal des select dont les option sont remplis des données de la BDD. De cette façon l'interface sera toujour la même, les options selectionné correspondront à un objet de données cohérentes. Tout les autre champ sont des input de type number sauf un input string.

Pour representé les différent états du formulaire voici un lien vers la maquettes visuelle réalisé avec le logiciel Figma:
[Maquette visuelle](https://www.figma.com/file/Rx7DWPzggXB7ceJDtTCXmWjC/Iroise-P%C3%AAche?node-id=7%3A1438) 
