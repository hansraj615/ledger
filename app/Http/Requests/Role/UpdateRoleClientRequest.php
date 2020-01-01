<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleClientRequest extends UpdateRoleRequest
{
    public function rules()
    {
        return $this->clientSideRules(parent::rules());
    }
}
