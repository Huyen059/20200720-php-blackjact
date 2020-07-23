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

const CHOICE = 'choice';
const STAND = 'stand';
const HIT = 'hit';
const SURRENDER = 'surrender';

session_start();

if(!isset($_SESSION['blackjack'])) {
    $game = new Blackjack();
    $_SESSION['blackjack'] = serialize($game);
} else {
    $game = unserialize($_SESSION['blackjack'], [Blackjack::class]);
}

if(isset($_POST[CHOICE])) {
    switch ($_POST[CHOICE]) {
        case STAND:
            $game->getDealer()->hit($game);
            $game->settleGame();
            unset($_SESSION['blackjack']);
            break;
        case HIT:
            $game->getPlayer()->hit($game);
            $_SESSION['blackjack'] = serialize($game);
            if($game->getPlayer()->hasLost()){
                unset($_SESSION['blackjack']);
            }
            break;
        case SURRENDER:
            $game->getPlayer()->surrender();
            unset($_SESSION['blackjack']);
            break;
    }
}

require 'view-form.php';