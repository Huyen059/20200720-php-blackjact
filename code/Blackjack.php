<?php
declare(strict_types=1);
//Displaying errors since this is turned off by default
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Blackjack {
    private Player $player;
    private Dealer $dealer;
    private Deck $deck;

    public function __construct()
    {
        $deck = new Deck();
        $deck->shuffle();

        $this->player = new Player($deck);
        $this->dealer = new Dealer($deck);
        $this->deck = $deck;
    }

    public function getPlayer() : Player
    {
        return $this->player;
    }

    public function getDealer() : Dealer
    {
        return $this->dealer;
    }

    public function setDeck(Deck $deck): void
    {
        $this->deck = $deck;
    }

    public function getDeck(): Deck
    {
        return $this->deck;
    }

    public function settleGame(): void
    {
        if (!$this->getDealer()->hasLost()) {
            if ($this->getDealer()->getScore() < $this->getPlayer()->getScore()) {
                $this->getDealer()->setLost(true);
            } else {
                $this->getPlayer()->setLost(true);
            }
        }
    }

}