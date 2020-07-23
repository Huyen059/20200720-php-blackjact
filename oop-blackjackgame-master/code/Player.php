<?php

class Player
{
    const PLAYER_LIMIT = 21;
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
        $this->cards[] = $card;//[$card->getUnicodeCharacter(true), $card->getValue()];
        return $this->cards;
    }

    public function hit(Blackjack $game) :void
    {
        $deck = $game->getDeck();
        $card = $deck->drawCard();
        $this->setCards($card);
        $game->setDeck($deck);
        $game->setPlayer($this);
        if ($this->getScore() > self::PLAYER_LIMIT) {
            $this->setLost(true);
        }
    }

    public function surrender() : void
    {
        $this->setLost(true);
    }

    public function getScore() : int
    {
        $playerCards = $this->getCards();
        $score = 0;
        foreach ($playerCards as $playerCard) {
            $score += $playerCard->getValue();
        }
        return $score;
    }
}

class Dealer extends Player {
    const DEALER_LIMIT = 15;

    public function hit(Blackjack $game) : void
    {
        while ($this->getScore() < self::DEALER_LIMIT) {
            parent::hit($game);
        }
    }
}