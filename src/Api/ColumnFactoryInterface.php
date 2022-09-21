<?php
/**
 * Copyright © Madepeople, Inc. All rights reserved.
 *
 * @author    Arkadij Kuzhel <arkadij@madepeople.se>
 * @created   19.09.19
 */

namespace Freecell\Api;

use Freecell\Api\Object\ColumnInterface;

interface ColumnFactoryInterface extends FactoryInterface
{

    /**
     * @param array $cards
     *
     * @return ColumnInterface
     */
    public function createFilled(array $cards): ColumnInterface;
}
