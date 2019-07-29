<?php

namespace Freecell\Deck;

use Freecell\Api\FactoryInterface;
use Freecell\Api\GameObjectInterface;

class ColumnFactory implements FactoryInterface
{
    /**
     * @return Column
     */
    public function create(): GameObjectInterface
    {
        return new Column($this);
    }

    /**
     * @param array $cards
     *
     * @return Column
     */
    public function createFilled(array $cards): Column
    {
        return new Column($this, $cards);
    }
}
