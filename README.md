# Agence immo
![w3c-badge](https://img.shields.io/badge/W3C-validation-green?style=for-the-badge)


## Technos
### Front-end&emsp; ![html5-badge](https://img.shields.io/badge/HTML5-orange?style=for-the-badge&color=f0632a) ![css3-badge](https://img.shields.io/badge/CSS3-blue?style=for-the-badge&color=3b9ad8) ![javascript-badge](https://img.shields.io/badge/JavaScript-yellow?style=for-the-badge&color=eed94d) ![jquery-badge](https://img.shields.io/badge/jQuery-blue?style=for-the-badge&color=0867af)
### Back-end &emsp; ![php-badge](https://img.shields.io/badge/PHP-9cf?style=for-the-badge&color=8a9bd4) ![sql-badge](https://img.shields.io/badge/SQL-orange?style=for-the-badge&color=e68d02)
### Framework&nbsp; ![bootstrap-badge](https://img.shields.io/badge/Bootstrap-blueviolet?style=for-the-badge&color=8c57d9)


## Description
Site de 3 pages réalisé lors de la première évaluation back-end et récompensé par quelque chose que je n'avais pas revu depuis longtemps... un 20/20 ! 😃

Création et gestion d'une base de données dans laquelle la table "logement" doit contenir les enregistrements d'annonces immobilières. Elles sont insérées via un formulaire sécurisé dont le contenu entrant est contrôlé côté serveur, afin de ne pas avoir de données manquantes ou d'un autre format que celui attendu, ou encore pour pallier à d'éventuelles injections ou failles XSS. Les photos étant, quant à elles, renommées avec un timestamp avant l'enregistrement.

Ces annonces peuvent ensuite être affichées sous forme de liste récapitulant l'ensemble des logements ou encore être consultées individuellement en détail avec leurs informations respectives.
L'utilisateur a également la possibilité de filtrer l'affichage des annonces selon leur type (vente ou location).

Contrairement aux autres projets que je développe désormais, celui-ci a été réalisé en programmation procédurale et avec une base de données demandée avec une table et des champs en français.


## Améliorations
- Afin d'optimiser l'expérience utilisateur en évitant le rechargement de page, l'affichage des annonces filtrées et le traitement de la validation des formulaires pourraient être améliorés en envoyant les requêtes au serveur de manière asynchrone (Ajax).

- Les fonctionnalités de modification et de suppression d'une annonce pourraient être ajoutées à la partie de gestion logement pour compléter les opérations CRUD ; éventuellement complétées par un compte utilisateur sécurisé disposant des autorisations pour effectuer ces requêtes.


## Aperçu
![screenshot](https://github.com/celine-trv/agence_immo/blob/master/screenshot.jpg)
