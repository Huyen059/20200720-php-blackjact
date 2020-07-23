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

    session_destroy();
}

if(isset($_POST['choice']) && $_POST['choice'] === 'hit'){
    $game->getPlayer()->hit($game);
    $_SESSION['blackjack'] = serialize($game);
    if($game->getPlayer()->hasLost()){
        session_destroy();
    }

}


if(isset($_POST['choice']) && $_POST['choice'] === 'surrender'){
    $game->getPlayer()->surrender();
    session_destroy();
}


require 'view-form.php';

