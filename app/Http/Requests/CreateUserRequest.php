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
            'password' => 'required|confirmed|min:6',
        ];
    }
}