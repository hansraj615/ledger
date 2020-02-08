<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ledger\LoginRequest;
use App\Ledger\Auth\JwtAuthentication;
use App\Ledger\Repositories\LedgerLogin\LedgerLoginInterface;
use App\Ledger\Repositories\Api\Company\CompanyApiInterface;
use App\User;
use Exception;

class CompanyApiController extends BaseController {

    public $jwtauth;
    public $ledgerlogin;
    public $apicompany;

    public function __construct( JwtAuthentication $jwtauth,LedgerLoginInterface $ledgerlogin,CompanyApiInterface $apicompany) {
        $this->jwtauth = $jwtauth;
        $this->ledgerlogin = $ledgerlogin;
        $this->apicompany = $apicompany;
    }

    public function getCompanyApi(Request $request) {
        try {
            $userId = !empty($request->user_id)?$request->user_id:config('api.current_user.user_id');
            $response = $this->apicompany->getCompanyApi($userId);
            // dd($response);
            return response()->json(['data'=>$response,'code'=>200,'message'=>"Success"]);
        } catch (Exception $ex) {
            logger()->error($ex->getMessage());
            // abort(400, trans('errors.COMPANY_1'));
            return response()->json(['Error'=>trans('errors.COMPANY_1'),'code'=>400,'message'=>"failed"]);
        }
    }

    public function editCompanyApi(Request $request) {
        try {
            $userId = !empty($request->user_id)?$request->user_id:config('api.current_user.user_id');
            $response = $this->apicompany->editCompanyApi($request,$userId);
            return response()->json(['data'=>$response,'code'=>200,'message'=>"Success"]);
        } catch (Exception $ex) {
            logger()->error($ex->getMessage());
            return response()->json(['Error'=>trans('errors.COMPANY_1'),'code'=>400,'message'=>"failed"]);
        }
    }

    public function updateCompanyApi(Request $request) {
        try {
            $userId = !empty($request->user_id)?$request->user_id:config('api.current_user.user_id');
            $response = $this->apicompany->updateCompanyApi($request,$userId);
            return response()->json(['code'=>200,'message'=>"Success"]);
        } catch (Exception $ex) {
            logger()->error($ex->getMessage());
            return response()->json(['Error'=>trans('errors.COMPANY_2'),'code'=>400,'message'=>"failed"]);
        }
    }

}
