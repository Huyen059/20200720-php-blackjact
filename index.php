<?php
require 'code/Suit.php';
require 'code/Deck.php';
require 'code/Card.php';
require 'code/Player.php';
require 'code/Blackjack.php';

session_start();

if(!isset($_SESSION['player'])) {
    $newGame = new Blackjack();
    $player = $newGame->getPlayer();
    $dealer = $newGame->getDealer();
    $_SESSION['player'] = serialize($player);
    $_SESSION['dealer'] = serialize($dealer);
} else {
    $player = unserialize($_SESSION['player']);
    $dealer = unserialize($_SESSION['dealer']);
}

if(isset($_POST['choice']) && $_POST['choice'] === 'stand'){
    $dealer->hit();

    if ($dealer->hasLost() !== true) {
        if($dealer->getScore() < $player->getScore()) {
            $dealer->setLost(true);
        } else {
            $player->setLost(true);
        }
    }

//    unset($_SESSION['player']);
    session_destroy();
}

if(isset($_POST['choice']) && $_POST['choice'] === 'hit'){
    $player->hit(unserialize($_SESSION['deck']));
}


if(isset($_POST['choice']) && $_POST['choice'] === 'surrender'){
    $player->surrender($player);
//    unset($_SESSION['player']);
    session_destroy();
}

//------ Need to remove these when done with display
echo $dealer->getScore() . ' ' . 'Dealer lost?' . $dealer->hasLost() . '<br>';
echo $player->getScore() . ' ' . 'Player lost?' . $player->hasLost();

require 'view-form.php';