<?php

namespace Freecell\Deck;

use Freecell\Api\GameObjectInterface;

class ColumnFactory implements \Freecell\Api\FactoryInterface
{
    /**
     * @return Column
     */
    public function create(): GameObjectInterface
    {
        return new Column();
    }

    /**
     * @param array $cards
     *
     * @return Column
     */
    public function createFilled(array $cards): Column
    {
        return new Column($cards);
    }
}
