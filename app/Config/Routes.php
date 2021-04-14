<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'noauth']);
$routes->match(['get','post'], 'profil', 'User::profil', ['filter' => 'auth']);
$routes->match(['get','post'], 'addUser', 'User::addUser', ['filter' => 'isadmin']);
$routes->match(['get','post'], 'addChambre', 'Chambre::addChambre', ['filter' => 'isadmin']);
$routes->match(['get','post'], 'addClient', 'Client::addClient', ['filter' => 'auth']);
$routes->match(['get','post'], 'accueilClient', 'ReservationNuit::accueilClient', ['filter' => 'auth']);
$routes->match(['get','post'], 'reservationNuit', 'ReservationNuit::addReservationNuit', ['filter' => 'auth']);
$routes->match(['get','post'], 'reservationDay', 'ReservationDay::addReservationDay', ['filter' => 'auth']);
$routes->match(['get','post'], 'configClient', 'Client::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'configUser', 'User::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'configAdmin', 'Admin::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'configChambre', 'Chambre::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'configReservationNuit', 'ReservationNuit::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'configReservationDay', 'ReservationDay::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'ficheCardex', 'Cardex::index', ['filter' => 'auth']);
$routes->match(['get','post'], 'planningJour', 'Planning::planningJour', ['filter' => 'auth']);
// $routes->match(['get','post'], 'tabPlanningJour', 'Planning::tabPlanningJour', ['filter' => 'auth']);
$routes->match(['get','post'], 'planningMois', 'Planning::planningMois', ['filter' => 'auth']);
$routes->match(['get','post'], 'factureDay', 'Facture::factureDay', ['filter' => 'auth']);
$routes->match(['get','post'], 'factureNuit', 'Facture::factureNuit', ['filter' => 'auth']);
// $routes->post('nouveauUser', 'User::create', ['filter' => 'auth']);
// $routes->post('nouveauClient', 'Client::create', ['filter' => 'auth']);
// $routes->post('nouveauChambre', 'Chambre::create', ['filter' => 'auth']);
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('etatFinancier', 'Dashboard::etatFinancier', ['filter' => 'auth']);
$routes->get('statistique', 'Dashboard::statistique', ['filter' => 'auth']);
$routes->get('logout', 'Home::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
