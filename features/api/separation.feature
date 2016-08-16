Feature: API should return the shortest distance between two GitHub contributors by package

  Scenario: Calculate shortest distance between two contributors by package
    Given I want to calculate the shortest distance between the first user "stof" and second user "seldaek"
    When I ask the API to calculate the shortest distance
    Then I should discover the distance is "1"
    And I should discover that the repository path contains "stof/monolog"