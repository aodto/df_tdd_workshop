<?php
require_once __DIR__.'/vendor/autoload.php'; 
require_once 'WineDaoPdo.php';
require_once 'WineController.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application(); 
$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app['wine_dao_pdo'] = $app->share(function() {
  return new WineDaoPdo();
});

$app['wines.controller'] = $app->share(function() use ($app) {
  return new WineController($app);
});

$app->get('/wines', 'wines.controller:getAllWine');

$app->delete('/wines/{id}', 'wines.controller:deleteWine');

$app->post('/wines', 'wines.controller:insertWine');

$app->put('/wines/{id}', 'wines.controller:updateWine');

$app->post('/wines/search','wines.controller:searchWine'); 

$app->run(); 
