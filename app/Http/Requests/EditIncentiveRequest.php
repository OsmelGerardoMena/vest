<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

class EditIncentiveRequest extends Request
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
            'incentive_type_id' => 'required|exists:incentive_types,id',
            'goal' => 'required|numeric',
            'award' => 'required',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'product_id' => 'required|exists:products,id',
        ];
    }
}
