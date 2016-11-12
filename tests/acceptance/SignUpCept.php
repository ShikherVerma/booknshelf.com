<?php

// Test the complate sign up and defaul shelves flow.
$I = new AcceptanceTester($scenario);
$I->wantTo('sign up for booknshelf');

$I->amOnPage("/");

$I->click('REGISTER');
$I->fillField('name', 'Miles');
$I->fillField('username', 'milesaaa');
$I->fillField('password', 'password');

$I->click('register');

$I->seeCurrentUrlEquals('/welcome');

$I->see('Choose your username', 'label');

$I->click('continue');

$I->click('My Bookshelves');

$I->seeCurrentUrlEquals('/@milesaaa/bookshelves');

//$I->see('Books I have read');
