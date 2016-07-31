<?php

$I = new FunctionalTester($scenario);

$I->wantTo('not be able to login without password');

$I->amOnPage("/");

$I->click('LOGIN');
$I->fillField('username', 'milesaaa');
$I->fillField('password', '');

$I->click('login');

$I->seeCurrentUrlEquals('/login');

