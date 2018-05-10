<?php

namespace Freecell;

/**
 * Class CardRepresentationFactory
 *
 */
class CardFactory implements Api\FactoryInterface
{
    /**
     * @param null $cardNum
     *
     * @return Card
     */
    public function create($cardNum = null)
    {
        return new Card($cardNum);
    }
}
