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
        $this->deck = $deck;
    }

    public function setPlayer(Player $player): void
    {
        $this->player = $player;
    }

    public function setDeck(Deck $deck): void
    {
        $this->deck = $deck;
    }

    public function getDeck(): Deck
    {
        return $this->deck;
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