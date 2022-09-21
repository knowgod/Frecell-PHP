<?php

namespace Freecell\Deck;

use Freecell\Api\ColumnFactoryInterface;
use Freecell\Api\GameObjectInterface;
use Freecell\Api\Object\ColumnInterface;

class ColumnFactory implements ColumnFactoryInterface
{
    /**
     * @return \Freecell\Deck\Column
     */
    public function create(): GameObjectInterface
    {
        return new Column($this);
    }

    /**
     * @param array $cards
     *
     * @return \Freecell\Deck\Column
     */
    public function createFilled(array $cards): ColumnInterface
    {
        return new Column($this, $cards);
    }
}
