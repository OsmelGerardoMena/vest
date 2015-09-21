<?php

namespace Vest\Http\Requests;

use Vest\Http\Requests\Request;

class EditTrainingRequest extends Request
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
            'url' => 'required|url',
            'date' => 'required|date',
            'product_id' => 'required',
        ];
    }
}
