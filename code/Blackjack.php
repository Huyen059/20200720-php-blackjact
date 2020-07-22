<?php

class Blackjack {
    private $player;
    private $dealer;
    private $deck;

    public function __construct()
    {
        $deck = new Deck();
        $deck->shuffle();

        $this->player = new Player($deck);
        $this->dealer = new Dealer($deck);

        $_SESSION['deck'] = serialize($deck);
    }

    public function getPlayer() : Player
    {
        return $this->player;
    }

    public function getDealer() : Dealer
    {
        return $this->dealer;
    }
}