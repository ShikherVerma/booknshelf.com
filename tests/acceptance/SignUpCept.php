<?php

// Test the complate sign up and defaul shelves flow.
$I = new AcceptanceTester($scenario);
$I->wantTo('sign up for booknshelf');

$I->amOnPage("/");

$I->click('Join');
$I->fillField('name', 'Miles');
$I->fillField('username', 'milesaaa');
$I->fillField('password', 'password');

$I->click('register');

$I->seeCurrentUrlEquals('/welcome');

$I->see('Choose your username', 'label');

$I->click('Continue');

$I->click('.menu');

$I->click('My profile');

$I->seeCurrentUrlEquals('/@milesaaa');

//$I->see('Books I have read');
