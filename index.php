<?php

    require 'vendor/autoload.php';
    use Guzzle\Http\Client as HttpClient;
    use Slim\Slim;

    $app = new Slim(array(
        'debug' => true
    ));
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->headers->set('Access-Control-Allow-Origin', '*');

    $app->get('/analytics/all/', function () {
        $client = new HttpClient();
        $response = $client->get('http://fake-api.com/?' . $_SERVER['QUERY_STRING'])->send();
        echo $response->getBody();
    });

    $app->run();
    
?>
