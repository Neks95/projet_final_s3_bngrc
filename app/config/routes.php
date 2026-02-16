<?php

use app\controllers\ApiExampleController;
use app\controllers\BesoinVilleController;
use app\controllers\CategorieController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers;
use app\controllers\DonController;
use app\controllers\TypeBesoinController;
use app\controllers\VilleController;
use app\controllers\DashboardController;
use app\controllers\DispatchController;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

	
	// $router->get('/', function() use ($app) {
	// 	$app->render('index');
	// });
	
		
	$router->get('/', [DashboardController::class, 'index']);

	
	$router->get('/test', function () {
		$db = Flight::db();
		var_dump($db->query("SELECT version()")->fetch());
	});

	$router->get('/gestion_besoin', function () {
		$controller = new BesoinVilleController();
		$besoin = $controller->getAllBesoin();
		Flight::render('besoins', ['besoin' => $besoin]);
	});

	$router->get('/gestion_don', function () {
		$controller = new DonController();
		$dons = $controller->getAll();
		Flight::render('dons', ['don' => $dons]);
	});

	$router->get('/ajout_besoin', function () {
		$villeController = new VilleController();
		$typeController  = new TypeBesoinController();
		$categorieController = new CategorieController();
		$cat = $categorieController ->getAll();
		$villes = $villeController->getAllVille();
		$types  = $typeController->getAllType();
		Flight::render('besoin-ajouter', [
			'type' => $types,
			'ville'  => $villes,
			'categorie' => $cat
		]);
	});

	$router->get('/ajout_don', function () {
		$typeController  = new TypeBesoinController();
		$types  = $typeController->getAllType();
		$categorieController = new CategorieController();
		$cat = $categorieController ->getAll();
		Flight::render('don-ajouter', [
			'type' => $types,
			'categorie' => $cat
		]);
	});




	$router->post('/ajout_type', function () {
		$controller = new TypeBesoinController();
		$controller->create();
	});
	$router->post('/ajouter_besoin', function () {
		$controller = new BesoinVilleController();
		$controller->insererBesoin();
	});

	$router->post('/ajouter_dons', function () {
		$controller = new DonController();
		$controller->insert();
	});

	$router->get('/hello-world/@name', function ($name) {
		echo '<h1>Hello world! Oh hey ' . $name . '!</h1>';
	});


	$router->get('/villes', function () use ($app) {
		$app->render('villes');
	});

	$router->get('/villes/ajouter', function () use ($app) {
		$app->render('ville-ajouter');
	});
	



	$router->post('/villes/ajouter', [VilleController::class, 'insertVille']);

	$router->group('/api', function () use ($router) {
		$router->get('/users', [ApiExampleController::class, 'getUsers']);
		$router->get('/users/@id:[0-9]', [ApiExampleController::class, 'getUser']);
		$router->post('/users/@id:[0-9]', [ApiExampleController::class, 'updateUser']);
	});


Flight::route('/dispatch', function() {
	$controller = new DispatchController();
	$dispatch = $controller->simulateDispatch();

	Flight::render('dispatch', ['dispatch' => $dispatch]);
});

}, [SecurityHeadersMiddleware::class]);
