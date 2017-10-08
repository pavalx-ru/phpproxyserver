<?php

    require 'vendor/autoload.php';
    use Guzzle\Http\Client as HttpClient;
    use Slim\Slim;

    $app = new Slim([
        'debug' => true
    ]);
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->headers->set('Access-Control-Allow-Origin', '*');

    $app->get('/analytics/all/', function () use($app) {
        $client = new HttpClient();
        $response = $client->get('http://fake-api.com/?' . $app->request->getQuery())->send();
        echo $response->getBody();
    });

    $app->run();
