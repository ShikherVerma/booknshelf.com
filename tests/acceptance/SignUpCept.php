<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('sign up for booknshelf');

$I->amOnPage("/");

$I->click('Register');
$I->fillField('name', 'Miles');
$I->fillField('username', 'milesaaa');
$I->fillField('password', 'password');

$I->click('register');

$I->seeCurrentUrlEquals('/welcome');

$I->see('Choose your username', 'label');