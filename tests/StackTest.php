<?php
/**
 * Copyright © Madepeople, Inc. All rights reserved.
 *
 * @author    Arkadij Kuzhel <arkadij@madepeople.se>
 * @created   11.08.19
 */
declare(strict_types=1);

namespace Freecell\Tests;

use Freecell\Deck\Column\StackFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class StackTest
 *
 */
class StackTest extends TestCase
{

    /**
     * @var \Freecell\Deck\ColumnFactory
     */
    private $stackFactory;

    public function setUp(): void
    {
        $this->stackFactory = new StackFactory();
    }

    public function getConstructTestData(): array
    {
        return [
            [[44, 1, 38, 4, 8, 2], false],
            [[15, 10], true],
        ];
    }

    /**
     * @dataProvider getConstructTestData
     *
     * @param int[] $cards
     * @param bool  $isStackable
     */
    public function testConstruct(array $cards, bool $isStackable)
    {
        try {
            $column = $this->stackFactory->createFilled($cards);
            $this->assertEquals(count($cards), $column->count());
        } catch (\InvalidArgumentException $e) {
            $this->assertFalse($isStackable);
        }
    }

}
