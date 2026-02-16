<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
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

	$router->get('/villes', function () use ($app){
        $app->render('villes');
    });
	
	$router->get('/villes/ajouter', function () use ($app){
        $app->render('ville-ajouter');
    });

	$router->post('/villes/ajouter', [ VilleController::class, 'insertVille' ]);

	$router->group('/api', function() use ($router) {
		$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	});



	
}, [ SecurityHeadersMiddleware::class ]);
