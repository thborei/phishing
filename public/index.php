<?php

namespace App;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use App\Controller\AcceuilController;
use App\Controller\CampagnController;
use App\Controller\DataController;
use App\Controller\ListController;
use App\Controller\UserController;
use App\Controller\FacebookController;
use App\Controller\LoginController;
use App\Controller\CustomController;
use App\Repository\CampagnRepository;
use App\Controller\GoogleController;

// L'index.php nous servira de routeur : c'est le point d'entrée de notre application :
// Il va traiter les requêtes HTTP et appeler les bons contrôleurs en fonction de l'URL demandée.
$customUrl = new CampagnRepository;
$ThisUrl = $customUrl-> getCampagnByUrl($_GET['page']);
if (isset($ThisUrl)){
    if ($ThisUrl->getType() == 'custom') {
        $AfficherCustom = new CustomController();
        $AfficherCustom -> AfficherCustom($ThisUrl->getId());
        exit();
}};

// Première étape : on récupère l'URL à partir de la requête HTTP :
// Le .htaccess redirige toutes les requêtes vers index.php, et ajoute l'URL demandée en paramètre GET 'page'.

// Vérifie si l'URL est présente dans les paramètres GET; sinon, utilise '/' comme valeur par défaut.
$url = $_GET['page'] ?? '/';
// Supprime les barres obliques en début et en fin de l'URL pour normaliser le chemin.
$url = trim($url, '/');

// var_dump($url);

// Divise l'URL en segments basés sur chaque barre oblique, stockant les résultats dans un tableau.
$segments = explode('/', $url);
$publicRoutes = ['login', 'logout', 'facebook', 'custom']; // Pages qui ne nécessitent PAS d'être connecté
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

if (!in_array($segments[0], $publicRoutes) && empty($_SESSION['user_id'])) {
    // L'utilisateur n'est PAS connecté et veut accéder à une page privée
    $AfficherUser = new LoginController();
    $AfficherUser->AfficherLogin();
    exit();
}

// Vérifie si le tableau de segments n'est pas vide pour éviter d'exécuter le switch sur un tableau vide.
if (!empty($segments)) {
    switch ($segments[0]) {
        case 'acceuil':
                $AfficherAcceuil = new AcceuilController();
                $AfficherAcceuil -> AfficherAcceuil();
            break;
        case 'campaigns':
            if (!isset($segments[1])) {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> AfficherCampagn();
                break;
            } else if ($segments[1] == 'create') {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> create();
                break;
            } else if ($segments[1] == 'update') {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> update($segments[2]);
                break;
            } else if ($segments[1] == 'results') {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> results($segments[2]);
                break;
            } else if ($segments[1] == 'formulaire') {
                if (isset($segments[2]) && is_numeric($segments[2])) {
                    $AfficherCampagn = new CampagnController();
                    $AfficherCampagn -> formulaire($segments[2]);
                    break;
                } else if ($segments[2] == 'create') {
                    $AfficherCampagn = new CampagnController();
                    $AfficherCampagn -> createFormulaire($segments[3]);
                    break;
                } else if ($segments[2] == 'update') {
                    $AfficherCampagn = new CampagnController();
                    $AfficherCampagn -> updateFormulaire($segments[3]);
                    break;
                } else if ($segments[2] == 'delete') {
                    $AfficherCampagn = new CampagnController();
                    $AfficherCampagn -> deleteFormulaire($segments[3]);
                    break;
                }
            } else {
                $AfficherCampagn = new CampagnController();
                $AfficherCampagn -> AfficherCampagn();
                break;
            };
        case 'facebook':
            if (!isset($segments[1])) {
                $AfficherFacebook = new FacebookController();
                $AfficherFacebook -> AfficherFacebook();
                break;
            } else if (isset($segments[1]) && is_numeric($segments[1])) {
                $AfficherCampagn = new FacebookController();
                $AfficherCampagn -> AfficherFacebookCamp($segments[1]);
                break;
            }else if ($segments[1] == 'create') {
                $AfficherCampagn = new FacebookController();
                $AfficherCampagn -> create();
                break;
            }
        case 'custom':
            if (!isset($segments[1])) {
                $AfficherCustom = new CustomController();
                $AfficherCustom -> AfficherCustom($segments[1]);
                break;
            } else if ($segments[1] && is_numeric($segments[1])) {
                $AfficherCustom = new CustomController();
                $AfficherCustom -> AfficherCustom($segments[1]);
                break;
            }
            else if ($segments[1] == 'create') {
                $AfficherCustom = new CustomController();
                $AfficherCustom -> create();
                break;
            }
        case 'google':
            if (!isset($segments[1])) {
                $AfficherGoogle = new GoogleController();
                $AfficherGoogle -> AfficherGoogle();
                break;
            } else if ($segments[1] == 'create') {
                $AfficherGoogle = new DataController();
                $AfficherGoogle -> create();
                break;
            } else if (isset($segments[1]) && is_numeric($segments[1])) {
                $AfficherGoogle = new DataController();
                $AfficherGoogle -> AfficherGoogleCamp($segments[1]);
                break;
            }
        case 'list':
            $AfficherListe = new ListController();
            $AfficherListe -> AfficherListe($segments[1]);
            break;
        case 'about':
            echo "Page À propos";
            break;
        case 'user':
            $AfficherUser = new UserController();
            $AfficherUser -> AfficherUser();
            break;
        case 'login':
            if (!isset($segments[1])) {
                $AfficherUser = new LoginController();
                $AfficherUser -> AfficherLogin();
                break;
            } else if ($segments[1] == 'log') {
                $AfficherUser = new LoginController();
                $AfficherUser -> login();
                break;
            }
        case 'logout':
            $AfficherUser = new LoginController();
            $AfficherUser -> logout();
            break;
        case '':
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
