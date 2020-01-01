<?php

namespace App\Http\Requests\Role;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return policy(Role::class)->create($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3|unique:roles,name',
            'display_name' => 'required|min:3',
            'description' => 'required',
            'permissions' => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'permissions[].required'=>'Please select at least one permission'
        ];
    }

    public function clientSideRules($rules)
    {
        unset($rules['permissions']);

        return $rules;
    }
}
