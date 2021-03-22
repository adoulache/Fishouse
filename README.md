## Pré-requis pour lancer le projet 

**Lancer les commandes** : 
- composer install 
- npm install 

**Créer la base de données**:<br>
Il est nécessaire de commencer par lancer XAMPP (ou Wamp / Mamp).
Ensuite, sur le site [PHPMyAdmin](http://localhost/phpmyadmin/), il faut créer une nouvelle base de données.
La nouvelle base de données se nomme "fishouse" et est encodée en "utf8mb4_general_ci".<br><br>
**Il faut ensuite lancer la commande** : 
- php artisan migrate:fresh (pour la première utilisation)

**Lancer les commandes**: 
- php artisan serve
- npm run watch

**Accéder à l'adresse** :
- [FisHouse](http://127.0.0.1:8000/)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## A propos de Laravel

Laravel est un framework d'application web à la syntaxe expressive et élégante. Nous pensons que le développement doit être une expérience agréable et créative pour être vraiment satisfaisant. Laravel rend le développement moins pénible en facilitant les tâches courantes utilisées dans de nombreux projets web, telles que :

- [Moteur de routage simple et rapide](https://laravel.com/docs/routing).
- [Puissant conteneur d'injection de dépendances](https://laravel.com/docs/container).
- Plusieurs back-ends pour le stockage de la [session](https://laravel.com/docs/session) et du [cache](https://laravel.com/docs/cache).
- Expressif, intuitif [base de données ORM](https://laravel.com/docs/eloquent).
- Agnostique des bases de données [migrations de schémas](https://laravel.com/docs/migrations).
- [Traitement robuste des tâches en arrière-plan](https://laravel.com/docs/queues).
- [Diffusion d'événements en temps réel](https://laravel.com/docs/broadcasting).

Laravel est accessible, puissant et fournit les outils nécessaires à la réalisation de grandes applications robustes.

## Apprendre Laravel

Laravel dispose de la plus complète et la plus approfondie [documentation](https://laravel.com/docs) et la bibliothèque de didacticiels vidéo de tous les cadres d'applications web modernes, ce qui facilite la prise en main du cadre.

Si vous n'avez pas envie de lire, [Laracasts](https://laracasts.com) peut aider. Laracasts contient plus de 1500 tutoriels vidéo sur un large éventail de sujets, dont Laravel, le PHP moderne, les tests unitaires et JavaScript. Améliorez vos compétences en vous plongeant dans notre vidéothèque complète.

## Sponsors de Laravel

Nous tenons à remercier les sponsors suivants pour le financement du développement de Laravel. Si vous êtes intéressé à devenir un sponsor, veuillez visiter la page Laravel [Patreon](https://patreon.com/taylorotwell).

### Premium Partners

- *[Vehikl](https://vehikl.com/)*
- *[Tighten Co.](https://tighten.co)*
- *[Kirschbaum Development Group](https://kirschbaumdevelopment.com)*
- *[64 Robots](https://64robots.com)*
- *[Cubet Techno Labs](https://cubettech.com)*
- *[Cyber-Duck](https://cyber-duck.co.uk)*
- *[Many](https://www.many.co.uk)*
- *[Webdock, Fast VPS Hosting](https://www.webdock.io/en)*
- *[DevSquad](https://devsquad.com)*
- *[Curotec](https://www.curotec.com/)*
- *[OP.GG](https://op.gg)*

##  Contribuer à

Merci d'envisager de contribuer au framework Laravel ! Le guide de la contribution se trouve dans la [documentation Laravel](https://laravel.com/docs/contributions).

## Code de conduite

Afin de garantir que la communauté Laravel est accueillante pour tous, veuillez lire et respecter le [Code de conduite](https://laravel.com/docs/contributions#code-of-conduct).

## Vulnérabilités de sécurité

Si vous découvrez une vulnérabilité en matière de sécurité dans Laravel, veuillez envoyer un courriel à Taylor Otwell à l'adresse suivante [taylor@laravel.com](mailto:taylor@laravel.com). Toutes les failles de sécurité seront traitées rapidement.

## Licence

Le framework Laravel est un logiciel à code source ouvert sous la licence [MIT](https://opensource.org/licenses/MIT).

## Note 

Readme traduit de la version par défaut de Laravel (à partir du logo de Laravel).