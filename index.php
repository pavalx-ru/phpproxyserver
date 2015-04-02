<?php

    require 'vendor/autoload.php';
    use Guzzle\Http\Client as HttpClient;
    use Slim\Slim;

    $app = new Slim(array(
        'debug' => true
    ));
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->headers->set('Access-Control-Allow-Origin', '*');

    $app->get('/faketoken', function () {
        $token = new stdClass();
        $token->token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16);
        $token->expires_at = time() - (rand(1,5)) + 60;
        echo json_encode($token);
    });

    $app->get('/token', function () {
        $client = new HttpClient();
        $response = $client->get('http://api-dev.theorchard.io/auth/session/?token=d354fb818a642012c1f6189141f1ac9f&client=5656789871&user=8736')->send();
        echo $response->getBody();        
    });

    $app->get('/analytics/all/', function () {
        $client = new HttpClient();
        $response = $client->get('http://api-dev.theorchard.io/analytics/all/?' . $_SERVER['QUERY_STRING'])->send();
        echo $response->getBody();
    });

    $app->run();
    
?>