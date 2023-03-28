<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 16:01
 */

namespace SkinsMoney;

use SkinsMoney\Adapters\Guzzle;

abstract class Action
{
    public function __construct(protected Guzzle $guzzle)
    {
    }
}