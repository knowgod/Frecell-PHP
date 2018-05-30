<?php

namespace Freecell;

use Freecell\Api\GameObjectInterface;

/**
 * Class CardRepresentationFactory
 *
 */
class CardFactory implements Api\FactoryInterface
{
    /**
     * @param int|null $cardNum
     *
     * @return Card
     */
    public function create(int $cardNum = null): GameObjectInterface
    {
        return new Card($cardNum);
    }
}
