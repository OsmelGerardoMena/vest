<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

class CreateUserRequest extends Request
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
        return [
            'name' => 'required|max:60',
            'email' => 'required|email|unique:users,email|max:60',
            'identifier' => 'required|unique:users,identifier|max:60',
            'mobile' => 'required|max:20',
            'phone' => 'required|max:20',
            'address' => 'required|max:100',
            'type_id' => 'required',
            'company_category_id' => 'required_if:type_id,3|exists:company_categories,id',
            'password' => 'required|confirmed|min:6',
        ];
    } 
    // required_if:type_id,3 significa que el campo company_category_id va a ser
    // obligatorio cuando el perfil seleccionado sea empresa
}