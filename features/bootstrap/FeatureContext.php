<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given I am in wikipedia
     */
    public function iAmInWikipedia()
    {
        $this->visitPath("/");
    }

    /**
     * @When I search for :searchString
     */
    public function iSearchFor($searchString)
    {
        $this->getSession()->getPage()->fillField( 'searchInput', $searchString);
        $this->getSession()->getPage()->find('css', '.searchButton')->click();
    }

    /**
     * @Then The first heading should be :heading
     */
    public function theFirstHeadingShouldBe($heading)
    {
        $pageHeading = $this->getSession()->getPage()->find('css', '.firstHeading');

        expect($pageHeading->getText())->toBe($heading);
        sleep(5);
    }

    /**
     * @Then I wait for :seconds seconds
     */
    public function iWaitForSeconds($seconds)
    {
        sleep($seconds);
    }
}
