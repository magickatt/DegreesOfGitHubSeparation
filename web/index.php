<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Separation\Path\PathResolver;
use Separation\Path\Adapter\Api\DummyAdapter as DummyApiAdapter;
use Separation\Path\Adapter\Graph\DummyAdapter as DummyGraphAdapter;
use Separation\Path\PathFactory;
use Separation\User;
use Separation\ResponsePayload;

$application = new Silex\Application();

/**
 * Endpoint for calculate the shortest distance by project between any 2 GitHub contributors
 */
$application->get('/separation/{user1}/{user2}', function ($user1, $user2) {

    $pathResolver = new PathResolver(new DummyApiAdapter(), new DummyGraphAdapter(), new PathFactory());
    $path = $pathResolver->resolvePathBetweenUsers(new User($user1), new User($user2));

    $responsePayload = new ResponsePayload($path);
    return new JsonResponse($responsePayload->generatePayload());

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