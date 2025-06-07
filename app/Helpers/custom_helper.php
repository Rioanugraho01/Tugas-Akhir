<?php

function active($uri)
{
    $current = service('uri')->getSegment(1);
    if ($uri === 'index' && ($current === '' || $current === 'index')) {
        return 'active';
    }
    return $current === $uri ? 'active' : '';
}
