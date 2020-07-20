<?php

class Player
{
    private $cards = [];

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

    private $lost = false;

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

    public function surrender()
    {

    }

    public function getScore()
    {

    }

    public function hasLost()
    {

    }
}
