<?php
/**
 * Created by PhpStorm.
 * User: arkadij
 * Date: 28.07.18
 * Time: 2:40
 */

namespace Frecell\Tests;

use Freecell\CardFactory;
use Freecell\Deck;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    /**
     * @var CardFactory
     */
    private $cardFactory;

    public function setUp()
    {
        $this->cardFactory = new CardFactory();
    }

    public function getToStringTestData()
    {
        return [
            [
                [ 0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14, 15],
                '♣ A ♦ A ♥ A ♠ A ♣ 2 ♦ 2 ♥ 2 ♠ 2 ♣ 3 ♦ 3 ♥ 3 ♠ 3 ♣ 4 ♦ 4 ♥ 4 ♠ 4 ',
            ],
            [
                [48, 49, 50, 51],
                '♣ K ♦ K ♥ K ♠ K ',
            ],
            [
                [36, 37, 38, 39],
                '♣ 10♦ 10♥ 10♠ 10',
            ],
        ];
    }

    /**
     * @dataProvider getToStringTestData
     *
     * @param array  $cardNumbers
     * @param string $output
     */
    public function testToString(array $cardNumbers, string $output)
    {
        $deck = new Deck();
        foreach ($cardNumbers as $cardNumber) {
            $deck->addCard($this->cardFactory->create($cardNumber));
        }
        $deckOutput = str_replace(["\n"], '', $deck);
        $this->assertEquals($output, $deckOutput);
    }
}
