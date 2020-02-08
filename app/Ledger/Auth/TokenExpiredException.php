<?php

namespace App\Ledger\Auth;
use Exception;
class TokenExpiredException extends Exception
{
    public function throwTokenExpiredException()
    {
        return response()->json(['error' => 'Token expired.'], 401);
    }
}
