<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RemoveTrendsAttachedFilesFromRequest extends FormRequest
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
            'tmpImageFile' => 'required|array|size:2',
        ];
    }

    /**
     * 自定义验证消息返回
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tmpImageFile.required' => trans('message.params_error'),
            'tmpImageFile.array' => trans('message.params_error'),
            'tmpImageFile.size' => trans('message.params_error'),
        ];
    }
}
