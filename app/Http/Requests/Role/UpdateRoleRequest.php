<?php

namespace App\Http\Requests\Role;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return policy(Role::class)->update($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3|unique:roles,name,'.$this->route('role'),
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

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
