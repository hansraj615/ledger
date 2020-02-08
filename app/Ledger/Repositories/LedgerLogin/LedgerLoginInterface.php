<?php

namespace App\Ledger\Repositories\LedgerLogin;

interface LedgerLoginInterface {

    public function find($id);

    public function getData($request);

    public function isLoggedIn($id,$dafault=false);
    // public function findDoctor($id);


    public function isLoggedOut($id,$dafault=false);

    public function checkPassword($request,$userId);

}
