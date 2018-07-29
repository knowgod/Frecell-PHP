<?php
/**
 * Created by PhpStorm.
 * User: arkadij
 * Date: 29.07.18
 * Time: 1:22
 */

namespace Frecell\Tests;

use Freecell\CardFactory;
use Freecell\Deck\Column;
use Freecell\Deck\ColumnFactory;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase
{
    /**
     * @var CardFactory
     */
    private $cardFactory;

    /**
     * @var ColumnFactory
     */
    private $columnFactory;

    public function setUp()
    {
        $this->cardFactory   = new CardFactory();
        $this->columnFactory = new ColumnFactory();
    }

    public function getAddCardTestData(): array
    {
        return [
            [[15], true, 1],        // Simple card add
            [[15, 11], true, 1],    // Add invalid card with test
            [[15, 10], true, 2],    // Add valid card with test
            [[15, 11], false, 2],   // Add invalid card without test
        ];
    }

    /**
     * @dataProvider getAddCardTestData
     * @throws \ReflectionException
     */
    public function testAddCard(array $cards, $withTest, $expectedCount)
    {
        $column        = $this->columnFactory->create();
        $reflection    = new \ReflectionClass(Column::class);
        $cardsProperty = $reflection->getProperty('cards');
        $cardsProperty->setAccessible(true);

        foreach ($cards as $cardNum) {
            $column->addCard($this->cardFactory->create($cardNum), $withTest);
        }
        $this->assertCount($expectedCount, $cardsProperty->getValue($column));
    }

    public function testIsEmpty()
    {
        $column = $this->columnFactory->create();
        $this->assertTrue($column->isEmpty());
        $column->addCard($this->cardFactory->create(10));
        $this->assertFalse($column->isEmpty());
    }

    public function getCanPlaceTestData(): array
    {
        return [
            [15, 11, false],
            [15, 10, true],
        ];
    }

    /**
     * @dataProvider getCanPlaceTestData
     *
     * @param int  $initialCard
     * @param int  $cardToPlace
     * @param bool $expectedResult
     */
    public function testCanPlace(int $initialCard, int $cardToPlace, bool $expectedResult)
    {
        $initialCard = $this->cardFactory->create($initialCard);
        $column      = $this->columnFactory->createFilled([$initialCard]);

        $result = $column->canPlace($this->cardFactory->create($cardToPlace));
        $this->assertEquals($expectedResult, $result);
    }

    public function getDismissCardsTestData(): array
    {
        return [
            [[11], 1, [11]],
            [[15, 10, 11], 1, [11]],
        ];
    }

    /**
     * @dataProvider getDismissCardsTestData
     *
     * @param array $cards
     * @param int   $amountToSlice
     * @param array $resultCards
     */
    public function testDismissCards(array $cards, int $amountToSlice, array $resultCards)
    {
        $fullColumn     = $this->columnFactory->createFilled($cards);
        $expectedSliced = $this->columnFactory->createFilled($resultCards);

        $sliced = $fullColumn->dismissCards($amountToSlice);
        $this->assertEquals($expectedSliced, $sliced);
    }

    public function getIsSortedTestData(): array
    {
        return [
            [[15, 11], false],
            [[15, 10, 11], false],
            [[15, 10], true],
            [[14, 11, 5], true],
        ];
    }

    /**
     * @dataProvider getIsSortedTestData
     *
     * @param int[] $cards
     * @param bool  $expectedResult
     */
    public function testIsSorted(array $cards, bool $expectedResult)
    {
        $column = $this->columnFactory->createFilled($cards);

        $result = $column->isSorted();
        $this->assertEquals($expectedResult, $result);
    }
}
