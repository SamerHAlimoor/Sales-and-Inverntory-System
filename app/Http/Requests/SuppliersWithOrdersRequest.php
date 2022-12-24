<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuppliersWithOrdersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier_code' => 'sometimes',
            'pill_type' => 'sometimes',
            'order_date' => 'sometimes',
            'store_id' => 'sometimes'
        ];
    }

    public function messages()
    {
        return [
            'supplier_code.required' => 'اسم  المورد',
            'pill_type.required' => 'نوع الفاتورة مطلوب',
            'order_date.required' => 'تاريخ الفاتورة مطلوب',
            'store_id.required' => ' المخزن المستلم للفاتورة مطلوب',

        ];
    }
}