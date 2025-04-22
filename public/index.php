<?php

namespace App;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use App\Controller\AcceuilController;
use App\Controller\CampagnController;
use App\Controller\DataController;
use App\Controller\ListController;
use App\Controller\UserController;

// L'index.php nous servira de routeur : c'est le point d'entrée de notre application :
// Il va traiter les requêtes HTTP et appeler les bons contrôleurs en fonction de l'URL demandée.

// Première étape : on récupère l'URL à partir de la requête HTTP :
// Le .htaccess redirige toutes les requêtes vers index.php, et ajoute l'URL demandée en paramètre GET 'page'.

// Vérifie si l'URL est présente dans les paramètres GET; sinon, utilise '/' comme valeur par défaut.
$url = $_GET['page'] ?? '/';

// Supprime les barres obliques en début et en fin de l'URL pour normaliser le chemin.
$url = trim($url, '/');

// var_dump($url);

// Divise l'URL en segments basés sur chaque barre oblique, stockant les résultats dans un tableau.
$segments = explode('/', $url);

// Affiche le tableau de segments pour déboguer (à supprimer ou commenter en prod, biensûr).
// var_dump($segments);

// Par exemple : 
// Si l'URL est '/bagarre/42', $segments contiendra ['bagarre', '42'].
// Si l'URL est '/about', $segments contiendra ['about'].
// Si l'URL est '/', $segments contiendra [].
// etc...

// Le fait d'adopter une structure de type /element1/element2/element3 permet de créer des routes plus facilement.
// Par exemple, on pourrait imaginer que /bagarre/42 affiche la bagarre n°42, et /about affiche la page "À propos".
// Que /bagarre/42/editer affiche un formulaire d'édition pour la bagarre n°42, etc...

// On appelle cette approche RESTful routing : https://en.wikipedia.org/wiki/Representational_state_transfer#Applied_to_Web_services
// C'est une convention très répandue pour structurer les applications web, notamment les API.

// On peut maintenant utiliser les segments pour déterminer quelle page afficher.

// Vérifie si le tableau de segments n'est pas vide pour éviter d'exécuter le switch sur un tableau vide.
if (!empty($segments)) {
    // Utilise le premier segment de l'URL comme indicateur pour le routage.
    
    switch ($segments[0]) {
            // Pour le CRUD personnage
        case 'acceuil':
                $AfficherAcceuil = new AcceuilController();
                $AfficherAcceuil -> AfficherAcceuil();
            break;
            // Cas où le premier segment de l'URL est 'about'.
        case 'campaigns':
    
            if (!isset($segments[1])) {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> AfficherCampagn();
                break;
            } else if ($segments[1] == 'create') {

                var_dump($segments[1]);
                die;
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> create();
                break;
            } else if ($segments[1] == 'update') {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> update($segments[2]);
                break;
            } else if ($segments[1] == 'results') {
                $AfficherCampagn = new CampagnController();
                //$AfficherCampagn -> results($segments[2]);
                break;
            } else {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> AfficherCampagn();
                break;
            };
        case 'list':
            $AfficherListe = new ListController();
            $AfficherListe -> AfficherListe($segments[1]);
            break;
        case 'about':
            // Affiche la page "À propos".
            echo "Page À propos";
            break;
        case 'user':
            $AfficherUser = new UserController();
            $AfficherUser -> AfficherUser();
            break;       
            // Si aucun des cas ci-dessus ne correspond, le comportement par défaut est d'afficher la page d'accueil.
        case '': // Cas où l'URL est vide : page d'accueil. (Pour l'instant on redirige vers la liste des personnages)
            header('Location: acceuil');
            exit();
            break;
        default:
            http_response_code(404); // Retourne un code HTTP 404 Not Found.
            echo "Erreur 404 : Page non trouvée.";
            break;
    }
}

http_response_code(404); // Retourne un code HTTP 404 Not found si le code atteint ce point.
