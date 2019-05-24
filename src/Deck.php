<?php

namespace Freecell;

/**
 * Class Deck
 * This is a deck containing cards
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
    public function __toString(): string
    {
        $output = '';
        foreach ($this->cards as $card) {
            $output .= $card . self::DELIMITER;
        }

        return $output;
    }

    /**
     * Add card to the card set
     *
     * @param Card $card
     *
     * @return Deck
     */
    public function addCard(Card $card): Deck
    {
        if ($card->getNumber() || 0 === $card->getNumber()) {
            $this->cards[] = $card;
        }

        return $this;
    }

    /**
     * Place card onto specific position
     *
     * @param Card $card
     * @param      $position
     *
     * @return Deck
     */
    public function setCard(Card $card, $position): Deck
    {
        if ($card->getNumber()) {
            $this->cards[ $position ] = $card;
        }

        return $this;
    }

    /**
     * Get card from specified position
     *
     * @param int $position
     *
     * @return \Freecell\Card
     */
    public function getCard(int $position): Card
    {
        return $this->cards[ $position ];
    }
}
