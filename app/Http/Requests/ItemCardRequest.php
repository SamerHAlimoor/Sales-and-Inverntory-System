<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCardRequest extends FormRequest
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
            'name' => 'required',
            'item_type' => 'required',
            'inv_item_card_categories_id' => 'required',
            'uom_id' => 'required',
            'does_has_retail_unit' => 'required',
            'retail_uom_id' => 'required_if:does_has_retail_unit,1',
            'retail_uom_qty_to_parent' => 'required_if:does_has_retail_unit,1',
            'price' => 'required',
            'nos_bulk_price' => 'required',
            'bulk_price' => 'required',
            'cost_price' => 'required',
            'price_retail' => 'required_if:does_has_retail_unit,1',
            'nos_bulk_price_retail' => 'required_if:does_has_retail_unit,1',
            'bulk_price_retail' => 'required_if:does_has_retail_unit,1',
            'cost_price_retail' => 'required_if:does_has_retail_unit,1',
            'has_fixed_price' => 'required',
            'active' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الصنف مطلوب',
            'item_type.required' => 'نوع الصنف مطلوب',
            'inv_item_card_categories_id.required' => 'فئة الصنف مطلوب',
            'uom_id.required' => 'الوحدة الاساسية للصنف  مطلوب',
            'does_has_retail_unit.required' => 'حالة هل للصنف وحدة تجزئة مطلوب',
            'retail_uom_id.required_if' => 'وحدة التجزئة مطلوبة',
            'retail_uom_qty_to_parent.required_if' => 'عدد وحدات التجزئة مطلوبة',
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