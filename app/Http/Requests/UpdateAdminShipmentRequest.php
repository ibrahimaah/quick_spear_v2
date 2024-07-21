<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminShipmentRequest extends FormRequest
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
            'shop_id' => 'required',
            'delegate_id' => 'required',
            'consignee_name' => 'required',
            'consignee_phone' => 'required',
            'consignee_city' => 'required',
            'consignee_region' => 'required',
            'order_price' => 'required|numeric|gt:0',
            'value_on_delivery' => 'nullable',
            'shipment_status_id' => 'required',
            'customer_notes' => 'nullable',
            'delegate_notes' => 'nullable',
            'consignee_phone_2' => 'nullable'
        ];
    }
}
