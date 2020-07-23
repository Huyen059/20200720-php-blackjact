<?php
require 'code/Suit.php';
require 'code/Deck.php';
require 'code/Card.php';
require 'code/Player.php';
require 'code/Blackjack.php';

session_start();

if(!isset($_SESSION['blackjack'])) {
    $game = new Blackjack();
    $_SESSION['blackjack'] = serialize($game);
} else {
    $game = unserialize($_SESSION['blackjack']);
}

if(isset($_POST['choice']) && $_POST['choice'] === 'stand'){
    $game->getDealer()->hit();

    if ($game->getDealer()->hasLost() !== true) {
        if($game->getDealer()->getScore() < $game->getPlayer()->getScore()) {
            $game->getDealer()->setLost(true);
        } else {
            $game->getPlayer()->setLost(true);
        }
    }

//    unset($_SESSION['player']);
    session_destroy();
}

if(isset($_POST['choice']) && $_POST['choice'] === 'hit'){
    $game->getPlayer()->hit($game);
}


if(isset($_POST['choice']) && $_POST['choice'] === 'surrender'){
    $game->getPlayer()->surrender();
//    unset($_SESSION['player']);
    session_destroy();
}

//------ Need to remove these when done with display
echo $game->getDealer()->getScore() . ' ' . 'Dealer lost?' . $game->getDealer()->hasLost() . '<br>';
echo $game->getPlayer()->getScore() . ' ' . 'Player lost?' . $game->getPlayer()->hasLost();

require 'view-form.php';