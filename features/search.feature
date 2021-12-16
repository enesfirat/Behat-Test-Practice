Feature: search wikipedia
  In order to learn about BDD
  As a passionate developer
  I need to be able to search a general website

  Scenario: Search for BDD
    Given I am in wikipedia
    When I search for "Behaviour driven development"
    Then  The first heading should be "Behavior-driven development"
    And I wait for 5 seconds