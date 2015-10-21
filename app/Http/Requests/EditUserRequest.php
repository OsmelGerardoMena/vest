<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

//para usar route como inyeccion de dependencia
use Illuminate\Routing\Route;

class EditUserRequest extends Request
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
            'email' => 'required|email|max:60|unique:users,email,'.$this->route->getParameter('users'),
            'identifier' => 'required|max:60|unique:users,identifier,'.$this->route->getParameter('users'),
            'mobile' => 'required|max:20',
            'phone' => 'required|max:20',
            'address' => 'required|max:100',
            'type_id' => 'required',
            'company_category_id' => 'required_if:type_id,3|exists:company_categories,id',
            'password' => 'confirmed|min:6',
        ];

        //getParameter('users') devuelve el id del usuario y se pasa como tercer
        //parametro en la regla unique, para aplique la regla con todos los 
        //registros, excepto con ese id
    }
}
