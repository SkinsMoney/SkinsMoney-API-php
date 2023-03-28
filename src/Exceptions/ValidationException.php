<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 15:55
 */

namespace SkinsMoney\Exceptions;

use Throwable;

class ValidationException extends SkinsMoneyException
{
    public function __construct(private object $errors, ?Throwable $previous = null)
    {
        parent::__construct('Validation failed', 422, $previous);
    }

    public function getErrors(): object
    {
        return $this->errors;
    }
}