<?php
/**
 * @author    Arkadij Kuzhel <a.kuzhel@mobilunity.com>
 * @created   07.05.18
 */

namespace Freecell;

use Freecell\Deck\Column;
use Freecell\Deck\ColumnFactory;
use Knowgod\PRNG\LinearCongruentialGenerator;

/**
 * Class Game
 *
 */
class Game implements Api\GameObjectInterface
{
    const MAXPOS     = 7;
    const MAXCOL     = 9;

    const EMPTY      = '  ';
    const CARD_COUNT = 52;

    /**
     * @var array[]
     */
    protected $columns = [];

    /**
     * @var array[]
     */
    protected $rows = [];

    /**
     * @var Deck
     */
    protected $deck;

    /**
     * @var CardFactory
     */
    protected $cardFactory;

    /**
     * @var ColumnFactory
     */
    protected $columnFactory;

    /**
     * @var Column[]
     */
    protected $columnObjects;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->deck          = new Deck();
        $this->cardFactory   = new CardFactory();
        $this->columnFactory = new ColumnFactory();

        $this->clearDesk();
    }

    /**
     * @param int $gameNumber
     */
    public function run(int $gameNumber = 500800)
    {
        $this->initialize($gameNumber);
    }

    /**
     * Fill deck with the cards
     */
    protected function placeCards()
    {
        for ($i = 0; $i < static::CARD_COUNT; $i++) {      // put unique $card in each $deck loc.
            $this->deck->addCard($this->cardFactory->create($i));
        }
    }

    /**
     * Shuffle cards on the deck
     *
     * @param int $gameNumber
     */
    protected function shuffle(int $gameNumber)
    {
        $cardsLeftToPlace = static::CARD_COUNT;

        /**
         * @var $gameNumber int Is seed for rand()
         */
        $randFunction = LinearCongruentialGenerator::msvcrt_rand($gameNumber);

        for ($i = 0; $i < static::CARD_COUNT; $i++) {
            $j = $randFunction() % $cardsLeftToPlace;

            $this->columns[ ($i % 8) + 1 ][ floor($i / 8) ] = $this->deck->getCard($j);

            $this->deck->setCard($this->deck->getCard(--$cardsLeftToPlace), $j);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $output    = '';
        $separator = '    ';

        foreach ($this->rows as $row => $aColumns) {
            foreach ($aColumns as $col => $card) {
                $output .= $separator . $card;
            }
            $output .= "\n";
        }

        return $output;
    }

    /**
     * Prepare empty deck with all its positions
     */
    protected function clearDesk()
    {
        for ($col = 0; $col < static::MAXCOL; $col++) {         // clear the $deck
            for ($pos = 0; $pos < static::MAXPOS; $pos++) {
                $this->columns[ $col ][ $pos ] = static::EMPTY;
                $this->rows[ $pos ][ $col ]    = &$this->columns[ $col ][ $pos ];
            }
        }
    }

    /**
     * Initialize column objects
     */
    protected function initColumns()
    {
        foreach ($this->columns as $iColumn => $cardColumn) {
            $column = $this->columnFactory->createFilled($cardColumn);
            if (!$column->isEmpty()) {
                $this->columnObjects[ $iColumn ] = $column;
            }
        }
    }

    /**
     * Prepare the game according to its unique number
     *
     * @param int $gameNumber
     */
    protected function initialize(int $gameNumber)
    {
        $this->placeCards();
        $this->shuffle($gameNumber);
        $this->initColumns();
    }
}
