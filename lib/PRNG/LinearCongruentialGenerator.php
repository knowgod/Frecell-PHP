<?php

namespace Freecell\Lib\PRNG;

/**
 * These are implementations of 'Linear congruential generator' algorithm for BSD and MS systems.
 *
 * @see http://rosettacode.org/wiki/Linear_congruential_generator#PHP
 * @todo Move library to separate Composer package
 */
class LinearCongruentialGenerator
{
    /**
     * 'Linear congruential generator' for BSD
     *
     * @param $seed
     *
     * @return \Closure
     */
    static public function bsd_rand(int $seed)
    {
        return function () use (&$seed) {
            return $seed = (1103515245 * $seed + 12345) % (1 << 31);
        };
    }

    /**
     * 'Linear congruential generator' for Microsoft
     *
     * @param $seed
     *
     * @return \Closure
     */
    static public function msvcrt_rand(int $seed)
    {
        return function () use (&$seed) {
            return ($seed = (214013 * $seed + 2531011) % (1 << 31)) >> 16;
        };
    }
}
