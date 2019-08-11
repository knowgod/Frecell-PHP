<?php
/**
 * Copyright © Madepeople, Inc. All rights reserved.
 *
 * @author    Arkadij Kuzhel <arkadij@madepeople.se>
 * @created   11.08.19
 */
declare(strict_types=1);

namespace Freecell\Deck\Column;

/**
 * Class StackFactory
 *
 */
class StackFactory
{
    /**
     * @param array $cards
     *
     * @return \Freecell\Deck\Column\Stack
     */
    public function createFilled(array $cards): Stack
    {
        return new Stack($this, $cards);
    }
}
