<?php

namespace App\Http\Requests\Intranet;

use Illuminate\Foundation\Http\FormRequest;

class MemberGiftUpdate extends FormRequest
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
            'htb' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'gift_name' => trans('label_fields.gift_name'),
            'htb' => trans('label_fields.htb'),
        ];
    }

    public function messages()
    {
        return [
            'gift_name.required' => ':attribute' . trans('validation.required'),
            'htb.required' => ':attribute' . trans('validation.required'),
            'htb.integer' => ':attribute' . trans('validation.integer'),
        ];
    }
}
