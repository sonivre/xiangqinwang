<?php

namespace App\Http\Requests\Intranet;

use Illuminate\Foundation\Http\FormRequest;

class MenuCreateFormRequest extends FormRequest
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
            'menu_name' => 'required|unique:menus,menu_name,null,menu_id',
            // menu_route不能为空，除非menu_parent_id为0
            'menu_route' => 'required_unless:menu_parent_id,0',
            'menu_parent_id' => 'numeric',
            'permission_id' => 'required_unless:menu_parent_id,0'
        );
    }
    
    /**
     * @override
     * 
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        return [
            'menu_name.required' => '菜单名称不能为空！',
            'menu_name.unique' => '菜单名称已经存在！',
            'menu_route.required_unless' => '非顶级菜单时，菜单链接不能为空！',
            'menu_parent_id.numeric' => '上级菜单参数错误！',
            'permission_id.required_unless' => '非顶级菜单是，菜单权限不能为空！'
        ];
    }
}
