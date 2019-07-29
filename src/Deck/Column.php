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
     * Indexed array of cards from bottom to top
     * The top card is one that could be taken off
     *
     * @var Card[]
     */
    protected $cards = [];

    /**
     * @var CardFactory
     */
    protected $cardFactory;

    /**
     * @var \Freecell\Deck\ColumnFactory
     */
    private $columnFactory;

    /**
     * Column constructor.
     *
     * @param \Freecell\Deck\ColumnFactory $columnFactory
     * @param Card[]|int[]                 $cards
     */
    public function __construct(
        ColumnFactory $columnFactory,
        array $cards = []
    ) {
        $this->columnFactory = $columnFactory;
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
        $bottomCard   = null;
        /** @var Card $bottomCard */
        foreach ($this->iterateTopToBottom() as $card) {
            if (null === $bottomCard || $this->canCover($card, $bottomCard)) {
                $bottomCard = $card;
                $amountSorted++;
            } else {
                break;
            }
        }

        return $amountSorted;
    }

    /**
     * @param Card $bottomCard
     * @param Card $topCard
     *
     * @return bool
     */
    protected function canCover(Card $bottomCard, Card $topCard): bool
    {
        $valueDiff  = $bottomCard->getValue() - $topCard->getValue();
        $colourDiff = $topCard->getColour() - $bottomCard->getColour();

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
            $this->cards[] = $card;
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
        $topCard = end($this->cards);
        if (!($topCard instanceof Card)) {
            return true;
        }

        return $this->canCover($topCard, $card);
    }

    /**
     * @return \Generator
     */
    private function iterateTopToBottom()
    {
        for ($i = count($this->cards) - 1; $i >= 0; --$i) {
            yield $this->cards[$i];
        }
    }

    /**
     * Take amount of cards off the column
     *
     * @param int $amount
     *
     * @return bool|Column Sub-column taken off or `false`
     */
    public function dismissCards($amount = 1)
    {
        if ($this->getAmountMovable() < $amount) {
            return false;
        }
        /**
         * Card[]
         */
        $cards = [];
        foreach ($this->iterateTopToBottom() as $index => $cardFromTop) {
            if (count($cards) === $amount) {
                break;
            }
            $cards[$index] = $cardFromTop;
        }

        $subColumn = $this->columnFactory->create();
        foreach (array_reverse($cards) as $index => $cardFromBottom) {
            $subColumn->addCard($cardFromBottom);
            unset($this->cards[$index]);
        }

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
