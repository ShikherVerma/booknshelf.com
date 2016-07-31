<?php

$I = new FunctionalTester($scenario);

$I->am('a Booknshelf member');
$I->wantTo('I want to view my bookshelves');
$I->signIn($I);
$I->click('MY BOOKSHELVES');
$I->seeCurrentUrlEquals('/@foobar/bookshelves');
$I->see('Tester name');
