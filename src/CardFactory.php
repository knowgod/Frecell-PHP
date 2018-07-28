<?php

namespace Freecell;

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
    public function create(int $cardNum = null): Card
    {
        return new Card($cardNum);
    }
}
