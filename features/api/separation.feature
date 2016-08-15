Feature: API should return the shortest distance between two GitHub contributors by package

  Scenario: Calculate shortest distance between two contributors by package
    Given I want to calculate the shortest distance between the first user "Seldaek" and second user "Stof"
    When I ask the API to calculate the shortest distance
    Then I should discover the distance is "1"
    And I should discover that the repository path is "monolog/monolog"