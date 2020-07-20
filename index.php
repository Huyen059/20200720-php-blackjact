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

if(isset($_POST['stand'])){
    $newCard = $dealer->hit(unserialize($_SESSION['deck']));
    $dealer->setCards($newCard);
    $_SESSION['dealer'] = serialize($dealer);
    $dealerScore = $dealer->getScore($dealer);
    if ($dealerScore > 21) {
        $dealer->setLost(true);
        unset($_SESSION['dealer']);
    }
}

if(isset($_POST['hit'])){
    $newCard = $player->hit(unserialize($_SESSION['deck']));
    $player->setCards($newCard);
    $_SESSION['player'] = serialize($player);
    $playerScore = $player->getScore($player);
    if ($playerScore > 21) {
        $player->setLost(true);
        unset($_SESSION['player']);
    }
}


if(isset($_POST['surrender'])){
    $player->surrender($player);
    unset($_SESSION['player']);
    echo 'surrender';
}

require 'view-form.php';