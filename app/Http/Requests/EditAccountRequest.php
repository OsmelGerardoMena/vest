<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

use Illuminate\Routing\Route;

class EditAccountRequest extends Request
{
    private $route;

    public function __construct(Route $route)
    {
        //para obtener el id del usuario por medio de getParameter()
        $this->route = $route;
    }

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
            'email' => 'required|email|max:60|unique:users,email,'
                        .$this->route->getParameter('account'),
            'identifier' => 'required|max:60|unique:users,identifier,'
                            .$this->route->getParameter('account'),
            'mobile' => 'required|max:20',
            'phone' => 'required|max:20',
            'address' => 'required|max:100',
            'password' => 'confirmed|min:6',
        ];
    }
}
