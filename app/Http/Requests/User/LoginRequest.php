<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $login_via = $this->input('login_via');

        switch ($login_via){

            case 'email':
                    return [
                        'login_via'=>['required', Rule::in(array_keys(config('constants.LOGIN_DROP_DOWN')))],
                        'email'=> ["bail", "required", "min:7", "max:70", "regex:/^[^_\'.@-][A-Za-z0-9_.\'!-=#$%^+&\*]*(\.[a-zA-Z][a-zA-Z0-9_]*)?[^_]@[a-zA-Z0-9_][a-zA-Z-0-9]*\.[^_][a-zA-Z]+(\.[a-zA-Z]+)?$/"],
                        'password' => 'required|max:128',
                    ];
                break;

            case 'mobile_no':

                    return [
                        'login_via'=>['required', Rule::in(array_keys(config('constants.LOGIN_DROP_DOWN')))],
                        'email'=> "bail|required|numeric|regex:/^(?!0+$)\d{10,14}$/",
                        'password' => 'required|max:128',
                    ];

                break;

            case 'gid':

                    return [
                        'login_via'=>['required', Rule::in(array_keys(config('constants.LOGIN_DROP_DOWN')))],
                        'email'=> "bail|required|regex:/^([A-Za-z0-9][A-Za-z0-9]*(\.[A-Za-z0-9]+)?){4,20}$/",
                        'password' => 'required|max:128',
                    ];

                break;

            case 'doctor_id':

                    return [
                        'login_via'=>['required', Rule::in(array_keys(config('constants.LOGIN_DROP_DOWN')))],
                        'email'=> ["bail","required","regex:/^([A-Za-z0-9][A-Za-z0-9]*(\.[A-Za-z0-9]+)?){4,20}$/"],
                        'password' => 'required|max:128',
                    ];

                break;

            default:
                    return [
                        'login_via'=>['required', Rule::in(array_keys(config('constants.LOGIN_DROP_DOWN')))],
                        'email'=> ["bail", "required", "min:7", "max:70", "regex:/^[^_\'.@-][A-Za-z0-9_.\'!-=#$%^+&\*]*(\.[a-zA-Z][a-zA-Z0-9_]*)?[^_]@[a-zA-Z0-9_][a-zA-Z-0-9]*\.[^_][a-zA-Z]+(\.[a-zA-Z]+)?$/"],
                        'password' => 'required|max:128',
                    ];
        }
    }

    public function messages() {
        parent::messages();

        $login_via = $this->input('login_via');

        switch ($login_via){

            case 'email':
                    return [
                        'email.regex'=> 'Invalid email address',
                    ];
                break;

            case 'mobile_no':

                    return [
                        'email.required'=> "Mobile No. requried",
                        'email.numeric'=> "Mobile No. should be numeric",
                        'email.regex'=> "Invalid Mobile No. format",
                    ];

                break;

            case 'gid':

                    return [
                        'email.required'=> "Agent ID requried",
                        'email.regex'=> "Invalid Agent ID",
                    ];

                break;

            case 'doctor_id':

                    return [
                        'email.required'=> "Doctor ID requried",
                        'email.numeric'=> "Doctor ID should be numeric",
                        'email.regex'=> "Invalid Doctor ID",
                    ];

                break;

            default:
                    return [
                        'email.regex'=> 'Invalid email address',
                    ];
        }
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
