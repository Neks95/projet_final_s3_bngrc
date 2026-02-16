<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers;
use app\controllers\BesoinVilleController;
use app\controllers\TypeBesoinController;
use app\controllers\VilleController;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$app->render('index');
	});

	$router->get('/test', function () {
	$db = Flight::db();
	var_dump($db->query("SELECT version()")->fetch());
    });

	$router->get('/gestion_besoin',function(){
		$controller = new BesoinVilleController();
		$besoin = $controller->getAllBesoin();
		Flight::render('besoins',['liste_besoin' => $besoin]);
	});

	$router->get('/ajout_besoin',function(){
		$c1 = new VilleController();
		$villes = $c1->getAllVille();
		$c2 = new TypeBesoinController();
		Flight::render('besoin-ajouter',
		['ville' => $villes,'type' => $c2->getAlltype()]
		);
	});

	$router->post('/inserer_besoin',function(){
		

	});

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	$router->group('/api', function() use ($router) {
		$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	});



	
}, [ SecurityHeadersMiddleware::class ]);
