<?php

$I = new FunctionalTester($scenario);

$I->am('A guest');
$I->wantTo('Sign up for a Booknshelf account');

$I->amOnPage('/');
$I->click('REGISTER');
$I->seeCurrentUrlEquals('/register');

$I->fillField('name', 'JohnDoe');
$I->fillField('username', 'JohnDoe123');
$I->fillField('password', 'demo123');
$I->click('Sign up');

$I->seeCurrentUrlEquals('/welcome');
$I->see('Choose your username');

$I->seeRecord('users', [
    'username' => 'JohnDoe123',
]);
