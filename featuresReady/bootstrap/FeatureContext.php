<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;


/**
 * Behat test suite context.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class FeatureContext extends RawMinkContext implements SnippetAcceptingContext
{


    /**
     * @Given I am in Wikipedia
     */
    public function iAmInWikipedia()
    {
        $this->visitPath('/');
    }

    /**
     * @When I search for :searchString
     */
    public function iSearchFor($searchString)
    {
        $this->getSession()->getPage()->fillField('searchInput', $searchString);
        $this->getSession()->getPage()->find('css', '.searchButton')->click();
    }

    /**
     * @Then the first heading should be :heading
     */
    public function theFirstHeadingShouldBe($heading)
    {
        $pageHeading = $this->getSession()->getPage()->find('css', '.firstHeading');

        expect($pageHeading->getText())->toBe($heading);
    }

    /**
     * @Then I wait for :seconds seconds
     */
    public function iWaitForSeconds($seconds)
    {
        sleep($seconds);
    }
}
