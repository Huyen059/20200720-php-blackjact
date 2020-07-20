<?php
require 'code/Suit.php';
require 'code/Deck.php';
require 'code/Card.php';
require 'code/Player.php';
require 'code/Blackjack.php';

session_start();

//$player1 = new Player();
//foreach ($player1->getCards() as $card) {
//    echo $card;
//};

var_dump(new Blackjack());
