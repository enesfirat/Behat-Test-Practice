Feature: search Wikipedia
  In order to learn about BDD
  As a passionate developer
  I need to be able to search a general website

  Scenario: Search for BDD
    Given I am in Wikipedia
    When I search for "Behavior driven development"
    Then the first heading should be "Behavior-driven development"
    And I wait for 5 seconds