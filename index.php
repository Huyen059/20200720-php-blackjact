<?php
declare(strict_types=1);
//Displaying errors since this is turned off by default
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

require 'code/Suit.php';
require 'code/Deck.php';
require 'code/Card.php';
require 'code/Player.php';
require 'code/Dealer.php';
require 'code/Blackjack.php';

session_start();

if(!isset($_SESSION['blackjack'])) {
    $game = new Blackjack();
    $_SESSION['blackjack'] = serialize($game);
} else {
    $game = unserialize($_SESSION['blackjack'], [Blackjack::class]);
}

if(isset($_POST['choice']) && $_POST['choice'] === 'stand'){
    $game->getDealer()->hit($game);

    if (!$game->getDealer()->hasLost()) {
        if($game->getDealer()->getScore() < $game->getPlayer()->getScore()) {
            $game->getDealer()->setLost(true);
        } else {
            $game->getPlayer()->setLost(true);
        }
    }

    unset($_SESSION['blackjack']);
}

if(isset($_POST['choice']) && $_POST['choice'] === 'hit'){
    $game->getPlayer()->hit($game);
    $_SESSION['blackjack'] = serialize($game);
    if($game->getPlayer()->hasLost()){
        unset($_SESSION['blackjack']);
    }
}


if(isset($_POST['choice']) && $_POST['choice'] === 'surrender'){
    $game->getPlayer()->surrender();
    unset($_SESSION['blackjack']);
}

require 'view-form.php';