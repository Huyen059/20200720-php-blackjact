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

    public function hit(Deck $deck)
    {
        $card = $deck->drawCard();
        $_SESSION['deck'] = serialize($deck);
        $this->setCards($card);
        $_SESSION['player'] = serialize($this);
        //------ Can use $this->>getScore($this) directly in the if
        $playerScore = $this->getScore($this);
        if ($playerScore > 21) {
            $this->setLost(true);
//            unset($_SESSION['player']);
            session_destroy();
        }
    }

    public function surrender(Player $player) : void
    {
        $player->setLost(true);
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
    public function __construct(Deck $deck)
    {
        parent::__construct($deck);
    }
    public function hit() : void
    {
        while ($this->getScore($this) < 15) {
            parent::hit(unserialize($_SESSION['deck']));
        }
    }
}