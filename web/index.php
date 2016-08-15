<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$application = new Silex\Application();

/**
 * Endpoint for calculate the shortest distance by project between any 2 GitHub contributors
 */
$application->get('/separation/{user1}/{user2}', function ($user1, $user2) {
    return "Hello $user1 and $user2";
});

/**
 * Pre-flight for only endpoint (above)
 */
$application->options('/separation/{user1}/{user2}', function() {
    $response = new Response();
    $response->headers->set('Access-Control-Allow-Methods', 'GET');
    return $response;
});

$application->run();