<?php

namespace App\Ledger\Auth;

use Exception;

class InvalidTokenException extends Exception
{
    public function throwInvalidTokenException()
    {
        return response()->json(['error' => 'Invalid token.'], 401);
    }
}
