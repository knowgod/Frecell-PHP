<?php
/**
 * Created by PhpStorm.
 * User: arkadij
 * Date: 28.07.18
 * Time: 3:04
 */

namespace Frecell\Tests;

use Freecell\Card;
use Freecell\CardFactory;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * @var CardFactory
     */
    private $cardFactory;

    public function setUp()
    {
        $this->cardFactory = new CardFactory();
    }

    /**
     * For card attributes check: @see \Frecell\Tests\DeckTest::getToStringTestData
     *
     * @return array
     */
    public function getRepresentationTestData()
    {
        return [
            [0, Card::SUIT_CLUB, 0, Card::COLOUR_BLACK,],
            [51, Card::SUIT_SPADES, 12, Card::COLOUR_BLACK,],
            [14, Card::SUIT_HEART, 3, Card::COLOUR_RED,],
            [37, Card::SUIT_DIAMOND, 9, Card::COLOUR_RED,],
        ];
    }

    /**
     * @dataProvider getRepresentationTestData
     *
     * @param int $cardNumber
     * @param int $suit
     * @param int $value
     * @param int $colour
     */
    public function testRepresentation(int $cardNumber, int $suit, int $value, int $colour)
    {
        $card = $this->cardFactory->create($cardNumber);
        $this->assertEquals($suit, $card->getSuit());
        $this->assertEquals($value, $card->getValue());
        $this->assertEquals($colour, $card->getColour());
    }

    public function testCardNotSetString()
    {
        $card = new Card();
        $this->assertEquals(Card::NOT_SET, $card->__toString());
    }
}
