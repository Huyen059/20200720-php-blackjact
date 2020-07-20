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

    private $lost = false;

    /**
     * Player constructor.
     * @param array $cards
     */
    public function __construct($deck)
    {
        $this->cards[] = $deck->drawCard()->getUnicodeCharacter(true);
        $this->cards[] = $deck->drawCard()->getUnicodeCharacter(true);
    }


    public function hit()
    {

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
