<?php

$I = new FunctionalTester($scenario);

$I->am('A guest');
$I->wantTo('Sign up for a Booknshelf account');

$I->amOnPage('/');
$I->click('Join');
$I->seeCurrentUrlEquals('/register');

$I->fillField('name', 'JohnDoe');
$I->fillField('username', 'JohnDoe123');
$I->fillField('password', 'demo123');
$I->click('JOIN');

$I->seeCurrentUrlEquals('/welcome');
$I->see('Choose your username', 'label');

$I->seeRecord('users', [
    'username' => 'JohnDoe123',
]);
