<?php

namespace App\Ledger\Auth;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

/**
*
* Authentication based on crypted token
*
*/
class CryptAuthentication
{
    public function validateAccessToken($accessToken, $secret_key = null)
    {
    	if (empty($secret_key)) {
    		$secret_key = config('api.api_secret_key');
    	}

        $accessToken = trim($accessToken);
        if (empty($accessToken)) {
            abort(400, trans('errors.LEGDER_106'));
        }

        $decryptedAccessToken = static::decryptAccessToken($accessToken);
        if (empty($decryptedAccessToken)) {
            abort(400, trans('errors.LEDGER_107'));
        }

        try
        {
            $secret_key = Crypt::decrypt($secret_key);
        } catch (DecryptException $e)
        {
            $secret_key = null;
        }

        if ($secret_key != $decryptedAccessToken) {
            abort(400, trans('errors.LEDGER_107'));
        }

        return true;
    }

    private function decryptAccessToken($accessToken)
    {
        try
        {
            $decryptedAccessToken = Crypt::decrypt($accessToken);
        } catch (DecryptException $e)
        {
            $decryptedAccessToken = null;
        }

        return $decryptedAccessToken;
    }
}
