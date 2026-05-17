<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('page/(:segment)', 'Pages::show/$1');

$routes->match(['get', 'post'], 'inscription', 'Auth::register');
$routes->match(['get', 'post'], 'connexion', 'Auth::login');
$routes->get('deconnexion', 'Auth::logout');
$routes->match(['get', 'post'], 'mot-de-passe-oublie', 'Auth::forgotPassword');
$routes->match(['get', 'post'], 'reinitialiser-mot-de-passe', 'Auth::resetPassword');

$routes->get('diagnostic', 'Diagnostic::index');
$routes->post('diagnostic/calculer', 'Diagnostic::calculate');
$routes->get('diagnostic/resultats', 'Diagnostic::history', ['filter' => 'auth']);

$routes->group('compte', ['filter' => 'auth'], static function ($routes) {
    $routes->match(['get', 'post'], '/', 'Account::profile');
});

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('utilisateurs', 'Admin\Users::index');
    $routes->post('utilisateurs/(:num)/role', 'Admin\Users::role/$1');
    $routes->post('utilisateurs/(:num)/statut', 'Admin\Users::status/$1');
    $routes->post('utilisateurs/(:num)/supprimer', 'Admin\Users::delete/$1');

    $routes->get('pages', 'Admin\Pages::index');
    $routes->match(['get', 'post'], 'pages/creer', 'Admin\Pages::create');
    $routes->match(['get', 'post'], 'pages/(:num)/modifier', 'Admin\Pages::edit/$1');
    $routes->post('pages/(:num)/supprimer', 'Admin\Pages::delete/$1');

    $routes->get('diagnostic', 'Admin\DiagnosticEvents::index');
    $routes->match(['get', 'post'], 'diagnostic/creer', 'Admin\DiagnosticEvents::create');
    $routes->match(['get', 'post'], 'diagnostic/(:num)/modifier', 'Admin\DiagnosticEvents::edit/$1');
    $routes->post('diagnostic/(:num)/statut', 'Admin\DiagnosticEvents::status/$1');
});
