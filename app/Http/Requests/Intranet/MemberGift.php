<?php

namespace App\Http\Requests\Intranet;

use Illuminate\Foundation\Http\FormRequest;

class MemberGift extends FormRequest
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
            'gift_name' => 'required',
            'htb' => 'required|integer',
            'gift_image_info' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'gift_name' => trans('label_fields.gift_name'),
            'htb' => trans('label_fields.htb'),
            'gift_image_info' => '',
        ];
    }

    public function messages()
    {
        return [
            'gift_name.required' => ':attribute' . trans('validation.required'),
            'htb.required' => ':attribute' . trans('validation.required'),
            'htb.integer' => ':attribute' . trans('validation.integer'),
            'gift_image_info.required' => ':attribute' . trans('message.params_error'),
        ];
    }
}
