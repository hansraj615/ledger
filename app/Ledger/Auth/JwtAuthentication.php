<?php

namespace App\Ledger\Auth;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class JwtAuthentication
{
    private $token;

    private $tokenExpirationTime;

    private $tokenIssuedAt;

    private $tokenIssuedNotBefore;

    private $serverName;

    public function __construct()
    {
        $this->tokenExpirationTime = strtotime(date('Y-m-d H:i:s', strtotime(config('api.auth.token_expiration'))));
        $this->tokenIssuedAt   = time();
        $this->tokenIssuedNotBefore  = $this->tokenIssuedAt;
        $this->serverName = env('APP_URL'); // Retrieve the server name from config file
    }

    public function generateToken($userId, $parameters = [])
    {
        return JWT::encode($this->setToken($userId, $parameters)->token, config('api.auth.key'));
    }

    private function setToken($userId, $parameters)
    {
        $this->token = [
            'iss'  => $this->serverName,       // Issuer
            'iat'  => $this->tokenIssuedAt,         // Issued at: time when the token was generated
            'nbf'  => $this->tokenIssuedNotBefore,        // Not before
            'exp'  => $this->tokenExpirationTime,           // Expire
            'uid'  => $userId
        ];

        foreach ($parameters as $key => $value)
            $this->token[$key] = $value;
        return $this;
    }

    public function parseToken($token)
    {
        try {
            return JWT::decode($token, config('api.auth.key'), array('HS256'));
        } catch (ExpiredException $e) {
            // dd(1);
            throw (new TokenExpiredException());
        } catch (\UnexpectedValueException $e) {
            // dd(2);
            throw (new InvalidTokenException());
        }
    }
}
