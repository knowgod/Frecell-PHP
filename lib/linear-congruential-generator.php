<?php
function bsd_rand($seed)
{
    return function () use (&$seed) {
        return $seed = (1103515245 * $seed + 12345) % (1 << 31);
    };
}

function msvcrt_rand($seed)
{
    return function () use (&$seed) {
        return ($seed = (214013 * $seed + 2531011) % (1 << 31)) >> 16;
    };
}
