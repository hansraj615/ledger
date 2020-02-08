<?php

namespace App\Ledger\Auth;

class EmptyTokenException extends \Exception
{
    public function throwEmptyTokenException()
    {
        return response()->json(['error' => 'Token not present'], 401);
    }
}
