<?php
/**
 * @author    Arkadij Kuzhel <a.kuzhel@mobilunity.com>
 * @created   07.05.18
 */

namespace Freecell;

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

    protected $deck;

    /**
     * @var CardFactory
     */
    protected $cardFactory;

    public function __construct()
    {
        $this->cardFactory = new CardFactory();
        $this->deck        = new Deck();

        $this->clearDesk();
    }

    public function run($gamenumber = 500800)
    {
        $this->placeCards();
        $this->shuffle($gamenumber);
    }

    protected function placeCards()
    {
        for ($i = 0; $i < static::CARD_COUNT; $i++) {      // put unique $card in each $deck loc.
            $this->deck->addCard($this->cardFactory->create($i));
        }
    }

    protected function shuffle(int $gamenumber)
    {
        $cardsLeftToPlace = static::CARD_COUNT;

        $randFunction = \Knowgod\PRNG\LinearCongruentialGenerator::msvcrt_rand($gamenumber);            // $gamenumber is seed for rand()

        for ($i = 0; $i < static::CARD_COUNT; $i++) {
            $j = $randFunction() % $cardsLeftToPlace;

            $this->columns[ ($i % 8) + 1 ][ $i / 8 ] = $this->deck->getCard($j);

            $this->deck->setCard($this->deck->getCard(--$cardsLeftToPlace), $j);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $output    = '';
        $separator = "    ";

        foreach ($this->rows as $row => $aColumns) {
            foreach ($aColumns as $col => $card) {
                $output .= $separator . $card;
            }
            $output .= "\n";
        }

        return $output;
    }

    protected function clearDesk()
    {
        for ($col = 0; $col < static::MAXCOL; $col++) {         // clear the $deck
            for ($pos = 0; $pos < static::MAXPOS; $pos++) {
                $this->columns[ $col ][ $pos ] = static::EMPTY;
                $this->rows[ $pos ][ $col ]    = &$this->columns[ $col ][ $pos ];
            }
        }
    }
}
