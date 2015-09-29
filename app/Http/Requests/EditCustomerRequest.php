<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

use Illuminate\Routing\Route;

class EditCustomerRequest extends Request
{
    private $route;

    public function __construct(Route $route)
    {
        //para obtener el id del cliente por medio de getParameter()
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
            'address' => 'required|max:100',
            'identifier' => 'required|max:60|unique:customers,identifier,'.$this->route->getParameter('customers'),
            'city' => 'required|max:60',
            'state' => 'required|max:60',
        ];
    }
}
