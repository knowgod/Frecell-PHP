<?php
/**
 * These are implementations of LCG algorithm for BSD and MS systems.
 * @see http://rosettacode.org/wiki/Linear_congruential_generator#PHP
 */

/**
 * @param $seed
 *
 * @return Closure
 */
function bsd_rand(int $seed)
{
    return function () use (&$seed) {
        return $seed = (1103515245 * $seed + 12345) % (1 << 31);
    };
}

/**
 * @param $seed
 *
 * @return Closure
 */
function msvcrt_rand(int $seed)
{
    return function () use (&$seed) {
        return ($seed = (214013 * $seed + 2531011) % (1 << 31)) >> 16;
    };
}
