<?php

namespace App\Http\Requests\Intranet;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class MenuUpdateFormRequest extends FormRequest
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
        return array(
            'menu_name' => 'required', 
        );
    }
    
    /**
     * override
     */
    public function messages()
    {
        return array(
            'menu_name.required' => '菜单名称不能为空！',
            'menu_route.required' => '菜单链接不能为空！',
            'menu_parent_id.required' => '必须属于一个父级菜单！',
            'permission_id.required' => '必须指定一个权限！',
        );
    }
    
    /**
     * override
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        
        $validator->sometimes(array('menu_route', 'menu_parent_id', 'permission_id'), 'required', function ($input) {
            return $input['is_root_menu'] == 0;
        });
        
        return $validator;
    }
}
