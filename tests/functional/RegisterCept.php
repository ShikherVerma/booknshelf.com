<?php

$I = new FunctionalTester($scenario);

$I->am('A guest');
$I->wantTo('Sign up for a Booknshelf account');

$I->amOnPage('/');
$I->click('SIGN UP');
$I->seeCurrentUrlEquals('/register');

$I->fillField('name', 'JohnDoe');
$I->fillField('username', 'JohnDoe123');
$I->fillField('email', 'JohnDoe@test.com');
$I->fillField('password', 'demo123');
$I->click('JOIN');

$I->seeCurrentUrlEquals('/');

$I->seeRecord('users', [
    'username' => 'JohnDoe123',
]);
