<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../repository/cinema.php';

$app = new \Slim\App;
$cinema = new Cinema();


$app->post('/cinema', function (Request $request, Response $response, array $args) use ($cinema){
    try {
        $data = array(
            ":name" => $request->getParam('name'),
            ":type" => $request->getParam('type'), 
            ":category" => $request->getParam('category')
        );
        $result = $cinema->add($data);
        return $response->withJson($result, 200);
    } catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});


$app->get('/cinema', function (Request $request, Response $response, array $args) use ($cinema){
    try { 
        $result = $cinema->search();
        return $response->withJson($result, 200);
    }catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});

$app->get('/cinema/{query}', function (Request $request, Response $response, array $args) use ($cinema){
    try { 

        $query = $args['query'];
        $result = $cinema->find($query);

        return $response->withJson($result, 200);
    }catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});

$app->get('/recents', function (Request $request, Response $response, array $args) use ($cinema){
    try { 
        $result = $cinema->findRecents();
        return $response->withJson($result, 200);
    }catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});

$app->get('/betters', function (Request $request, Response $response, array $args) use ($cinema){
    try { 
        $result = $cinema->findBetters();
        return $response->withJson($result, 200);
    }catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});

$app->put('/cinema/eliminar/{id_cinema}', function (Request $request, Response $response, array $args) use ($cinema) {
    try {
        
        $idCinema = (int)$args['id_cinema'];
        
        $result = $cinema->delete($idCinema);
        return $response->withJson($result, 200);
    } catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});


$app->post('/cinema/calificar', function (Request $request, Response $response, array $args) use ($cinema) {
    try {

        $idCinema = (int)$request->getParam('id_cinema');
        $value = $request->getParam('value');

        $result = $cinema->qualify($idCinema, $value);
        return $response->withJson($result, 200);
    } catch (Exception $e) {
        return $response->withJson($e, 500);
    }
});

$app->run();