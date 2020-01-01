<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleClientRequest extends CreateRoleRequest
{
    public function rules()
    {
        return $this->clientSideRules(parent::rules());
    }
}
