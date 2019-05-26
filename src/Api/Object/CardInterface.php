<?php
/**
 * Copyright © Madepeople, Inc. All rights reserved.
 *
 * @author    Arkadij Kuzhel <arkadij@madepeople.se>
 * @created   24.05.19
 */

namespace Freecell\Api\Object;

interface CardInterface
{
    const COLOUR_BLACK = 0;
    const COLOUR_RED   = 1;

    const SUIT_CLUB    = 0;
    const SUIT_DIAMOND = 1;
    const SUIT_HEART   = 2;
    const SUIT_SPADES  = 3;

    const FACE_SUIT= [
        self::SUIT_CLUB    => "\u{2663}",
        self::SUIT_DIAMOND => "\u{2666}",
        self::SUIT_HEART   => "\u{2665}",
        self::SUIT_SPADES  => "\u{2660}",
    ];

    const FACE_CARD = [
        0  => ' A ',
        1  => ' 2 ',
        2  => ' 3 ',
        3  => ' 4 ',
        4  => ' 5 ',
        5  => ' 6 ',
        6  => ' 7 ',
        7  => ' 8 ',
        8  => ' 9 ',
        9  => ' 10',
        10 => ' J ',
        11 => ' Q ',
        12 => ' K ',
    ];
}
