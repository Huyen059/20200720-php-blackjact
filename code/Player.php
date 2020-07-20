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

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(Card $card): array
    {
        $this->cards[] = [$card->getUnicodeCharacter(true), $card->getValue()];
        return $this->cards;
    }



    /**
     * Player constructor.
     * @param array $cards
     */
    public function __construct($deck)
    {
        $card1 = $deck->drawCard();
        $card2 = $deck->drawCard();
        $this->cards[] = [$card1->getUnicodeCharacter(true), $card1->getValue()];
        $this->cards[] = [$card2->getUnicodeCharacter(true), $card2->getValue()];
    }


    public function hit(Deck $deck)
    {

//        return $deck;
        $card = $deck->drawCard();
        $_SESSION['deck'] = serialize($deck);
        return $card;
    }

    public function surrender(Player $player)
    {
        $player->setLost(true);
    }

    public function getScore(Player $player) : int
    {
        $playerCards = $player->getCards();
        $score = 0;
        foreach ($playerCards as $playerCard) {
            $score += $playerCard[1];
        }
        return $score;
    }
}
