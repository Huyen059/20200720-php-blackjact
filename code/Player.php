<?php
declare(strict_types=1);
//Displaying errors since this is turned off by default
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Player
{
    const GAME_LIMIT = 21;
    private array $cards = [];
    private bool $lost = false;


    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
    }

    public function hasLost(): bool
    {
        return $this->lost;
    }

    public function setLost(bool $lost): void
    {
        $this->lost = $lost;
    }

    /** @return  Card[] */ // annotations
    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(Card $card): array
    {
        $this->cards[] = $card;
        return $this->cards;
    }

    public function hit(Blackjack $game) : void
    {
        $deck = $game->getDeck();
        $card = $deck->drawCard();
        $this->setCards($card);
        $game->setDeck($deck);
//        $game->setPlayer($this); //HAS TO REMOVE THIS OTHERWISE PLAYER AND DEALER HAVE THE SAME CARDS
        if ($this->getScore() > self::GAME_LIMIT) {
            $this->setLost(true);
        }
    }

    public function surrender() : void
    {
        $this->setLost(true);
    }

    public function getScore() : int
    {
        $cards = $this->getCards();
        $score = 0;
        foreach ($cards as $card) {
            $score += $card->getValue();
        }
        return $score;
    }
}

