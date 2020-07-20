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
    echo 'stand';
}

if(isset($_POST['hit'])){
    $newCard = $player->hit(unserialize($_SESSION['deck']));
    $player->setCards($newCard);
    $_SESSION['player'] = serialize($player);
    var_dump(unserialize($_SESSION['player']));
}

if(isset($_POST['surrender'])){
    echo 'surrender';
}

require 'view-form.php';