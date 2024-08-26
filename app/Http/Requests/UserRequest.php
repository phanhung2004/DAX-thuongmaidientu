<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'fullname' => ['required'],
            // 'username' => ['required'],
            // 'email' => ['required', 'email'],
            // 'passsword' => ['required', 'password']
        ];
    }
    // public function messages(){
    //     return [
    //         'fullname.required' => 'Tên không được để trống',
    //         'username.required' => 'Tên đăng nhập không được để trống',
    //         'email.required' => 'Email không được để trống',
    //         'email.email' => 'Email không đúng đ��nh dạng'
    //     ];
    // }
}
