<?php

use app\controllers\BesoinVilleController;
use app\controllers\CategorieController;
use app\controllers\EtatController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers;
use app\controllers\DonController;
use app\controllers\TypeBesoinController;
use app\controllers\VilleController;
use app\controllers\DashboardController;
use app\controllers\DispatchController;
use app\models\AchatService;
use app\models\PurchaseService;
use app\models\Utils;
use app\controllers\HistoriqueController;

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

	$router->get('/besoins_reste', function () {
		$controller = new BesoinVilleController();
		$villeController = new VilleController();
		$villes = $villeController->getAllVille();

		$selectedVille = null;
		if (isset($_GET['ville']) && $_GET['ville'] !== '' && $_GET['ville'] !== '0') {
			$selectedVille = (int)$_GET['ville'];
		}

		$besoin = $controller->getBesoinsRestant($selectedVille);

		Flight::render('besoin-restant', [
			'besoin' => $besoin,
			'ville' => $villes,
			'selectedVille' => $selectedVille
		]);
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
		$cat = $categorieController->getAll();
		$villes = $villeController->getAllVille();
		$types  = $typeController->getAllType();
		Flight::render('besoin-ajouter', [
			'type' => $types,
			'ville'  => $villes,
			'categorie' => $cat
		]);
	});


	$router->post('/restore_initial', function () {
		header('Content-Type: application/json; charset=utf-8');
		try {
			$controller = new EtatController();
			$controller->rollback();
			echo json_encode([
				'success' => true,
				'message' => 'Jeu de donnees restaure avec succes.'
			]);
			return;
		} catch (\Throwable $e) {
			http_response_code(500);
			echo json_encode([
				'success' => false,
				'message' => 'Erreur : ' . $e->getMessage()
			]);
			return;
		}
	});


	$router->get('/ajout_don', function () {
		$typeController  = new TypeBesoinController();
		$types  = $typeController->getAllType();
		$categorieController = new CategorieController();
		$cat = $categorieController->getAll();
		Flight::render('don-ajouter', [
			'type' => $types,
			'categorie' => $cat
		]);
	});


	$router->post('/ajout_type', function () {
		$controller = new TypeBesoinController();
		$controller->create();
	});

	$router->post('/acheter', function () {
		header('Content-Type: application/json; charset=utf-8');
		$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;
		$id_besoin = isset($input['id_besoin']) ? (int)$input['id_besoin'] : 0;
		$qte_demande = isset($input['qte']) ? (float)$input['qte'] : 0;

		$db = Flight::db();
		$utils = new Utils($db);
		$service = new AchatService($db, $utils);

		$result = $service->processPurchase($id_besoin, $qte_demande);

		http_response_code($result['status']);
		echo json_encode($result['body']);
		return;
	});
	$router->post('/ajouter_besoin', function () {
		$controller = new BesoinVilleController();
		$controller->insererBesoin();
	});

	$router->post('/ajouter_dons', function () {
		$controller = new DonController();
		$controller->insert();
	});

	$router->get('/villes', function () use ($app) {
		$app->render('villes');
	});

	$router->get('/villes/ajouter', function () use ($app) {
		$app->render('ville-ajouter');
	});



	$router->get('/rapports', function () use ($app) {
		$app->render('rapports');
	});

	$router->get('/api/recapitulatif', [HistoriqueController::class, 'getRecapJson']);

	$router->post('/villes/ajouter', [VilleController::class, 'insertVille']);


	// Flight::route('/dispatch', function () {
	// 	$controller = new DispatchController();
	// 	$dispatch = $controller->simulateDispatch();

	// 	Flight::render('dispatch', ['dispatch' => $dispatch]);
	// });

	// Flight::route('POST /dispatch/valider', function () {
	// 	header('Content-Type: application/json; charset=utf-8');
	// 	$controller = new DispatchController();
	// 	try {
	// 		$message = $controller->validateDispatch();
	// 		echo json_encode(['success' => true, 'message' => $message]);
	// 	} catch (Exception $e) {
	// 		echo json_encode(['success' => false, 'message' => $e->getMessage()]);
	// 	}
	// });

	Flight::route('GET /dispatch/simuler', function() {
    $controller = new \app\controllers\DispatchController();
    $controller->simulateDispatch();
    // Flight::stop() est déjà appelé dans le contrôleur
});

Flight::route('POST /dispatch/valider', function() {
    $controller = new \app\controllers\DispatchController();
    $controller->validateDispatch();
    // Flight::stop() est déjà appelé dans le contrôleur
});

Flight::route('GET /dispatch', function() {
    Flight::render('dispatch'); // Ceci inclut modele.php
});

}, [SecurityHeadersMiddleware::class]);
