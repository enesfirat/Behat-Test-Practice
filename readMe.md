# Behat Test Practice
This repo is created for following the steps on the YouTube [video](https://www.youtube.com/watch?v=j7RHtNePY3Y) of the [MageCasts.io](https://www.youtube.com/channel/UCrofx7kKaBLXO4cqK6-tn0g) channel.

This is a practice repo for beginner Behat'ers.

We are going to use Selenium Webdriver to complete the steps below.

When you run Behat with`` ./bin/behat``

1)A Google Chrome window will open.

2)It will go to https://en.wikipedia.org.

3)It will type "Behavior-driven development" to the search bar and click the search button.

4)It will wait for 5 seconds.


**Before you start practicing, you can check the files**

featuresReady/bootstrap/FeaturesContext.php

and

featuresReady/search.feature

-----------------------------------------------------
## Requirements

[Composer](composer.org)

-----------------------------------------------------

## Installation
In the terminal, go to the root folder of this repo and run

``
composer install
``

and/or

``composer update``

to install & update the dependencies.

Then you should run

``
./bin/manager update
``

to update webdriver manager.


The command below will show you what commands you can use on Webdriver Manager.

``
./bin manager
``

To initialize Behat you should run

``
./bin/behat --init
``


Please make sure the "features" folder is in the root folder, **not in the vendor folder**. (If not, you can go to ./vendor/behat/behat and cut the folder "features" and paste it to the root folder.)




-----------------------------------------------------
## Ready Codes

In featuresReady folder, you will find working codes.

-----------------------------------------------------
## Practice

If you choose to practice by yourself, you should:

* Delete all files with ".feature" extension in the features folder.
* Create a new file in the "features" folder with the name "search.feature".
* Write ** the scenario of the feature** in "search.feature" file. It should be something like the snippet below:
~~~
Feature: search Wikipedia
  In order to learn about BDD
  As a passionate developer
  I need to be able to search a general website

  Scenario: Search for BDD
    Given I am in Wikipedia
    When I search for "Behavior driven development"
    Then the first heading should be "Behavior-driven development"
    And I wait for 5 seconds
~~~

* Paste

  ``use Behat\MinkExtension\Context\RawMinkContext;``

  and

  ``use Behat\Behat\Context\SnippetAcceptingContext;``

  on top of features/bootstrap/FeatureContext.php

* Delete the **codes** in the class in features/bootstrap/FeatureContext.php (after running ``composer install`` it automatically adds many tests to features folder and codes of the tests in FeatureContext.php. Since we don't need them in this practice, it's better to delete them to have a clean folder and a clean class.)
* Run
  ``
  ./bin/behat --append-snippets
  ``

  This command will create 'templates' of necessary functions for your feature & your Behat test.
  It is helpful before you write the actual functions.

* Replace the class row with
  `` class FeatureContext extends RawMinkContext implements SnippetAcceptingContext
  ``
  to extend "RawMinkContext" class and implement "SnippetAcceptingContext".

* Write the functions for the search feature. It should be something like the snippet below.


  ~~~
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
~~~

You will notice the comment lines above each function. They might look like common comment lines, but they aren't. They communicate with "search.feature" file. When you check "search.feature" file, you will notice blue colored texts, which are used in **"FeatureContext.php"** as **inputs** of the functions.
(For further understanding of Gherkin syntax, you can read this [article](https://docs.behat.org/en/latest/user_guide/gherkin.html).)
-----------------------------------------------------


## Running Behat
After writing the feature and the Behat scenario, it's time to run Behat test.

In terminal go to the root folder and run

~~~
./bin/manager start
~~~

Open a new terminal tab and run

~~~
./bin/behat
~~~

You should have an output like below

~~~
Feature: search Wikipedia
  In order to learn about BDD
  As a passionate developer
  I need to be able to search a general website

  Scenario: Search for BDD                                         # features/search.feature:6
    Given I am in Wikipedia                                        # FeatureContext::iAmInWikipedia()
    When I search for "Behavior driven development"                # FeatureContext::iSearchFor()
    Then the first heading should be "Behavior-driven development" # FeatureContext::theFirstHeadingShouldBe()
    And I wait for 5 seconds                                       # FeatureContext::iWaitForSeconds()

1 scenario (1 passed)
4 steps (4 passed)
0m11.33s (9.81Mb)

~~~

-----------------------------------------------------


## Possible Errors

**Please make sure you have**

``
127.0.0.1 localhost
``

**in your /etc/hosts file.**

To check it, you should go to the terminal and run

``
sudo vi /etc/hosts
``

type your user password and paste

``
127.0.0.1 localhost
``
to any empty row.

## Sources & Further Reading & Notes

This repo is created for following the steps on the YouTube [video](https://www.youtube.com/watch?v=j7RHtNePY3Y) of the [MageCasts.io](https://www.youtube.com/channel/UCrofx7kKaBLXO4cqK6-tn0g) channel.

I strongly recommend you to read this [article](https://docs.behat.org/en/latest/quick_start.html) before you start practicing.

Note: In the video, the instructor does not write
~~~
browser: chrome
~~~
in "composer.json" file. However, it didn't work out for me. So I solved the issue by adding the "browser: chrome" to the last row of "composer.json".

All the best! ^-^
