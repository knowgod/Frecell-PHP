<?php

namespace Freecell;

/**
 * Class Deck
 *
 */
class Deck implements Api\GameObjectInterface
{
    const DELIMITER = "\n";

    /**
     * @var Card[]
     */
    protected $cards = [];

    /**
     * @return string
     */
    public function __toString()
    {
        $output = '';
        foreach ($this->cards as $card) {
            $output .= (string) $card . self::DELIMITER;
        }

        return $output;
    }

    public function addCard(Card $card)
    {
        if ($card->getNumber() || 0 === $card->getNumber()) {
            $this->cards[] = $card;
        }

        return $this;
    }

    public function setCard(Card $card, $position)
    {
        if ($card->getNumber()) {
            $this->cards[ $position ] = $card;
        }

        return $this;
    }

    public function getCard($position)
    {
        return $this->cards[ $position ];
    }
}
