<?php

namespace App\Http\Requests\Api\Ledger;

use Illuminate\Validation\Rule;

class LoginRequest extends \App\Http\Requests\Api\BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->replace($this->only(['email', 'password']));

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => trans('errors.LEDGER_118'),
            'password.required'  => trans('errors.LEDGER_119')
        ];
    }
}
