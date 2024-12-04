<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'unique:users|required|email',
            //can be used some specific package like https://github.com/Propaganistas/Laravel-Phone
            'phonenumber' => 'required|digits_between:9,12',
        ];
    }
}
