<?php

namespace App\Http\Middleware;

use Closure;
use App\Ledger\Auth\JwtAuthentication;
use App\Ledger\Auth\TokenExpiredException;
use App\Ledger\Repositories\LedgerLogin\LedgerLoginInterface;
// use App\MyHealthcare\Repositories\DoctorLogin\DoctorLoginInterface;
use App\User;
use App\Models\UserDevice;

class LedgerApiAuthentication {

    private $jwtAuth;
    private $user;
    private $ledgerlogin;
    // private $userDevice;

    public function __construct(JwtAuthentication $jwtAuth,User $user,LedgerLoginInterface $ledgerlogin) {
        $this->jwtAuth = $jwtAuth;
        $this->user = $user;
        $this->ledgerlogin = $ledgerlogin;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $token = $request->header('Authorization');
        if (!empty($token)) {
            $uid = null;

            // Decrypt access token
            try {
                $payload = $this->jwtAuth->parseToken($token);
                $uid = $payload->uid;
            } catch (TokenExpiredException $e) {
                $response = ['message' => trans('errors.LEDGER_TOKEN_107')];
                return response()->json($response, 400);
            } catch (\Exception $e) {
                $response = ['message' => trans('errors.LEDGER_TOKEN_107')];
                return response()->json($response, 400);
            }
            // dd($this->ledgerlogin->findUser($uid));
            $ledgeruser = !empty($this->ledgerlogin->findUser($uid)) ? $this->ledgerlogin->findUser($uid) : null;
            // dd($ledgeruser->is_active);
            if (empty($ledgeruser) || empty($ledgeruser->is_logged_in)) {
                $response = ['message' => trans('errors.LEDGER_TOKEN_107')];
                return response()->json($response, 400);
            }

            if ($ledgeruser->is_active != 1) {
                $response = ['message' => 'Sorry! your account is not in active state'];
                return response()->json($response, 400);
            }


            $userData['uid'] = $uid;
            $userData['user_id'] = $uid;
            $userData['is_logged_in'] = 1;
        } else {
            abort(401, trans('errors.LEDGER_TOKEN_107'));
        }
// dd($userData);
        config(['api.current_user' => $userData]);
// dd(config('api.current_user'));
        return $next($request);
    }

}
