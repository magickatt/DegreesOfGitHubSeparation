<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Separation\User;
use Separation\Path\PathResolver;
use Separation\Path\Adapter\Api\DummyAdapter as DummyApiAdapter;
use Separation\Path\Adapter\Graph\DummyAdapter as DummyGraphAdapter;
use Separation\Path\Factory\PathFactory;
use Separation\Path\Factory\UserFactory;
use Separation\Path\Factory\RepositoryFactory;
use Separation\Path\Exception\PathException;
use Separation\Payload\ResponsePayload;
use Separation\Payload\ErrorPayload;

$application = new Silex\Application();
$application['debug'] = false;

/**
 * Endpoint for calculate the shortest distance by project between any 2 GitHub contributors
 */
$application->get('/separation/{user1}/{user2}', function ($user1, $user2) {

    $pathResolver = new PathResolver(new DummyApiAdapter(new UserFactory(), new RepositoryFactory()), new DummyGraphAdapter(), new PathFactory());

    try {
        $path = $pathResolver->resolvePathBetweenUsers(new User($user1), new User($user2));
        $payload = new ResponsePayload($path);
    } catch (PathException $exception) {
        $payload = new ErrorPayload($exception);
    }

    return new JsonResponse($payload->generatePayload());

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