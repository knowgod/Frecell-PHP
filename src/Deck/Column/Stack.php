<?php
/**
 * Copyright © Madepeople, Inc. All rights reserved.
 *
 * @author    Arkadij Kuzhel <arkadij@madepeople.se>
 * @created   11.08.19
 */
declare(strict_types=1);

namespace Freecell\Deck\Column;

use Freecell\Card;
use Freecell\CardFactory;
use Freecell\Deck\Column;

/**
 * Class Stack
 * Implementation of Column that is always sorted
 *
 */
class Stack extends Column
{
    /** @noinspection MagicMethodsValidityInspection */
    /** @noinspection PhpMissingParentConstructorInspection */
    public function __construct(array $cards = [])
    {
        $this->cardFactory = new CardFactory();

        foreach ($cards as $card) {
            if (is_int($card)) {
                $card = $this->cardFactory->create($card);
            }
            if ($card instanceof Card) {
                if (!$this->canPlace($card)) {
                    /** @noinspection PhpFullyQualifiedNameUsageInspection */
                    throw new \InvalidArgumentException('Error creating stack: The set of cards is not stackable.');
                }
                $this->addCard($card);
            }
        }
    }
}
