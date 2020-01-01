<?php

namespace App\Http\Requests\Admin\Permission;

use App\Permission;
use Illuminate\Foundation\Http\FormRequest;

class ShowPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return policy(Permission::class)->show($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
