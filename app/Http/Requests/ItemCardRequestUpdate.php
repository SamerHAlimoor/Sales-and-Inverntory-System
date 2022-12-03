<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCardRequestUpdate extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'sometimes',
            'inv_item_card_categories_id' => 'sometimes',
            'price' => 'sometimes',
            'nos_bulk_price' => 'sometimes',
            'bulk_price' => 'sometimes',
            'cost_price' => 'sometimes',
            'price_retail' => 'sometimes',
            'nos_bulk_price_retail' => 'sometimes',
            'bulk_price_retail' => 'sometimes',
            'cost_price_retail' => 'sometimes',
            'has_fixed_price' => 'sometimes',
            'active' => 'sometimes',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الصنف مطلوب',
            'inv_item_card_categories_id.required' => 'فئة الصنف مطلوب',
            'price.required' => '  سعر القطاعي للوحدة الاب مطلوب',
            'nos_bulk_price.required' => '  سعر النص جملة لوحدة الاب مطلوب',
            'bulk_price.required' => 'سعر الجملة لوحده الاب مطلوب  ',
            'cost_price.required' => '  تكلفة الشراء لوحدة الاب مطلوب',
            'price_retail.required_if' => '     سعر القطاعي لوحده التجزئة مطلوب ',
            'nos_bulk_price_retail.required_if' => '     سعر النص جملة لوحده التجزئة مطلوب ',
            'bulk_price_retail.required_if' => '     سعر الجملة لوحده التجزئة مطلوب ',
            'cost_price_retail.required_if' => '     سعر الشراء لوحده التجزئة مطلوب ',
            'has_fixed_price.required' => '   هل للنصف سعر ثابت مطلوب',
            'active.required' => '   حالة تفعيل الصنف مطلوب',

        ];
    }
}