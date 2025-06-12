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
use App\Controller\QRCodeController;


$customUrl = new CampagnRepository;
$ThisUrl = $customUrl-> getCampagnByUrl(urldecode($_GET['page']));
if (isset($ThisUrl)){
    if ($ThisUrl->getType() == 'custom') {
        $AfficherCustom = new CustomController();
        $AfficherCustom -> AfficherCustom($ThisUrl->getId());
        exit();
    } else if ($ThisUrl->getType() == 'pre-defined') {
        if ($ThisUrl->getPredefined() == 'Facebook') {
            $AfficherFacebook = new FacebookController();
            $AfficherFacebook -> AfficherFacebookCamp($ThisUrl->getId());
            exit();
        } else if ($ThisUrl->getPredefined() == 'Google') {
            $AfficherGoogle = new GoogleController();
            $AfficherGoogle -> AfficherGoogleCamp($ThisUrl->getId());
            exit();
        }
    }
}

$url = $_GET['page'] ?? '/';
$url = trim($url, '/');

$segments = explode('/', $url);
$publicRoutes = ['login', 'logout', 'facebook', 'custom','google', 'qrcode'];

if (!in_array($segments[0], $publicRoutes) && empty($_SESSION['user_id'])) {
    $AfficherUser = new LoginController();
    $AfficherUser->AfficherLogin();
    exit();
}


if (!empty($segments)) {
    switch ($segments[0]) {
        case 'acceuil':
                $AfficherAcceuil = new AcceuilController();
                $AfficherAcceuil -> AfficherAcceuil();
            break;
        case 'campaigns':
            $AfficherCampagn = new CampagnController();
            if (!isset($segments[1])) {
                $AfficherCampagn -> AfficherCampagn();
                break;
            } else if ($segments[1] == 'create') {
                $AfficherCampagn -> create();
                break;
            } else if ($segments[1] == 'update') {
                $AfficherCampagn -> update($segments[2]);
                break;
            } else if ($segments[1] == 'results') {
                $AfficherCampagn -> results($segments[2]);
                break;
            } else if ($segments[1] == 'delete') {
                $AfficherCampagn -> delete($segments[2]);
                break;
            } else if ($segments[1] == 'formulaire') {
                if (isset($segments[2]) && is_numeric($segments[2])) {
                    $AfficherCampagn -> formulaire($segments[2]);
                    break;
                } else if ($segments[2] == 'create') {
                    $AfficherCampagn -> createFormulaire($segments[3]);
                    break;
                } else if ($segments[2] == 'update') {
                    $AfficherCampagn -> updateFormulaire($segments[3]);
                    break;
                } else if ($segments[2] == 'delete') {
                    $AfficherCampagn -> deleteFormulaire($segments[3]);
                    break;
                }
            } else {
                $AfficherCampagn -> AfficherCampagn();
                break;
            }
        case 'facebook':
            if (isset($segments[1]) && $segments[1] == 'create') {
                $AfficherCampagn = new FacebookController();
                $AfficherCampagn -> create();
                break;
            }
            break;
        case 'custom':
            if (isset($segments[1]) && $segments[1] == 'create') {
                $AfficherCustom = new CustomController();
                $AfficherCustom -> create();
                break;
            }
            break;
        case 'google':
            if (isset($segments[1]) && $segments[1] == 'create') {
                $AfficherGoogle = new GoogleController();
                $AfficherGoogle -> create();
                break;
            }
            break;
        case 'qrcode':
            if (isset($segments[1]) && $segments[1] == 'get') {
                $AfficherGoogle = new QRCodeController();
                $AfficherGoogle -> get();
                break;
            }
            break;
        case 'list':
            $AfficherListe = new ListController();
            $AfficherListe -> AfficherListe($segments[1]);
            break;
        case 'about':
            echo "Page À propos";
            break;
        case 'user':
            $AfficherUser = new UserController();
            if (!isset($segments[1])) {
                $AfficherUser -> AfficherUser();
                break;
            } else if ($segments[1] == 'mail' && isset($segments[2]) && is_numeric($segments[2])) {
                $AfficherUser -> EnvoieMail($segments[2]);
                break;
            }
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
            break;
        case 'logout':
            $AfficherUser = new LoginController();
            $AfficherUser -> logout();
            break;
        case '':
            header('Location: acceuil');
            exit();
            break;
        default:
            http_response_code(404);
            echo "Erreur 404 : Page non trouvée.";
            break;
    }
}

http_response_code(404);
