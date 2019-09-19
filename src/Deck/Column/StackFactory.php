<?php
/**
 * Copyright © Madepeople, Inc. All rights reserved.
 *
 * @author    Arkadij Kuzhel <arkadij@madepeople.se>
 * @created   11.08.19
 */
declare(strict_types=1);

namespace Freecell\Deck\Column;

use Freecell\Api\Object\ColumnInterface;
use Freecell\Deck\ColumnFactory;

/**
 * Class StackFactory
 *
 * @method create() : \Freecell\Deck\Column\Stack
 */
class StackFactory extends ColumnFactory
{
    /**
     * @param array $cards
     *
     * @return \Freecell\Deck\Column\Stack
     */
    public function createFilled(array $cards): ColumnInterface
    {
        return new Stack($cards);
    }
}
