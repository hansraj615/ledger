<?php

namespace App\Http\Requests\Company;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return policy(Company::class)->create($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
        //     'name' => 'required|min:3|unique:permissions,name',
        //     'display_name' => 'required|min:3',
        //     'description' => 'required',
        ];
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
