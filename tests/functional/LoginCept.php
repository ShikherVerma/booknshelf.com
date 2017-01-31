<?php

$I = new FunctionalTester($scenario);
$I->am('a Booknshelf member');
$I->wantTo('login to my Booknshelf account');

$I->signIn();

$I->seeInCurrentUrl('/');

