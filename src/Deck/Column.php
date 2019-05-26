<?php

namespace Freecell\Deck;

use Freecell\Api\GameObjectInterface;
use Freecell\Card;
use Freecell\CardFactory;

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
     * @var CardFactory
     */
    protected $cardFactory;

    /**
     * Column constructor.
     *
     * @param Card[]|int[] $cards
     */
    public function __construct(array $cards = [])
    {
        if (empty($cards)) {
            return;
        }
        $this->cardFactory = new CardFactory();

        foreach ($cards as $card) {
            if (is_int($card)) {
                $card = $this->cardFactory->create($card);
            }
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
        $amountSorted = $this->getAmountMovable();

        return $amountSorted === count($this->cards);
    }

    /**
     * @return int
     */
    protected function getAmountMovable(): int
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
        $valueDiff  = $upperCard->getValue() - $lowerCard->getValue();
        $colourDiff = $lowerCard->getColour() - $upperCard->getColour();

        return (1 === $valueDiff && 0 !== $colourDiff);
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
        if ($this->getAmountMovable() < $amount) {
            return false;
        }

        //TODO Create and return sub-column sliced off this one
        /** @noinspection OneTimeUseVariablesInspection */
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
        return implode(self::DELIMITER, $this->cards);
    }
}
