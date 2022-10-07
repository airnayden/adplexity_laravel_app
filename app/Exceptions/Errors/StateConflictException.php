<?php

namespace App\Exceptions\Errors;

class StateConflictException extends \Exception
{
    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return 409;
    }
}
