<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use App\Konohanaruto\Services\Frontend\UserTrendsService;

class TrendsAttachedFilesFromRequest extends FormRequest
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
    public function rules(UserTrendsService $userTrends)
    {
        /**
         * 关于size的单位， 千字节，也就是KB
         * https://laravel.com/docs/5.4/validation#rule-size
         */

        $attachFileConf = $userTrends->attachedSpecification();

        return [
            'trendsFile.*' => 'required|mimes:jpg,jpeg,png,bmp|min:' . $attachFileConf['single_min_size']. '|max:' . $attachFileConf['single_max_size'],
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
            'trendsFile.*.required' => trans('validation.required'),
            'trendsFile.*.mimes' => trans('validation.unsupported_file_format'),
            'trendsFile.*.min' => trans('validation.file_size_non_standard'),
        ];
    }
}
