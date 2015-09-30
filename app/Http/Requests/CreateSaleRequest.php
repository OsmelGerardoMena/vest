<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

class CreateSaleRequest extends Request
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
            'seller_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
        ];
    }
}
