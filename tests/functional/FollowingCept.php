<?php 
$I = new FunctionalTester($scenario);
$I->am("a Booknshelf user");
$I->wantTo('follow other bookshelves');


// setup
//$I->haveAnAccount(['username' => 'otheruser']);
$I->signIn($I);
$I->createShelf($I, "Dummy Shelf");

//You've successfully created a bookshelf

$I->see("You've successfully created a bookshelf");

$I->click('MY BOOKSHELVES');
$I->seeCurrentUrlEquals('/@foobar/bookshelves');

//$I->click("BOOKSHELVES");
//
//$I->canSee("Dummy Shelf");
//
//$I->see('Dummy Shelf');

//$I->click("OUR PICKS");

// action


// expectations