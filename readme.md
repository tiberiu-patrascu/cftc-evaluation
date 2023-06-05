## Liste d'utilisateurs

Pour pouvoir fonctionner la connexion à la base de données il faut rentrer dans le fichier .htaccess et modifier les variable globale avec les données que vous avez inscrit lors de la création de la base de données. Pour pouvoir fonctionner la connexion à la base de données il faut rentrer dans le fichier .htaccess et modifier les variables globale avec les données que vous avez inscrit lors de la creation de la base de données.

Dans le fichier sql-modifie.sql on peut trouver la création de la nouvelles base des données ainsi la table avec les données à rajouter. Dans le fichier sql-modifie.sql on peut trouver la création de la nouvelles base des données ainsi la table avec les données à rajouter.

### Préconisations

* utilisation d'un id qui s'auto-incrémente non null pour éviter les
  erreurs et les comportements inattendus dans les requêtes qui utilisent cette colonne.
* utiliser un algorithme de hachage fort et irréversible pour stocker les mots de passes dans la base des données.
* utilisation d'un système d'authentification pour éviter d'avoir les données en public.
* Comme il y a une table utilisateur c'est recommandé d'utiliser l'atribut NOT NULL pour au moins le champ logie et le mot de passe

### Points de vigilance

* filtrage sur les données envoyées via le formulaire.
* eviter le stockage des mots des passes en dure dans la base des données.

### Évolutions

* Creation d'un modal pour editer l'utilisateur
* Créer un système d'authentification et donner des rôles pour l'administrateur et les utilisateurs
* Ajouter plusieurs champs dans la table comme nom, prenom, âge, sex, numero de téléphone
* Ajouter d'autre tables ou l'id va être la clé étrangère
* D'autres fonctionnalités en fonction de l'utilisation de l'application comme exemple la gestion des employés, la gestion des clients.

### Logicieles utilise

* Virtual studio code
* XAMPP
* CHROME
