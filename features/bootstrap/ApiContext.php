<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class ApiContext implements Context, SnippetAcceptingContext
{
    const API_ENDPOINT = 'separation';

    private $baseUrl = 'http://localhost';

    private $user1;

    private $user2;

    /**
     * @param $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @Given I want to calculate the shortest distance between the first user :user1 and second user :user2
     */
    public function iWantToCalculateTheShortestDistanceBetweenTheFirstUserAndSecondUser($user1, $user2)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    /**
     * @When I ask the API to calculate the shortest distance
     */
    public function iAskTheApiToCalculateTheShortestDistance()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request(
            'GET',
            $this->baseUrl.'/'.implode('/', [self::API_ENDPOINT, $this->user1, $this->user2]),
            [],
            ['exceptions' => false]
        );

        PHPUnit_Framework_Assert::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @Then I should discover the distance is :distance
     */
    public function iShouldDiscoverTheDistanceIs($distance)
    {
        throw new PendingException();
    }

    /**
     * @Then I should discover that the repository path is :path
     */
    public function iShouldDiscoverThatTheRepositoryPathIs($path)
    {
        throw new PendingException();
    }
}
