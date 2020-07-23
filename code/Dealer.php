<?php
declare(strict_types=1);
//Displaying errors since this is turned off by default
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Dealer extends Player {
    const DEALER_LIMIT = 15;

    public function hit(Blackjack $game) : void
    {
        while ($this->getScore() < self::DEALER_LIMIT) {
            parent::hit($game);
        }
    }
}