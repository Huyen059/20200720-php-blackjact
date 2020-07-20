<?php

class Blackjack {
    private $player;

    public function __construct()
    {
        $deck = new Deck();
        $deck->shuffle();

        $this->player = new Player($deck);
        $this->dealer = new Player($deck);

        $_SESSION['deck'] = serialize($deck);
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getDealer()
    {
        return $this->dealer;
    }

    public function getDeck()
    {
        return $this->deck;
    }

    private $dealer;
    private $deck;
}