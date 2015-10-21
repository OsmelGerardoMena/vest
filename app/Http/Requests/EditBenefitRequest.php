<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

class EditBenefitRequest extends Request
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
            'amount' => 'required|numeric',
            'benefit_type_id' => 'required|exists:benefit_types,id',
            'product_id' => 'required|exists:products,id',
        ];
    }
}
