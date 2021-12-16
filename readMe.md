# Behat Test Practice
This repo is created for following the steps on the YouTube [video](https://www.youtube.com/watch?v=j7RHtNePY3Y) of the [MageCasts.io](https://www.youtube.com/channel/UCrofx7kKaBLXO4cqK6-tn0g) channel.

This is a practice repo for beginner Behat'ers.

We are going to use Selenium Webdriver to complete the steps below.

When you run Behat with`` ./bin/behat``

1)A Google Chrome window will open.

2)It will go to https://en.wikipedia.org.

3)It will type "Behavior-driven development" to the search bar and click the search button.

4)It will wait for 5 seconds.


**Before you start your practice, you can delete the files**

features/bootstrap/FeaturesContext.php

and

features/search.feature

-----------------------------------------------------
## Requirements

[Composer](composer.org)

-----------------------------------------------------

## Installation
In your terminal, go to the root folder of this repo and run

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


Please make sure your "features" folder is in your root folder, **not in your vendor folder**.

-----------------------------------------------------


## Running Behat
``
./bin/behat --append-snippets
``
This command will create templates of necessary functions for your Behat test.
It is helpful before you write the actual functions.

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

## Credits

This repo is created for following the steps on the YouTube [video](https://www.youtube.com/watch?v=j7RHtNePY3Y) of the [MageCasts.io](https://www.youtube.com/channel/UCrofx7kKaBLXO4cqK6-tn0g) channel.
