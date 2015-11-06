<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

//para usar route como inyeccion de dependencia
use Illuminate\Routing\Route;

class EditProductRequest extends Request
{
    private $route;

    public function __construct(Route $route)
    {
        //para obtener el id del producto por medio de getParameter()
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
            'name' => 'required|max:100|unique:products,name,'
                    .$this->route->getParameter('products'),
            'presentation' => 'required|max:100',
            'price' => 'required|numeric',
            'url' => 'url',
            'company_id' => 'required|exists:users,id',
        ];
    }
}
