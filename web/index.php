<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Separation\User;
use Separation\Path\PathResolver;
use Separation\Path\Api\Adapter\DummyAdapter as DummyApiAdapter;
use Separation\Path\Storage\Adapter\DummyAdapter as DummyGraphAdapter;
use Separation\Path\Factory\PathFactory;
use Separation\Path\Factory\UserFactory;
use Separation\Path\Factory\RepositoryFactory;
use Separation\Path\Exception\PathException;
use Separation\Payload\ResponsePayload;
use Separation\Payload\ErrorPayload;

$application = new Silex\Application();
$application['debug'] = true;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Endpoint for calculate the shortest distance by project between any 2 GitHub contributors
 */
$application->get('/separation/{user1}/{user2}', function ($user1, $user2) {

    $api = new \Separation\Path\Api\Api(
        new UserFactory(),
        new RepositoryFactory(),
        new \Separation\Path\Api\Adapter\CacheableAdapter(new \Separation\Path\Api\Adapter\GitHubAdapter(new \Github\Client()))
    );
    $storage = new \Separation\Path\Storage\Storage(new DummyGraphAdapter());
    $pathResolver = new PathResolver($api, $storage, new PathFactory());

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