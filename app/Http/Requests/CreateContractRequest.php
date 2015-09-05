<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

class CreateContractRequest extends Request
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
            'name' => 'required|max:60|unique:contracts,name',
            'url' => 'required|max:100',
            'product_id' => 'required',
        ];
    }
}
