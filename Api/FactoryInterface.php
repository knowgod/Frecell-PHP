<?php

namespace Freecell\Api;

interface FactoryInterface
{
    /**
     * @return GameObjectInterface
     */
    public function create();
}
