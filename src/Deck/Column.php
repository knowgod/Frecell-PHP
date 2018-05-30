<?php

namespace Freecell\Deck;

use Freecell\Api\GameObjectInterface;
use Freecell\Card;

/**
 * Class Column
 * @todo Try to extend from stdlib Stack
 *
 * @package Freecell\Deck
 */
class Column implements GameObjectInterface
{
    const DELIMITER = ' / ';

    /**
     * Keep cards from bottom to top
     *
     * @var Card[]
     */
    protected $cards = [];

    /**
     * Column constructor.
     *
     * @param Card[] $cards
     */
    public function __construct(array $cards = [])
    {
        if (empty($cards)) {
            return;
        }

        foreach ($cards as $card) {
            if ($card instanceof Card) {
                $this->addCard($card, false);
            }
        }
    }

    /**
     * If columns is sorted and ready for auto-solve
     *
     * @return bool
     */
    public function isSorted(): bool
    {
        $amountSorted = $this->getAmountSorted();

        return $amountSorted === count($this->cards);
    }

    /**
     * @return int
     */
    protected function getAmountSorted(): int
    {
        $amountSorted = 0;
        $lowerCard    = null;
        /** @var Card $lowerCard */
        foreach ($this->cards as $card) {
            if (null === $lowerCard || $this->canCover($card, $lowerCard)) {
                $lowerCard = $card;
                $amountSorted++;
            } else {
                break;
            }
        }

        return $amountSorted;
    }

    /**
     * @param Card $upperCard
     * @param Card $lowerCard
     *
     * @return bool
     */
    protected function canCover(Card $upperCard, Card $lowerCard): bool
    {
        return ($valueDiff = $upperCard->getValue() - $lowerCard->getValue() === 1
                             && $lowerCard->getColour() != $upperCard->getColour());
    }

    /**
     * Place card at the column bottom
     *
     * @param Card $card
     * @param bool $withCheck
     *
     * @return Column
     */
    public function addCard(Card $card, $withCheck = true): Column
    {
        if (!$withCheck || $this->canPlace($card)) {
            array_unshift($this->cards, $card);
        }

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return bool
     */
    public function canPlace(Card $card): bool
    {
        $bottomCard = $this->cards[0] ?? null;//TODO Do not rely on indexes
        if (!($bottomCard instanceof Card)) {
            return true;
        }

        return $this->canCover($bottomCard, $card);
    }

    /**
     * Take amount of cards off the column
     *
     * @param int $amount
     *
     * @return bool|Column
     */
    public function dismissCards($amount = 1)
    {
        if ($this->getAmountSorted() < $amount) {
            return false;
        }

        //TODO Create and return sub-column sliced off this one
        $subColumn = new Column();

        return $subColumn;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->cards);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $output = implode(self::DELIMITER, $this->cards);

        return $output;
    }
}
