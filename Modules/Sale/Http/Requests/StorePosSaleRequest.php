<?php

namespace Modules\Sale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePosSaleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'nullable',
            'tax_percentage' => 'integer|min:0|max:100',
            'discount_percentage' => 'integer|min:0|max:100',
            'shipping_amount' => 'numeric',
            'total_amount' => 'numeric',
            'paid_amount' => 'numeric',
            'note' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create_pos_sales');
    }
}
