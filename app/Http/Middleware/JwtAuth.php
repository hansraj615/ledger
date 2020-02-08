<?php

namespace App\Http\Middleware;

use App\Ledger\Auth\EmptyTokenException as AuthEmptyTokenException;
use App\Ledger\Auth\JwtAuthentication as AuthJwtAuthentication;
use App\MyHealthcare\Auth\EmptyTokenException;
use App\MyHealthcare\Auth\JwtAuthentication;
use Closure;
use Illuminate\Http\Request;

class JwtAuth
{
    private $jwtAuth;

    public function __construct(AuthJwtAuthentication $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * @param $request Request
     * @param Closure $next
     * @return mixed
     * @throws EmptyTokenException
     */
    public function handle($request, Closure $next)
    {
        if(!$request->hasHeader('Authorization')) {
            throw(new AuthEmptyTokenException());
        }

        $this->jwtAuth->parseToken($request->header('Authorization'));

        return $next($request);
    }
}
