<?php

class Player
{
    private $cards = [];
    private $lost = false;

    public function hasLost(): bool
    {
        return $this->lost;
    }

    public function setLost(bool $lost): void
    {
        $this->lost = $lost;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(Card $card): array
    {
        $this->cards[] = [$card->getUnicodeCharacter(true), $card->getValue()];
        return $this->cards;
    }

    public function __construct(Deck $deck)
    {
        $card1 = $deck->drawCard();
        $card2 = $deck->drawCard();
        $this->cards[] = [$card1->getUnicodeCharacter(true), $card1->getValue()];
        $this->cards[] = [$card2->getUnicodeCharacter(true), $card2->getValue()];
    }

    public function hit(Blackjack $game)
    {
        $deck = $game->getDeck();
        $card = $deck->drawCard();
        $this->setCards($card);
        $game->setDeck($deck);
        $game->setPlayer($this);
        $_SESSION['blackjack'] = serialize($game);
        if ($this->getScore() > 21) {
            $this->setLost(true);
//            unset($_SESSION['player']);
            session_destroy();
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
            $score += $playerCard[1];
        }
        return $score;
    }
}

class Dealer extends Player {
    public function hit() : void
    {
        while ($this->getScore() < 15) {
            parent::hit(unserialize($_SESSION['blackjack']));
        }
    }
}