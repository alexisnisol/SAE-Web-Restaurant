<?php

namespace App\Views;

use App\Controllers\Auth\Auth;


use App\Controllers\SearchController;


class Router
{

    private static $template;

    public function __construct()
    {
        self::$template = new Template(ROOT . '/templates');
    }
    
    public static function render(string $view, string $title, array $cssFiles = [])
    {
        self::renderWithTemplate($view, $title, 'main', $cssFiles);
    }

    public static function renderWithTemplate(string $view, string $title, string $layout, array $cssFiles = [])
    {

        ob_start();
        require ROOT . '/templates/' . $view;
        $content = ob_get_clean();

        self::$template->setLayout($layout);
        self::$template->setTitle($title);
        self::$template->setCssFiles($cssFiles);
        self::$template->setContent($content);

        echo self::$template->compile();
    }

    public function execute() {
        if (isset($_GET['action']) && $_GET['action'] !== '') {
            $action = $_GET['action'];
        } else {
            $action = 'home';
        }

        switch ($action) {
            case 'home':
                self::render('home.php', 'Accueil', ['index.css', 'searchbar.css']);
                break;

            case 'login':
                self::render('auth/login.php', 'Connexion', ['form.css']);
                break;
            case 'register':
                self::render('auth/register.php', 'Inscription', ['form.css']);
                break;
            case 'logout':
                session_destroy();
                header('Location: /index.php');
                break;
            case 'visualisation':
                self::render('visualisation.php', 'Visualisation', ['visualisation.css']);
                break;
            case 'avis':
                self::render('avis.php', 'Vos avis', ['avis.css']);
                break;
            case 'a-propos':
                self::render('a-propos.php', 'À propos', ['a-propos.css']);
                break;
            case 'carte':
                self::render('carte.php', 'Carte', ['carte.css']);
                break;
            case 'profil' :
                self::render('auth/profil.php', 'Profil',['form.css']);
                break;
            case 'search':
                SearchController::search();
                self::render('home.php', 'Accueil', ['index.css', 'searchbar.css']);

            case 'dashboard':
                Auth::checkUserLoggedIn();
                self::render('admin/dashboard.php', 'Dashboard', ['form.css']);
                break;
            case 'ajouter_Modo':
                Auth::checkUserAdmin();
                self::render('admin/ajouter_moderateur.php', 'Ajouter un Modérateur', ['form.css']);
                break;
            case 'retirer_Modo':
                Auth::checkUserAdmin();
                self::render('admin/retirer_moderateur.php', 'Retirer un Modérateur', ['form.css']);
                break;
            default:
                self::render('404.php', 'Page introuvable', ['404.css']);
                break;
        }
    }
}

?>