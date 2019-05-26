<?php

namespace Freecell\Api;

interface FactoryInterface
{
    /** @noinspection ReturnTypeCanBeDeclaredInspection */
    /**
     * @return GameObjectInterface
     */
    public function create(): GameObjectInterface;
}
